<?php

namespace ArtemProger\Repspec\Test\Action\Manipulation\Query;

use ArtemProger\Repspec\Action\Manipulation\Query\Update;
use ArtemProger\Repspec\Test\TestCase;

class UpdateTest extends TestCase {

    public function testUpdate_WithValue_ApplyMethod()
    {
        $methodName = 'update';
        $queryMock = $this->getQueryMock([$methodName]);
        $value = ['votes' => 1];
        $updated = 3;
    
        $action = new Update($value);
        $queryMock->expects($this->once())
            ->method($methodName)
            ->with($this->equalTo($value))
            ->willReturn($updated)
        ;
    
        $result = $action->do($queryMock);
        $expected = $updated;
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testUpdate_NoArguments_ThrowAnException()
    {
        $action = new Update();
    }
}
