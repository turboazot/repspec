<?php

namespace ArtemProger\Repspec\Test\Specification\Filter;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Specification\Join\Join;
use ArtemProger\Repspec\Test\Models\User;
use ArtemProger\Repspec\Specification\Join\On;

class OnTest extends TestCase {

    public function testOn_WithCondition_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new Join('posts', [
            new On('users.id', '=', 'posts.user_id')
        ]);
    
        $spec->apply($query);
        $result = $query->toSql();
    
        $expected = 'select * from `users` inner join `posts` on `users`.`id` = `posts`.`user_id`';
        $this->assertEquals($expected, $result);
    }

    public function testOrOn_WithCondition_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new Join('posts', [
            new On('users.id', '=', 'posts.user_id'),
            new On('posts.type', '=', 'user.type', 'or')
        ]);
    
        $spec->apply($query);
        $result = $query->toSql();

        $expected = $this->formatOneLineSql('
            select * 
              from `users` 
            inner join `posts` 
                on `users`.`id` = `posts`.`user_id` 
                or `posts`.`type` = `user`.`type`
        ');
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testOn_NoArguments_ThrowAnException()
    {
        $spec = new On();
    }
}
