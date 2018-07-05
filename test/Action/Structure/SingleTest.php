<?php

namespace ArtemProger\Repspec\Test\Action\Structure;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Action\Structure\Single;
use ArtemProger\Repspec\Test\Models\User;

class SingleTest extends TestCase {

    public function testSingle_NoArguments_ReturnSingle()
    {
        $methodName = 'first';
        $queryMock = $this->getQueryMock([$methodName]);
        $first = new User;
    
        $action = new Single();
        $queryMock->expects($this->once())
            ->method($methodName)
            ->willReturn($first)
        ;
    
        $result = $action->do($queryMock);
        $expected = $first;
        $this->assertEquals($expected, $result);
    }
    
}

