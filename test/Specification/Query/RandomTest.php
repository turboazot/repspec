<?php

namespace ArtemProger\Test\Specification\Query;

use ArtemProger\Test\TestCase;
use ArtemProger\Test\Models\User;
use ArtemProger\Specification\Query\Random;

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
