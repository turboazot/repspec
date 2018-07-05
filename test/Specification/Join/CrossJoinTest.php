<?php

namespace ArtemProger\Test\Specification\Filter;

use ArtemProger\Specification\Join\CrossJoin;
use ArtemProger\Specification\Join\Join;
use ArtemProger\Specification\Join\On;
use ArtemProger\Test\Models\User;
use ArtemProger\Test\TestCase;

class CrossJoinTest extends TestCase
{
    public function testCrossJoin_WithTableAndCondition_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new CrossJoin('contacts', 'users.id', '=', 'contacts.user_id');

        $spec->apply($query);
        $result = $query->toSql();

        $expected = 'select * from `users` cross join `contacts` on `users`.`id` = `contacts`.`user_id`';
        $this->assertEquals($expected, $result);
    }

    public function testCrossJoin_WithTableAndSpecs_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $prespec = new Join('posts', 'users.id', '=', 'posts.user_id');
        $spec = new CrossJoin('contacts', [
            new On('users.id', '=', 'contacts.user_id'),
            new On('users.type', '=', 'contacts.user_type')
        ]);

        $prespec->apply($query);
        $spec->apply($query);
        $result = $query->toSql();

        $expected = $this->formatOneLineSql('
            select * 
              from `users` 
            inner join `posts` 
                on `users`.`id` = `posts`.`user_id` 
            cross join `contacts` 
                on `users`.`id` = `contacts`.`user_id` 
                and `users`.`type` = `contacts`.`user_type`
        ');
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testJoin_NoArguments_ThrowAnException()
    {
        $spec = new CrossJoin();
    }
}