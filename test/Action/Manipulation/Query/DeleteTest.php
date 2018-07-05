<?php

namespace ArtemProger\Test\Action\Manipulation\Query;

use ArtemProger\Test\TestCase;
use ArtemProger\Action\Manipulation\Query\Delete;

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
