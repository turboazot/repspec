<?php

namespace ArtemProger\Repspec\Test\Specification\Query;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Specification\Query\Offset;

class OffsetTest extends TestCase {

    public function testOffset_WithValue_ModifyQuery()
    {
        $qb = $this->getQueryBuilder();
        $qb->from('users');
        $spec = new Offset(10);
    
        $spec->apply($qb);
        $result = $qb->toSql();
    
        $expected = 'select * from `users` offset 10';
        $this->assertEquals($expected, $result);
    }


    /**
     * @expectedException ArgumentCountError
     */
    public function testOffset_NoArguments_ThrowAnException()
    {
        $spec = new Offset();
    }
}
