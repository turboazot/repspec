<?php

namespace ArtemProger\Repspec\Test\Specification\Filter;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Test\Models\User;
use ArtemProger\Repspec\Specification\Filter\In;
use ArtemProger\Repspec\Specification\Filter\Where;

class InTest extends TestCase {

    public function testIn_WithColumnAndValidValue_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new In('id', [1, 2, 3]);
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select * from `users` where `id` in (?, ?, ?)';
        $this->assertEquals($expected, $result);
    }

    public function testOrIn_WithColumnAndValue_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $prespec = new Where('field1', '=', 'value1');
        $spec = new In('id', [1, 2, 3], 'or');
    
        $prespec->apply($query);
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select * from `users` where `field1` = ? or `id` in (?, ?, ?)';
        $this->assertEquals($expected, $result);
    }

    public function testNotIn_WithColumnAndValue_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new In('id', [1, 2, 3], 'and', true);
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select * from `users` where `id` not in (?, ?, ?)';
        $this->assertEquals($expected, $result);
    }

    public function testOrNotIn_WithColumnAndValue_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $prespec = new Where('field1', '=', 'value1');
        $spec = new In('id', [1, 2, 3], 'or', true);
    
        $prespec->apply($query);
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select * from `users` where `field1` = ? or `id` not in (?, ?, ?)';
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testIn_WithNoArguments_ThrowAnException()
    {
        $spec = new In();
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testIn_WithColumnOnly_ThrowAnException()
    {
        $spec = new In('columnOnly');
    }

}
