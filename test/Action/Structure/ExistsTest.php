<?php

namespace ArtemProger\Repspec\Test\Action\Structure;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Action\Structure\Exists;

class ExistsTest extends TestCase {

    public function testExists_NoArguments_ReturnExists()
    {
        $methodName = 'exists';
        $queryMock = $this->getQueryMock([$methodName]);
        $isExists = true;
    
        $action = new Exists();
        $queryMock->expects($this->once())
            ->method($methodName)
            ->willReturn($isExists)
        ;
    
        $result = $action->do($queryMock);
        $expected = $isExists;
        $this->assertEquals($expected, $result);
    }
}
