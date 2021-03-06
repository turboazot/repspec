<?php

namespace ArtemProger\Repspec\Test\Specification\Join;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Test\Models\Post;
use ArtemProger\Repspec\Specification\Join\With;
use ArtemProger\Repspec\Specification\Filter\Where;

class WithTest extends TestCase {

    public function testWith_OneRelation_ModifyQuery()
    {
        $query = $this->getQuery(Post::class);
        $spec = new With('comments');
    
        $spec->apply($query);
        $result = $query->getEagerLoads();

        $this->assertArrayHasKey('comments', $result);
    }

    public function testWith_Array_ModifyQuery()
    {
        $query = $this->getQuery(Post::class);
        $spec = new With(['comments', 'tags']);
    
        $spec->apply($query);
        $result = $query->getEagerLoads();

        $this->assertArrayHasKey('comments', $result);
        $this->assertArrayHasKey('tags', $result);
    }

    public function testWith_RelationAndSpecs_ModifyQuery()
    {
        $query = $this->getQuery(Post::class);
        $spec = new With([
            'comments' => [
                new Where('title', 'like', '%sometitle%')
            ],
            'tags' => [
                new Where('type', '=', 'sometype')
            ]
        ]);
    
        $spec->apply($query);
        $result = $query->getEagerLoads();

        $this->assertArrayHasKey('comments', $result);
        $this->assertArrayHasKey('tags', $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testWith_NoArguments_ModifyQuery()
    {
        $spec = new With();
    }
    
}
