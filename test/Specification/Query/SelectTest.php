<?php

namespace ArtemProger\Repspec\Test\Specification\Query;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Specification\Query\Select;
use ArtemProger\Repspec\Test\Models\User;

class SelectTest extends TestCase {

    public function testSelect_WithTwoColuns_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new Select('field1', 'field2');
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = $this->formatOneLineSql('
            select `field1`, `field2` from `users`
        ');
        $this->assertEquals($expected, $result);
    }

    public function testSelect_WithAliases_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new Select('field1 as alias1', 'field2 as alias2');
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = $this->formatOneLineSql('
            select `field1` as `alias1`, `field2` as `alias2` from `users` 
        ');
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testSelect_NoArguments_ThrowAnException()
    {
        $spec = new Select();
    }
}
