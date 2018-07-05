<?php

namespace ArtemProger\Repspec\Test\Specification\Filter;

use ArtemProger\Repspec\Specification\Filter\Where;
use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Test\Models\User;
use ArtemProger\Repspec\Specification\Filter\Date;

class DateTest extends TestCase {

    public function testDate_WithColumnAndDate_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new Date('field1', '>', '2016-12-31');

        $spec->apply($query);
        $result = $query->toSql();

        $expected = 'select * from `users` where date(`field1`) > ?';
        $this->assertEquals($expected, $result);
    }

    public function testOrDate_WithColumnAndDate_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $prespec = new Where('field1', '=', 'value1');
        $spec = new Date('field1', '>', '2016-12-31', 'or');

        $prespec->apply($query);
        $spec->apply($query);
        $result = $query->toSql();

        $expected = 'select * from `users` where `field1` = ? or date(`field1`) > ?';
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDate_WithInvalidOperator_ThrowInvalidArgumentException()
    {
        $operator = 'like';
        $spec = new Date('field1', $operator, '2016-12-31');
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testDate_WithColumnOnly_ThrowArgumentCountError()
    {
        $spec = new Date('field1');
    }


    /**
     * @expectedException ArgumentCountError
     */
    public function testDate_NoArguments_ThrowArgumentCountError()
    {
        $spec = new Date();
    }
}
