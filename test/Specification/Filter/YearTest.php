<?php

namespace ArtemProger\Test\Specification\Filter;

use ArtemProger\Specification\Filter\Where;
use ArtemProger\Test\TestCase;
use ArtemProger\Test\Models\User;
use ArtemProger\Specification\Filter\Year;

class YearTest extends TestCase {

    public function testYear_WithColumnAndDate_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new Year('field1', '>', '2016-12-31');

        $spec->apply($query);
        $result = $query->toSql();

        $expected = 'select * from `users` where year(`field1`) > ?';
        $this->assertEquals($expected, $result);
    }

    public function testOrYear_WithColumnAndDate_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $prespec = new Where('field1', '=', 'value1');
        $spec = new Year('field1', '>', '2016-12-31', 'or');

        $prespec->apply($query);
        $spec->apply($query);
        $result = $query->toSql();

        $expected = 'select * from `users` where `field1` = ? or year(`field1`) > ?';
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testYear_WithInvalidOperator_ThrowInvalidArgumentException()
    {
        $operator = 'like';
        $spec = new Year('field1', $operator, '2016-12-31');
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testYear_WithColumnOnly_ThrowArgumentCountError()
    {
        $spec = new Year('field1');
    }


    /**
     * @expectedException ArgumentCountError
     */
    public function testYear_NoArguments_ThrowArgumentCountError()
    {
        $spec = new Year();
    }
}
