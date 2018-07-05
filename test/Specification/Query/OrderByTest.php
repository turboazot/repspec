<?php

namespace ArtemProger\Repspec\Test\Specification\Query;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Specification\Query\OrderBy;
use ArtemProger\Repspec\Test\Models\User;

class OrderByTest extends TestCase {

    public function testOrderBy_WithColumn_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new OrderBy('field1');
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = $this->formatOneLineSql('
            select * from `users` order by `field1` asc
        ');
        $this->assertEquals($expected, $result);
    }

    public function testOrderBy_WithColumnAndType_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new OrderBy('field1', 'desc');
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = $this->formatOneLineSql('
            select * from `users` order by `field1` desc
        ');
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testOrderBy_WithColumnAndInvalidType_ThrowAnException()
    {
        $spec = new OrderBy('field1', 'invalid_type');
    }
}
