<?php

namespace ArtemProger\Test\Specification\Query;

use ArtemProger\Test\TestCase;
use ArtemProger\Specification\Query\Having;

class HavingTest extends TestCase {

    public function testHaving_WithCondition_ModifyQuery()
    {
        $qb = $this->getQueryBuilder();
        $qb->from('users');
        $spec = new Having('field1', '=', 100);
    
        $spec->apply($qb);
        $result = $qb->toSql();
    
        $expected = 'select * from `users` having `field1` = ?';
        $this->assertEquals($expected, $result);
    }

    public function testOrHaving_WithCondition_ModifyQuery()
    {
        $qb = $this->getQueryBuilder();
        $qb->from('users');
        $prespec = new Having('field1', '>', 3);
        $spec = new Having('field1', '=', 100, 'or');

        $prespec->apply($qb);
        $spec->apply($qb);
        $result = $qb->toSql();

        $expected = 'select * from `users` having `field1` > ? or `field1` = ?';
        $this->assertEquals($expected, $result);
    }

    public function testHaving_WithOperatorAndColOnly_ThrowAnException()
    {
        $qb = $this->getQueryBuilder();
        $qb->from('users');
        $spec = new Having('field1', '=');

        $spec->apply($qb);
        $result = $qb->toSql();

        $expected = 'select * from `users` having `field1` = ?';
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testHaving_NoArguments_ThrowAnException()
    {
        $spec = new Having();
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testHaving_WithInvalidOperator_ThrowAnException()
    {
        $spec = new Having('field1', '~', 100);
    }
}
