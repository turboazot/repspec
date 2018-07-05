<?php

namespace ArtemProger\Test\Specification\Query;

use ArtemProger\Test\TestCase;
use ArtemProger\Specification\Query\GroupBy;

class GroupByTest extends TestCase {

    public function testGroupBy_WithColumn_ModifyQuery()
    {
        $qb = $this->getQueryBuilder();
        $qb->from('users');
        $spec = new GroupBy('col');

        $spec->apply($qb);
        $result = $qb->toSql();

        $expected = 'select * from `users` group by `col`';
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testGroupBy_NoArguments_ThrowAnException()
    {
        $spec = new GroupBy();
    }

}
