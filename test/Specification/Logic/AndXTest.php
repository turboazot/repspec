<?php

namespace ArtemProger\Repspec\Test\Specification\Logic;

use ArtemProger\Repspec\Specification\Filter\Where;
use ArtemProger\Repspec\Specification\Logic\AndX;
use ArtemProger\Repspec\Test\Models\User;
use ArtemProger\Repspec\Test\TestCase;

class AndXTest extends TestCase {

    public function testAnd_MultipleSpecs_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new AndX(
            new Where('field1', '=', 'value1'),
            new Where('field2', '=', 'value2')
        );

        $spec->apply($query);
        $result = $query->toSql();
         
        $expected = 'select * from `users` where `field1` = ? and `field2` = ?';
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testAnd_NoArguments_ThrowAnException()
    {
        $spec = new AndX();
    }
}
