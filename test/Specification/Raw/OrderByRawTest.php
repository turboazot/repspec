<?php

namespace ArtemProger\Test\Specification\Raw;

use ArtemProger\Test\TestCase;
use ArtemProger\Test\Models\User;
use ArtemProger\Specification\Raw\OrderByRaw;

class OrderBy extends TestCase {

    public function testOrderByRaw_WithColumn_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new OrderByRaw('updated_at - created_at DESC');
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = $this->formatOneLineSql('
            select * from `users` order by updated_at - created_at DESC
        ');
        $this->assertEquals($expected, $result);
    }

    public function testOrderByRaw_WithColumnAndParams_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new OrderByRaw('price - ?', [100]);
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = $this->formatOneLineSql('
            select * from `users` order by price - ?
        ');
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testOrderByRaw_NoArguments_ModifyQuery()
    {
        $spec = new OrderByRaw();
    }

}
