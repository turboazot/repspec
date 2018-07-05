<?php

namespace ArtemProger\Test\Action\Manipulation\Model;

use ArtemProger\Test\TestCase;
use ArtemProger\Action\Manipulation\Model\SaveModel;

class SaveModelTest extends TestCase {

    public function testSaveModel_WithOptions_ApplyMethod()
    {
        $methodName = 'save';
        $options = ['timestamps' => true];
        
        $modelMock = $this->getModelMock(null, null, [$methodName]);
        $modelMock->method('save')
            ->with($this->equalTo($options))
            ->willReturn($modelMock)
        ;
    
        $action = new SaveModel($options);
        $result = $action->do($modelMock);
        $expected = $modelMock;
        $this->assertEquals($expected, $result);
    }

    public function testSaveModel_NoArguments_ApplyMethod()
    {
        $methodName = 'save';
        
        $modelMock = $this->getModelMock(null, null, [$methodName]);
        $modelMock->method('save')
            ->willReturn($modelMock)
        ;
    
        $action = new SaveModel();
        $result = $action->do($modelMock);
        $expected = $modelMock;
        $this->assertEquals($expected, $result);
    }
}
