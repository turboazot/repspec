<?php

namespace ArtemProger\Repspec\Test\Specification\Query;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Test\Models\User;
use ArtemProger\Repspec\Specification\Query\Random;

class RandomTest extends TestCase {

    public function testRandom_NoArguments_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new Random();
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = $this->formatOneLineSql('
            select * from `users` order by RAND()
        ');
        $this->assertEquals($expected, $result);
    }
}
