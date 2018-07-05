<?php

namespace ArtemProger\Test\Specification\Filter;

use ArtemProger\Test\TestCase;
use ArtemProger\Specification\Filter\WhereX;
use ArtemProger\Test\Models\User;

class WhereXTest extends TestCase {

    public function testWhereX_WithColOperValue_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new WhereX('field1', '=', 'value1');
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select * from `users` where `field1` = `value1`';
        $this->assertEquals($expected, $result);
    }

    public function testWhereX_WithArray_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new WhereX([
            ['field1', '=', 'other_field1'],
            ['field2', '=', 'other_field2']
        ]);
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select * from `users` where (`field1` = `other_field1` and `field2` = `other_field2`)';
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testWhereX_NoArguments_ThrowAnException()
    {
        $spec = new WhereX();
    }
}
