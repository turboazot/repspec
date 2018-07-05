<?php

namespace ArtemProger\Test\Logic;

use ArtemProger\Test\TestCase;
use ArtemProger\Test\Models\Post;
use ArtemProger\Specification\Filter\Where;
use ArtemProger\Specification\Logic\DoesntHaveX;

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
