<?php

namespace ArtemProger\Repspec\Test\Action\Manipulation\Query;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Action\Manipulation\Query\Decrement;

class DecrementTest extends TestCase {

    public function testDecrement_WithColumnAndAmount_ApplyMethod()
    {
        $methodName = 'decrement';
        $column = 'votes';
        $amount = 3;

        $queryMock = $this->getQueryMock([$methodName]);
        $queryMock
            ->expects($this->once())
            ->method($methodName)
            ->with(
                $this->equalTo($column),
                $this->equalTo($amount)
            )
        ;
        
    
        $action = new Decrement($column, $amount);
        $action->do($queryMock);
    }

    public function testDecrement_WithColumnOnly_ApplyMethod()
    {
        $methodName = 'decrement';
        $column = 'votes';

        $queryMock = $this->getQueryMock([$methodName]);
        $queryMock
            ->expects($this->once())
            ->method($methodName)
            ->with($this->equalTo($column))
        ;
        
    
        $action = new Decrement($column);
        $action->do($queryMock);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testDecrement_NoArguments_ThrowAnException()
    {
        $action = new Decrement();
    }
    
}
