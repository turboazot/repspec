<?php

namespace ArtemProger\Repspec\Test\Specification\Query;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Specification\Query\Distinct;
use ArtemProger\Repspec\Test\Models\User;

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
