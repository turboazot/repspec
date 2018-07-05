<?php

namespace ArtemProger\Repspec\Test\Action\Manipulation\Model;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Action\Manipulation\Model\ForceDelete;

class ForceDeleteTest extends TestCase {

    public function testForceDelete_WithRelation_ApplyMethod()
    {
        $methodName = 'forceDelete';
        $relation = 'user';
        $deleteCount = 1;
        
        $relationMock = $this->getRelationMock($methodName, BelongsTo::class);
        $relationMock
            ->expects($this->once())
            ->method($methodName)
            ->willReturn($deleteCount)
        ;
        $modelMock = $this->getModelMock($relation, $relationMock);
    
    
        $action = new ForceDelete($relation);
        $result = $action->do($modelMock);
        $expected = $deleteCount;
        $this->assertEquals($expected, $result);
    }

    public function testForceDelete_NoArguments_ApplyMethod()
    {
        $methodName = 'forceDelete';
        $relation = 'user';
        $deleteCount = 1;
        
        $relationMock = $this->getRelationMock($methodName, BelongsTo::class);
        $modelMock = $this->getModelMock(null, null, [$methodName]);
        $modelMock
            ->method($methodName)
            ->willReturn($deleteCount);
    
    
        $action = new ForceDelete();
        $result = $action->do($modelMock);
        $expected = $deleteCount;
        $this->assertEquals($expected, $result);
    }
}
