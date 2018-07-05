<?php

namespace ArtemProger\Repspec\Test\Manipulation;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Action\Manipulation\Model\Update;

class UpdateTest extends TestCase {

    public function testUpdate_WithAttributesAndOptions_ApplyMethod()
    {
        $methodName = 'update';
        $attributes = ['votes' => 1];
        $options = ['timestamps' => false];
        $updated = 2;
        
        $modelMock = $this->getModelMock(null, null, [$methodName]);
        $modelMock
            ->method($methodName)
            ->with(
                $this->equalTo($attributes),
                $this->equalTo($options)
            )
            ->willReturn($updated)
        ;
    
        $action = new Update($attributes, $options);
        $result = $action->do($modelMock);

        $expected = $updated;
        $this->assertEquals($expected, $result);
    }

    public function testUpdate_WithAttributes_ApplyMethod()
    {
        $methodName = 'update';
        $attributes = ['votes' => 1];
        $updated = 2;
        
        $modelMock = $this->getModelMock(null, null, [$methodName]);
        $modelMock
            ->method($methodName)
            ->with(
                $this->equalTo($attributes)
            )
            ->willReturn($updated)
        ;
    
        $action = new Update($attributes);
        $result = $action->do($modelMock);

        $expected = $updated;
        $this->assertEquals($expected, $result);
    }

    public function testUpdate_NoArguments_ApplyMethod()
    {
        $methodName = 'update';
        $updated = 2;
        
        $modelMock = $this->getModelMock(null, null, [$methodName]);
        $modelMock
            ->method($methodName)
            ->willReturn($updated)
        ;
    
        $action = new Update();
        $result = $action->do($modelMock);

        $expected = $updated;
        $this->assertEquals($expected, $result);
    }
}
