<?php

namespace ArtemProger\Repspec\Test\Specification\Filter;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Test\Models\User;
use ArtemProger\Repspec\Specification\Filter\IsNull;
use ArtemProger\Repspec\Specification\Filter\Where;

class IsNullTest extends TestCase {

    public function testIsNull_WithColumn_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new IsNull('updated_at');
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select * from `users` where `updated_at` is null';
        $this->assertEquals($expected, $result);
    }

    public function testOrIsNull_WithColumn_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $prespec = new Where('field1', '=', 'value1');
        $spec = new IsNull('updated_at', 'or');
    
        $prespec->apply($query);
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select * from `users` where `field1` = ? or `updated_at` is null';
        $this->assertEquals($expected, $result);
    }

    public function testIsNotNull_WithColumn_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new IsNull('updated_at', 'and', true);
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select * from `users` where `updated_at` is not null';
        $this->assertEquals($expected, $result);
    }

    public function testOrIsNotNull_WithColumn_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $prespec = new Where('field1', '=', 'value1');
        $spec = new IsNull('updated_at', 'or', true);
    
        $prespec->apply($query);
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select * from `users` where `field1` = ? or `updated_at` is not null';
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testIsNull_NoArguments_ThrowAnException()
    {
        $spec = new IsNull();
    }
}
