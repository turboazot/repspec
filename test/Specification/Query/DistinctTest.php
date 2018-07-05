<?php

namespace ArtemProger\Test\Specification\Query;

use ArtemProger\Test\TestCase;
use ArtemProger\Specification\Query\Distinct;
use ArtemProger\Test\Models\User;

class DistinctTest extends TestCase {

    public function testDistinct_NoArguments_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new Distinct();
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select distinct * from `users`';
        $this->assertEquals($expected, $result);
    }
    
}
