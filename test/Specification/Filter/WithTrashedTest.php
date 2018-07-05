<?php

namespace ArtemProger\Repspec\Test\Specification\Filter;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Test\Models\UserSoftDelete;
use ArtemProger\Repspec\Specification\Filter\WithTrashed;

class WithTrashedTest extends TestCase {

    public function testWithTrashed_NoArguments_ModifyQuery()
    {
        $query = $this->getQuery(UserSoftDelete::class);
        $spec = new WithTrashed();
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select * from `users`';
        $this->assertEquals($expected, $result);
    }
}

