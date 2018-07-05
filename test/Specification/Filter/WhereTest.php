<?php

namespace ArtemProger\Repspec\Test\Specification\Filter;

use ArtemProger\Repspec\Specification\Filter\Where;
use ArtemProger\Repspec\Test\Models\User;
use ArtemProger\Repspec\Test\TestCase;

class WhereTest extends TestCase {

    public function testWhere_WithColOperValue_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new Where('field1', '=', 100);
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select * from `users` where `field1` = ?';
        $this->assertEquals($expected, $result);
    }

    public function testWhere_Array_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new Where([
            ['status', '=', 1],
            ['subscribed', '=', 2]
        ]);
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select * from `users` where (`status` = ? and `subscribed` = ?)';
        $this->assertEquals($expected, $result);
    }

    public function testOrWhere_WithColOperValue_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $prespec = new Where('prefield', '=', 'value1');
        $spec = new Where('field1', '=', 100, 'or');
    
        $prespec->apply($query);
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select * from `users` where `prefield` = ? or `field1` = ?';
        $this->assertEquals($expected, $result);
    }

    public function testWhereNot_WithColOperValue_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new Where('field1', '<>', 1);
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select * from `users` where `field1` <> ?';
        $this->assertEquals($expected, $result);
    }

    public function testOrWhereNot_WithColOperValue_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $prespec = new Where('field1', '=', 1);
        $spec = new Where('field2', '<>', 2, 'or');
    
        $prespec->apply($query);
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select * from `users` where `field1` = ? or `field2` <> ?';
        $this->assertEquals($expected, $result);
    }

    public function testWhere_WithColOnly_ModifyQueryIsNull()
    {
        $query = $this->getQuery(User::class);
        $spec = new Where('columnOnly');
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select * from `users` where `columnOnly` is null';
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testWhere_NoArguments_ThrowAnException()
    {
        $spec = new Where();
    }
}
