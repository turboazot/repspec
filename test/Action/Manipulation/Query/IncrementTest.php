<?php

namespace ArtemProger\Test\Action\Manipulation\Query;

use ArtemProger\Test\TestCase;
use ArtemProger\Action\Manipulation\Query\Increment;

class IncrementTest extends TestCase {

    public function testIncrement_WithColumnAndAmount_ApplyMethod()
    {
        $methodName = 'increment';
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
        
    
        $action = new Increment($column, $amount);
        $action->do($queryMock);
    }

    public function testIncrement_WithColumnOnly_ApplyMethod()
    {
        $methodName = 'increment';
        $column = 'votes';

        $queryMock = $this->getQueryMock([$methodName]);
        $queryMock
            ->expects($this->once())
            ->method($methodName)
            ->with($this->equalTo($column))
        ;
        
    
        $action = new Increment($column);
        $action->do($queryMock);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testIncrement_NoArguments_ThrowAnException()
    {
        $action = new Increment();
    }
    
}

