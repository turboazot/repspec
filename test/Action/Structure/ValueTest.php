<?php

namespace ArtemProger\Test\Action\Structure;

use ArtemProger\Test\TestCase;
use ArtemProger\Action\Structure\Value;

class ValueTest extends TestCase {

    public function testValue_WithColumn_ApplyMethod()
    {
        $methodName = 'value';
        $queryMock = $this->getQueryMock([$methodName]);
        $column = 'first_name';
        $value = 'Stepan Mozaychenko';
    
        $action = new Value($column);
        $queryMock->expects($this->once())
            ->method($methodName)
            ->with($this->equalTo($column))
            ->willReturn($value)
        ;
    
        $result = $action->do($queryMock);
        $expected = $value;
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testValue_NoArguments_ThrowAnException()
    {
        $action = new Value();
    }
}
