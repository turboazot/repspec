<?php

namespace ArtemProger\Repspec\Test\Specification\Filter;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Specification\Filter\OnlyTrashed;
use ArtemProger\Repspec\Test\Models\UserSoftDelete;

class OnlyTrashedTest extends TestCase {

    public function testOnlyTrashed_NoArguments_ModifyQuery()
    {
        $query = $this->getQuery(UserSoftDelete::class);
        $spec = new OnlyTrashed();
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select * from `users` where `users`.`deleted_at` is not null';
        $this->assertEquals($expected, $result);
    }
}
