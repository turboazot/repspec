<?php

namespace ArtemProger\Repspec\Test\Action\Structure;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Action\Structure\Aggregate;

class AggregateTest extends TestCase {

    public function testAggregate_WithFunctionAndColumn_ApplyMethod()
    {
        $methodName = 'avg';
        $builderMethod = 'aggregate';
        $queryMock = $this->getQueryMock([$methodName, $builderMethod]);
        $column = 'field1';
        $value = 3;

    
        $action = new Aggregate($methodName, [$column]);
        $queryMock->expects($this->once())
            ->method('aggregate')
            ->with(
                $this->equalTo($methodName),
                $this->equalTo([$column])
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
        $builderMethod = 'aggregate';
        $queryMock = $this->getQueryMock([$methodName, $builderMethod]);
        $value = 3;
        $column = 'field1';

        $action = new Aggregate($methodName, [$column]);
        $queryMock->expects($this->once())
            ->method('aggregate')
            ->with(
                $this->equalTo($methodName),
                $this->equalTo([$column])
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
