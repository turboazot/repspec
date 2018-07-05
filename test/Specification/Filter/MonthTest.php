<?php

namespace ArtemProger\Test\Specification\Filter;

use ArtemProger\Specification\Filter\Where;
use ArtemProger\Test\TestCase;
use ArtemProger\Test\Models\User;
use ArtemProger\Specification\Filter\Month;

class MonthTest extends TestCase {

    public function testMonth_WithColumnAndDate_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new Month('field1', '>', '2016-12-31');

        $spec->apply($query);
        $result = $query->toSql();

        $expected = 'select * from `users` where month(`field1`) > ?';
        $this->assertEquals($expected, $result);
    }

    public function testOrMonth_WithColumnAndDate_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $prespec = new Where('field1', '=', 'value1');
        $spec = new Month('field1', '>', '2016-12-31', 'or');

        $prespec->apply($query);
        $spec->apply($query);
        $result = $query->toSql();

        $expected = 'select * from `users` where `field1` = ? or month(`field1`) > ?';
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testMonth_WithInvalidOperator_ThrowInvalidArgumentException()
    {
        $operator = 'like';
        $spec = new Month('field1', $operator, '2016-12-31');
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testMonth_WithColumnOnly_ThrowArgumentCountError()
    {
        $spec = new Month('field1');
    }


    /**
     * @expectedException ArgumentCountError
     */
    public function testMonth_NoArguments_ThrowArgumentCountError()
    {
        $spec = new Month();
    }
}
