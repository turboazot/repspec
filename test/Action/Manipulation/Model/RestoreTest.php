<?php

namespace ArtemProger\Test\Action\Manipulation\Model;

use ArtemProger\Test\TestCase;
use ArtemProger\Action\Manipulation\Model\Restore;

class RestoreTest extends TestCase {

    public function testRestore_WithRelation_ApplyMethod()
    {
        $methodName = 'restore';
        $relation = 'user';
        $deleteCount = 1;
        
        $relationMock = $this->getRelationMock($methodName, BelongsTo::class);
        $relationMock
            ->expects($this->once())
            ->method($methodName)
            ->willReturn($deleteCount)
        ;
        $modelMock = $this->getModelMock($relation, $relationMock);
    
    
        $action = new Restore($relation);
        $result = $action->do($modelMock);
        $expected = $deleteCount;
        $this->assertEquals($expected, $result);
    }

    public function testRestore_NoArguments_ApplyMethod()
    {
        $methodName = 'restore';
        $relation = 'user';
        $deleteCount = 1;
        
        $relationMock = $this->getRelationMock($methodName, BelongsTo::class);
        $modelMock = $this->getModelMock(null, null, [$methodName]);
        $modelMock
            ->method($methodName)
            ->willReturn($deleteCount);
    
    
        $action = new Restore();
        $result = $action->do($modelMock);
        $expected = $deleteCount;
        $this->assertEquals($expected, $result);
    }
}

