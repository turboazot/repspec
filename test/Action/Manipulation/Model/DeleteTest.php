<?php

namespace ArtemProger\Repspec\Test\Action\Manipulation\Model;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Action\Manipulation\Model\Delete;

class DeleteTest extends TestCase {

    public function testDelete_NoArguments_ApplyMethod()
    {
        $methodName = 'delete';
        $queryMock = $this->getQueryMock([$methodName]);
        $deleted = 2;
    
        $action = new Delete();
        $queryMock->expects($this->once())
            ->method($methodName)
            ->willReturn($deleted)
        ;
    
        $result = $action->do($queryMock);
        $expected = $deleted;
        $this->assertEquals($expected, $result);
    }
}
