<?php

namespace ArtemProger\Repspec\Test\Specification\Filter;

use ArtemProger\Repspec\Specification\Filter\Where;
use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Test\Models\User;
use ArtemProger\Repspec\Specification\Filter\Day;

class DayTest extends TestCase {

    public function testDay_WithColumnAndDay_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new Day('field1', '>', '2016-12-31');

        $spec->apply($query);
        $result = $query->toSql();

        $expected = 'select * from `users` where day(`field1`) > ?';
        $this->assertEquals($expected, $result);
    }

    public function testOrDay_WithColumnAndDay_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $prespec = new Where('field1', '=', 'value1');
        $spec = new Day('field1', '>', '2016-12-31', 'or');

        $prespec->apply($query);
        $spec->apply($query);
        $result = $query->toSql();

        $expected = 'select * from `users` where `field1` = ? or day(`field1`) > ?';
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDay_WithInvalidOperator_ThrowInvalidArgumentException()
    {
        $operator = 'like';
        $spec = new Day('field1', $operator, '2016-12-31');
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testDay_WithColumnOnly_ThrowArgumentCountError()
    {
        $spec = new Day('field1');
    }


    /**
     * @expectedException ArgumentCountError
     */
    public function testDay_NoArguments_ThrowArgumentCountError()
    {
        $spec = new Day();
    }
}
