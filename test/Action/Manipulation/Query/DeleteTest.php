<?php

namespace ArtemProger\Repspec\Test\Action\Manipulation\Query;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Action\Manipulation\Query\Delete;

class DeleteTest extends TestCase {

    public function testDelete_NoArguments_ApplyMethod()
    {
        $methodName = 'delete';
        $queryMock = $this->getQueryMock([$methodName]);
    
        $action = new Delete();
        $queryMock->expects($this->once())
            ->method($methodName)
        ;
    
        $action->do($queryMock);
    }
}
