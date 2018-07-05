<?php

namespace ArtemProger\Repspec\Test\Specification\Filter;

use ArtemProger\Repspec\Specification\Filter\ExistsX;
use ArtemProger\Repspec\Specification\Filter\Where;
use ArtemProger\Repspec\Specification\Query\From;
use ArtemProger\Repspec\Specification\Query\Select;
use ArtemProger\Repspec\Test\Models\User;
use ArtemProger\Repspec\Test\TestCase;
use Illuminate\Database\Query\Builder;

class ExistsXTest extends TestCase {
    
    public function testExistsX_WithTwoSpecs_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new ExistsX([
            new Select(1),
            new From('other_table'),
            new Where('field1', '=', 'value1'),
            new Where('field2', '>', 'value2')
        ]);

        $spec->apply($query);
        $result = $query->toSql();

        $expected = $this->formatOneLineSql('
            select * 
              from `users` 
             where exists (
                select `1` 
                  from `other_table` 
                 where `field1` = ? 
                   and `field2` > ?
            )        
        ');
        $this->assertEquals($expected, $result);
    }

    public function testOrExistsX_WithTwoSpecs_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $prespec = new Where('field1', '=', 'value1');
        $spec = new ExistsX([
            new Select(1),
            new From('other_table'),
            new Where('field1', '=', 'value1'),
            new Where('field2', '>', 'value2')
        ], 'or');

        $prespec->apply($query);
        $spec->apply($query);
        $result = $query->toSql();

        $expected = $this->formatOneLineSql('
            select * 
              from `users` 
             where `field1` = ? 
                or exists (
                    select `1` 
                      from `other_table` 
                     where `field1` = ? 
                       and `field2` > ?
                )            
        ');
        $this->assertEquals($expected, $result);
    }

    public function testNotExistsX_WithTwoSpecs_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $spec = new ExistsX([
            new Select(1),
            new From('other_table'),
            new Where('field1', '=', 'value1'),
            new Where('field2', '>', 'value2')
        ], 'and', true);

        $spec->apply($query);
        $result = $query->toSql();

        $expected = $this->formatOneLineSql('
            select * 
              from `users` 
             where not exists (
                select `1` 
                  from `other_table` 
                 where `field1` = ? 
                   and `field2` > ?
             )        
        ');
        $this->assertEquals($expected, $result);
    }

    public function testOrNotExistsX_WithTwoSpecs_ModifyQuery()
    {
        $query = $this->getQuery(User::class);
        $prespec = new Where('field1', '=', 'value1');
        $spec = new ExistsX([
            new Select(1),
            new From('other_table'),
            new Where('field1', '=', 'value1'),
            new Where('field2', '>', 'value2')
        ], 'or', true);

        $prespec->apply($query);
        $spec->apply($query);
        $result = $query->toSql();

        $expected = $this->formatOneLineSql('
            select * 
              from `users` 
             where `field1` = ? 
            or not exists (
                select `1` 
                from `other_table` 
                where `field1` = ? 
                and `field2` > ?
            )
        ');
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testExistsX_NoArguments_ThrowAnException()
    {
        $spec = new ExistsX();
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testExistsX_WithoutSelect_ThrowAnException()
    {
        $spec = new ExistsX([
            new From('other_table'),
            new Where('field1', '=', 'value1')
        ]);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testExistsX_WithoutFrom_ThrowAnException()
    {
        $spec = new ExistsX([
            new Select('other_table'),
            new Where('field1', '=', 'value1')
        ]);
    }
}
