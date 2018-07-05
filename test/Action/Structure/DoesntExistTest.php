<?php

namespace ArtemProger\Repspec\Test\Action\Structure;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Action\Structure\DoesntExist;

class DoesntExistTest extends TestCase {

    public function testDoesntExist_NoArguments_ReturnDoesntExist()
    {
        $methodName = 'doesntExist';
        $queryMock = $this->getQueryMock([$methodName]);
        $isExist = true;
    
        $action = new DoesntExist();
        $queryMock->expects($this->once())
            ->method($methodName)
            ->willReturn($isExist)
        ;
    
        $result = $action->do($queryMock);
        $expected = $isExist;
        $this->assertEquals($expected, $result);
    }
}
