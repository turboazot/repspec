<?php

namespace ArtemProger\Repspec\Test\Specification\Raw;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Test\Models\User;
use ArtemProger\Repspec\Specification\Raw\SelectRaw;

class SelectRawTest extends TestCase {

    public function testSelectRaw_ColumnsWithParams_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new SelectRaw('price * ? as price_with_tax', [100]);
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = $this->formatOneLineSql('
            select price * ? as price_with_tax from `users`
        ');
        $this->assertEquals($expected, $result);
    }

    public function testSelectRaw_ColumnOnly_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new SelectRaw('price * 100 as price_with_tax');
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = $this->formatOneLineSql('
            select price * 100 as price_with_tax from `users`
        ');
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testSelectRaw_NoArguments_ThrowAnException()
    {
        $spec = new SelectRaw();
    }
}
