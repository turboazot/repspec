<?php

namespace ArtemProger\Test\Specification\Raw;

use ArtemProger\Test\TestCase;
use ArtemProger\Test\Models\User;
use ArtemProger\Specification\Raw\WhereRaw;

class WhereRawTest extends TestCase {

    public function testWhereRaw_WithColumnsAndParams_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new WhereRaw('price > IF(state = "TX", ?, 100)', [200]);
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = $this->formatOneLineSql('
            select * 
              from `users` 
             where price > IF(state = "TX", ?, 100)
        ');
        $this->assertEquals($expected, $result);
    }

    public function testWhereRaw_WithColumns_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new WhereRaw('price > IF(state = "TX", 200, 100)');
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = $this->formatOneLineSql('
            select * 
              from `users` 
             where price > IF(state = "TX", 200, 100)
        ');
        $this->assertEquals($expected, $result);
    }

    public function testOrWhereRaw_WithColumnsAndParams_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $prespec = new WhereRaw('price < ?', [100]);
        $spec = new WhereRaw('price > IF(state = "TX", ?, 100)', [200], 'or');
    
        $prespec->apply($query);
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = $this->formatOneLineSql('
            select * 
              from `users` 
             where price < ? 
                or price > IF(state = "TX", ?, 100)
        ');
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testWhereRaw_NoArguments_ThrowAnException()
    {
        $spec = new WhereRaw();
    }
}
