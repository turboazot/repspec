<?php

namespace ArtemProger\Repspec\Test\Specification\Join;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Test\Models\User;
use ArtemProger\Repspec\Specification\Join\Join;
use ArtemProger\Repspec\Specification\Join\On;
use ArtemProger\Repspec\Specification\Filter\Where;

class JoinTest extends TestCase {
    
    public function testJoin_WithTableAndCondition_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new Join('contacts', 'users.id', '=', 'contacts.user_id');
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select * from `users` inner join `contacts` on `users`.`id` = `contacts`.`user_id`';
        $this->assertEquals($expected, $result);
    }

    public function testLeftJoin_WithTableAndCondition_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new Join('posts', 'users.id', '=', 'posts.user_id', 'left');
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select * from `users` left join `posts` on `users`.`id` = `posts`.`user_id`';
        $this->assertEquals($expected, $result);
    }

    public function testCrossJoin_WithTable_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new Join('colours', null, null, null, 'cross');
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select * from `users` cross join `colours` on `` = ``';
        $this->assertEquals($expected, $result);
    }

    public function testJoin_WithTableAndSpecs_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new Join('posts', [
            new On('users.id', '=', 'posts.user_id'),
            new Where('posts.title', '=', 'sometitle')
        ]);
    
        $spec->apply($query);
        $result = $query->toSql();

        $expected = $this->formatOneLineSql('
            select * 
              from `users` 
            inner join `posts` 
                on `users`.`id` = `posts`.`user_id` 
                and `posts`.`title` = ?
        ');
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testJoin_NoArguments_ThrowAnException()
    {
        $spec = new Join();
    }
}
