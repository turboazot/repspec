<?php

namespace ArtemProger\Test\Specification\Logic;

use ArtemProger\Specification\Filter\Where;
use ArtemProger\Specification\Logic\AndX;
use ArtemProger\Test\Models\User;
use ArtemProger\Test\TestCase;

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
