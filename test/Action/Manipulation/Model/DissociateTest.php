<?php

namespace ArtemProger\Test\Action\Manipulation\Model;

use ArtemProger\Test\TestCase;
use ArtemProger\Test\Models\User;
use ArtemProger\Action\Manipulation\Model\Dissociate;

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
