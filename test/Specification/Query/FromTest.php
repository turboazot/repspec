<?php

namespace ArtemProger\Repspec\Test\Specification\Query;

use ArtemProger\Repspec\Test\TestCase;
use Doctrine\DBAL\Query\QueryBuilder;
use ArtemProger\Repspec\Specification\Query\From;
use Doctrine\DBAL\Connection;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as Query;

class FromTest extends TestCase {

    public function testFrom_WithTable_ModifyQuery()
    {
        $qb = $this->getQueryBuilder();
        $spec = new From('table');

        $spec->apply($qb);
        $result = $qb->toSql();

        $expected = 'select * from `table`';
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testFrom_NoArguments_ThrowAnException()
    {
        $spec = new From();
    }
    
}
