<?php

namespace ArtemProger\Test\Specification\Raw;

use ArtemProger\Test\TestCase;
use ArtemProger\Specification\Raw\HavingRaw;
use ArtemProger\Test\Models\User;

class HavingRawTest extends TestCase {

    public function testHavingRaw_WithConditionAndParams_ModifyQuery()
    {
        $qb = $this->getQueryBuilder();
        $qb->from('users');
        $spec = new HavingRaw('SUM(price) > ?', [2500]);
    
        $spec->apply($qb);
        $result = $qb->toSql();
    
        $expected = 'select * from `users` having SUM(price) > ?';
        $this->assertEquals($expected, $result);
    }

    public function testHavingRaw_WithConditionOnly()
    {
        $query = $this->getQuery(User::class);
        $spec = new HavingRaw('SUM(price) > 1000');

        $spec->apply($query);
        $result = $query->toSql();

        $expected = 'select * from `users` having SUM(price) > 1000';
        $this->assertEquals($expected, $result);
    }

    public function testOrHavingRaw_WithConditionAndBoolean_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $prespec = new HavingRaw('SUM(fee) < 10');
        $spec = new HavingRaw('SUM(price) > 1000', [], 'or');
    
        $prespec->apply($query);
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = $this->formatOneLineSql('
            select *
            from `users`
            having SUM(fee) < 10
                or SUM(price) > 1000
        ');
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testHavingRaw_NoArguments_ThrowAnException()
    {
        $spec = new HavingRaw();
    }
}
