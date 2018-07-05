<?php

namespace ArtemProger\Repspec\Test\Action\Lock;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Action\Lock\Lock;

class LockTest extends TestCase {

    public function testLock_WithValue_ApplyMethod()
    {
        $methodName = 'lock';
        $queryMock = $this->getQueryMock([$methodName]);
        $value = false;
    
        $action = new Lock($value);
        $queryMock->expects($this->once())
            ->method($methodName)
            ->with($this->equalTo($value))
            ->willReturn($queryMock)
        ;
    
        $result = $action->do($queryMock);
        $expected = $queryMock;
        $this->assertEquals($expected, $result);
    }

    public function testLock_NoArguments_ApplyMethodWithTrue()
    {
        $methodName = 'lock';
        $queryMock = $this->getQueryMock([$methodName]);
    
        $action = new Lock();
        $queryMock->expects($this->once())
            ->method($methodName)
            ->with($this->equalTo(true))
            ->willReturn($queryMock)
        ;
    
        $result = $action->do($queryMock);
        $expected = $queryMock;
        $this->assertEquals($expected, $result);
    }
}
