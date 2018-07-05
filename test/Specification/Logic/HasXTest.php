<?php

namespace ArtemProger\Test\Specification\Logic;

use ArtemProger\Specification\Filter\Where;
use ArtemProger\Specification\Logic\HasX;
use ArtemProger\Test\Models\Post;
use ArtemProger\Test\TestCase;

class HasXTest extends TestCase {

    public function testHas_RelationOnly_ModifyQueryExists()
    {
        $query = $this->getQuery(Post::class);
        $spec = new HasX('comments');

        $spec->apply($query);
        $result = $query->toSql();

        $expected = $this->formatOneLineSql('
            select * 
              from `posts` 
             where exists (
                select * 
                  from `comments` 
                 where `posts`.`id` = `comments`.`post_id`
            )
        ');
        $this->assertEquals($expected, $result);
    }

    public function testHas_RelationWithCount_ModifyQueryCount()
    {
        $query = $this->getQuery(Post::class);
        $spec = new HasX('comments', '<=', 3);

        $spec->apply($query);
        $result = $query->toSql();

        $expected = $this->formatOneLineSql('
            select * 
              from `posts` 
             where (
                select count(*) 
                  from `comments` 
                 where `posts`.`id` = `comments`.`post_id`
            ) <= 3
        ');
        $this->assertEquals($expected, $result);
    }

    public function testHas_RelationWithChildrenSpecs_ModifyQueryCount()
    {
        $query = $this->getQuery(Post::class);
        $spec = new HasX(
            'comments', 
            '>=',
            3,
            'and',
            [
                new Where('field1', '=', 'value1'),
                new Where('field2', '>', 'value2')
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
                    and `field2` > ?
            ) >= 3
        ');
        $this->assertEquals($expected, $result);
    }

    public function testOrHas_RelationOnly_ModifyQueryExists()
    {
        $query = $this->getQuery(Post::class);
        $prespec = new Where('field1', '=', 'value1');
        $spec = new HasX('comments', '>=', 1, 'or');

        $prespec->apply($query);
        $spec->apply($query);
        $result = $query->toSql();


        $expected = $this->formatOneLineSql('
            select * 
              from `posts` 
             where `field1` = ? 
                or exists (
                    select * 
                      from `comments` 
                     where `posts`.`id` = `comments`.`post_id`
                )
        ');
        $this->assertEquals($expected, $result);
    }
}

