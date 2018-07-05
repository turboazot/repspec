<?php

namespace ArtemProger\Repspec\Test\Action\Manipulation\Model;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Action\Manipulation\Model\Detach;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetachTest extends TestCase {

    public function testDetach_WithRelationAndIds_ApplyMethod()
    {
        $this->assertTrue(true);
        $methodName = 'detach';
        $relation = 'users';
        $ids = [1, 2, 3];
        $detachedCount = 3;
        
        $relationMock = $this->getRelationMock($methodName, BelongsTo::class);
        $relationMock
            ->expects($this->once())
            ->method($methodName)
            ->with($this->equalTo($ids))
            ->willReturn($detachedCount);
            
        ;
        $modelMock = $this->getModelMock($relation, $relationMock);
    
        $action = new Detach($relation, [1, 2, 3]);
        $result = $action->do($modelMock);

        $expected = $detachedCount;
        $this->assertEquals($expected, $result);
    }



    public function testDetach_WithRelationOnly_ApplyMethod()
    {
        $methodName = 'detach';
        $relation = 'user';
        $detachedCount = 10;
        
        $relationMock = $this->getRelationMock($methodName, BelongsTo::class);
        $relationMock
            ->expects($this->once())
            ->method($methodName)
            ->willReturn($detachedCount)
        ;

        $modelMock = $this->getModelMock($relation, $relationMock);
    
        $action = new Detach($relation);
        $result = $action->do($modelMock);
        $expected = $detachedCount;
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testDetach_NoArguments_ThrowAnException()
    {
        $action = new Detach();
    }
}
