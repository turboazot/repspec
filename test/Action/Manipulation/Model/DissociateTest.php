<?php

namespace ArtemProger\Repspec\Test\Action\Manipulation\Model;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Test\Models\User;
use ArtemProger\Repspec\Action\Manipulation\Model\Dissociate;

class DissociateTest extends TestCase {

    public function testDissociate_WithRelation_ApplyMethod()
    {
        $methodName = 'dissociate';
        $relation = 'user';
        $childModel = new User();
        $saveResult = true;
        
        $relationMock = $this->getRelationMock($methodName, BelongsTo::class);
        $relationMock
            ->expects($this->once())
            ->method($methodName)
            ->willReturn($childModel)
        ;
        $modelMock = $this->getModelMock($relation, $relationMock);
        $modelMock
            ->expects($this->once())
            ->method('save')
            ->willReturn($saveResult);
    
    
        $action = new Dissociate($relation);
        $result = $action->do($modelMock);
        $expected = $saveResult;
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testDissociate_NoArguments_ThrowAnException()
    {
        $action = new Dissociate();
    }
}
