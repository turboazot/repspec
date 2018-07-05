<?php

namespace ArtemProger\Test\Specification\Filter;

use ArtemProger\Specification\Filter\Between;
use ArtemProger\Test\TestCase;
use ArtemProger\Test\Models\User;
use ArtemProger\Specification\Filter\Where;

class BeetweenTest extends TestCase {

    public function testBetween_WithColumnAndValidValue_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new Between('votes', [1, 100]);

        $spec->apply($query);
        $result = $query->toSql();

        $expected = 'select * from `users` where `votes` between ? and ?';
        $this->assertEquals($expected, $result);
    }

    public function testOrBetween_WithColumnAndValidValue_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $prespec = new Where('field1', '=', 'value1');
        $spec = new Between('votes', [1, 100], 'or');
    
        $prespec->apply($query);
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select * from `users` where `field1` = ? or `votes` between ? and ?';
        $this->assertEquals($expected, $result);
    }

    public function testNotBetween_WithColumnAndValidValue_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new Between('votes', [1, 100], 'and', true);
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select * from `users` where `votes` not between ? and ?';
        $this->assertEquals($expected, $result);
    }

    public function testOrNotBetween_WithColumnAndValidValue_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $prespec = new Where('field1', '=', 'value1');
        $spec = new Between('votes', [1, 100], 'or', true);
    
        $prespec->apply($query);
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select * from `users` where `field1` = ? or `votes` not between ? and ?';
        $this->assertEquals($expected, $result);
    }


    /**
     * @expectedException ArgumentCountError
     */
    public function testBetween_WithNoArguments_ThrowAnException()
    {
        $spec = new Between();
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testBetween_WithColumnOnly_ThrowAnException()
    {
        $spec = new Between('columnOnly');
    }
}
