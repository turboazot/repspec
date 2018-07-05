<?php

namespace ArtemProger\Test\Specification\Filter;

use ArtemProger\Specification\Filter\Where;
use ArtemProger\Test\TestCase;
use ArtemProger\Test\Models\User;
use ArtemProger\Specification\Filter\Time;

class TimeTest extends TestCase {

    public function testTime_WithColumnAndDate_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new Time('field1', '>', '2016-12-31');

        $spec->apply($query);
        $result = $query->toSql();

        $expected = 'select * from `users` where time(`field1`) > ?';
        $this->assertEquals($expected, $result);
    }

    public function testOrTime_WithColumnAndDate_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $prespec = new Where('field1', '=', 'value1');
        $spec = new Time('field1', '>', '2016-12-31', 'or');

        $prespec->apply($query);
        $spec->apply($query);
        $result = $query->toSql();

        $expected = 'select * from `users` where `field1` = ? or time(`field1`) > ?';
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testTime_WithInvalidOperator_ThrowInvalidArgumentException()
    {
        $operator = 'like';
        $spec = new Time('field1', $operator, '2016-12-31');
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testTime_WithColumnOnly_ThrowArgumentCountError()
    {
        $spec = new Time('field1');
    }


    /**
     * @expectedException ArgumentCountError
     */
    public function testTime_NoArguments_ThrowArgumentCountError()
    {
        $spec = new Time();
    }
}
