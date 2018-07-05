<?php

namespace ArtemProger\Repspec\Test\Logic;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Test\Models\Post;
use ArtemProger\Repspec\Specification\Filter\Where;
use ArtemProger\Repspec\Specification\Logic\DoesntHaveX;

class DoesntHaveXTest extends TestCase {

    public function testDoesntHave_RelationOnly_ModifyQueryCount()
    {
        $query = $this->getQuery(Post::class);
        $spec = new DoesntHaveX('comments');

        $spec->apply($query);
        $result = $query->toSql();

        $expected = $this->formatOneLineSql('
            select * 
              from `posts` 
             where (
                select count(*) 
                  from `comments` 
                 where `posts`.`id` = `comments`.`post_id`
             ) < 1
        ');
        $this->assertEquals($expected, $result);
    }

    public function testDoesntHave_RelationWithChildrenSpecs_ModifyQueryCount()
    {
        $query = $this->getQuery(Post::class);
        $spec = new DoesntHaveX(
            'comments', 
            'and', 
            [
                new Where('field1', '=', 'value1'),
                new Where('field2', '<', 'value2'),
            ]
        );

        $spec->apply($query);
        $result = $query->toSql();

        $expected = $this->formatOneLineSql('
            select * 
              from `posts` 
             where (
                select count(*) 
                  from `comments` 
                 where `posts`.`id` = `comments`.`post_id` 
                    and `field1` = ? 
                    and `field2` < ?) < 1
        ');
        $this->assertEquals($expected, $result);
    }

    public function testOrDoesntHave_RelationOnly_ModifyQueryCount()
    {
        $query = $this->getQuery(Post::class);
        $prespec = new Where('field1', '=', 'value1');
        $spec = new DoesntHaveX(
            'comments',
            'or'
        );

        $prespec->apply($query);
        $spec->apply($query);
        $result = $query->toSql();

        $expected = $this->formatOneLineSql('
            select * 
            from `posts` 
            where `field1` = ? 
                or (
                    select count(*) 
                      from `comments` 
                     where `posts`.`id` = `comments`.`post_id`
                ) < 1
        ');
        $this->assertEquals($expected, $result);
    }
}
