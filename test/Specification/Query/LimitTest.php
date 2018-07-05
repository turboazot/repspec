<?php

namespace ArtemProger\Test\Specification\Query;

use ArtemProger\Test\TestCase;
use ArtemProger\Specification\Query\Limit;

class LimitTest extends TestCase {

    public function testLimit_WithValue_ModifyQuery()
    {
        $qb = $this->getQueryBuilder();
        $qb->from('users');
        $spec = new Limit(10);
    
        $spec->apply($qb);
        $result = $qb->toSql();
    
        $expected = 'select * from `users` limit 10';
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testLimit_NoArguments_ThrowAnException()
    {
        $spec = new Limit();
    }
}
