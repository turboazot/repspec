<?php

namespace ArtemProger\Repspec\Test\Action\Manipulation\Model;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Action\Manipulation\Model\Delete;

class DeleteTest extends TestCase {

    public function testDelete_NoArguments_ApplyMethod()
    {
        $methodName = 'delete';
        $deleted = 2;

        $modelMock = $this->getModelMock(null, null, [$methodName]);
        $modelMock->method('delete')
            ->willReturn($deleted)
        ;

        $action = new Delete();
        $result = $action->do($modelMock);
        $expected = $deleted;
        $this->assertEquals($expected, $result);
    }
}
