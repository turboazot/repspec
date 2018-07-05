<?php

namespace ArtemProger\Test\Specification\Join;

use ArtemProger\Test\TestCase;
use ArtemProger\Test\Models\Post;
use ArtemProger\Specification\Join\WithCount;
use ArtemProger\Specification\Filter\Where;

class WithCountTest extends TestCase {

    public function testWithCount_OneRelation_RelationKeyExists()
    {
        $query = $this->getQuery(Post::class);
        $spec = new WithCount('comments');
    
        $spec->apply($query);
        $result = $query->toSql();

        $expected = $this->formatOneLineSql('
            select `posts`.*, 
                (
                    select count(*) 
                      from `comments` 
                     where `posts`.`id` = `comments`.`post_id`
                ) as `comments_count` 
            from `posts`
        ');
        $this->assertEquals($expected, $result);
    }

    public function testWithCount_RelationsArray_ModifyQuery()
    {
        $query = $this->getQuery(Post::class);
        $spec = new WithCount(['comments', 'tags']);
    
        $spec->apply($query);
        $result = $query->toSql();

        $expected = $this->formatOneLineSql('
            select `posts`.*, 
                (
                    select count(*) 
                    from `comments` 
                    where `posts`.`id` = `comments`.`post_id`
                ) as `comments_count`, 
                (
                    select count(*) 
                    from `tags` 
                    where `posts`.`post_tag` = `tags`.`post_id`
                ) as `tags_count` 
            from `posts`
        ');
        $this->assertEquals($expected, $result);
    }

    public function testWithCount_RelationsWithClosureArray_ModifyQuery()
    {
        $query = $this->getQuery(Post::class);
        $spec = new WithCount([
            'comments' => [
                new Where('content', 'like', '%foo')
            ],
            'tags' => [
                new Where('type', '=', 'some')
            ]
        ]);
    
        $spec->apply($query);
        $result = $query->toSql();

    
        $expected = $this->formatOneLineSql('
            select `posts`.*, 
                (
                    select count(*) 
                      from `comments` 
                     where `posts`.`id` = `comments`.`post_id` 
                        and `content` like ? 
                        and `type` = ?
                ) as `comments_count`, 
                (
                    select count(*) 
                      from `tags` 
                     where `posts`.`post_tag` = `tags`.`post_id` 
                        and `content` like ? 
                        and `type` = ?
                ) as `tags_count` 
            from `posts`
        ');
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testWithCount_NoArguments_ThrowAnException()
    {
        $spec = new WithCount();
    }
}
