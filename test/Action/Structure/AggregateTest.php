<?php

namespace ArtemProger\Test\Action\Structure;

use ArtemProger\Test\TestCase;
use ArtemProger\Action\Structure\Aggregate;

class AggregateTest extends TestCase {

    public function testAggregate_WithFunctionAndColumn_ApplyMethod()
    {
        $methodName = 'avg';
        $queryMock = $this->getQueryMock([$methodName]);
        $column = 'field1';
        $value = 3;

    
        $action = new Aggregate($methodName, $column);
        $queryMock->expects($this->once())
            ->method($methodName)
            ->with(
                $this->equalTo($column)
            )
            ->willReturn($value)
        ;
    
        $result = $action->do($queryMock);
        $expected = $value;
        $this->assertEquals($expected, $result);
    }


    public function testAggregate_WithFunctionOnly_ApplyMethod()
    {
        $methodName = 'avg';
        $queryMock = $this->getQueryMock([$methodName]);
        $value = 3;

        $action = new Aggregate($methodName);
        $queryMock->expects($this->once())
            ->method($methodName)
            ->with(
                $this->equalTo(['*'])
            )
            ->willReturn($value)
        ;
    
        $result = $action->do($queryMock);
        $expected = $value;
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testAggregate_WithNonExistingFunction_ThrowAnException()
    {
        $action = new Aggregate('nonExistingFunction', 'column');
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testAggregate_NoArguments_ThrowAnException()
    {
        $action = new Aggregate();
    }
}
