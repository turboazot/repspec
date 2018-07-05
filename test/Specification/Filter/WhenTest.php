<?php

namespace ArtemProger\Repspec\Test\Specification\Filter;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Specification\Filter\Where;
use ArtemProger\Repspec\Specification\Filter\When;
use ArtemProger\Repspec\Test\Models\User;

class WhenTest extends TestCase {

    public function testWhen_True_ApplySpecs()
    {
        $query = $this->getQuery(User::class);
        $spec = new When(
            true,
            [
                new Where('field1', '=', 'value1')
            ]
        );
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select * from `users` where `field1` = ?';
        $this->assertEquals($expected, $result);
    }

    public function testWhen_False_SpecsDontApply()
    {
        $query = $this->getQuery(User::class);
        $spec = new When(
            false,
            [
                new Where('field1', '=', 'value1')
            ]
        );
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select * from `users`';
        $this->assertEquals($expected, $result);
    }

    public function testWhen_FalseWithFalseSpecs_ApplyFalseSpecs()
    {
        $query = $this->getQuery(User::class);
        $spec = new When(
            false,
            [
                new Where('field1', '=', 'value1')
            ],
            [
                new Where('field2', '>', 'value2')
            ]
        );
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select * from `users` where `field2` > ?';
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testWhen_NoArguments_ThrowAnException()
    {
        $spec = new When();
    }
}
