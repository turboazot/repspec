<?php

namespace ArtemProger\Test\Specification\Filter;

use ArtemProger\Test\TestCase;
use ArtemProger\Test\Models\UserSoftDelete;
use ArtemProger\Specification\Filter\WithTrashed;

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

