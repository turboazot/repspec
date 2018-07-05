<?php

namespace ArtemProger\Test\Action\Manipulation\Model;

use ArtemProger\Test\TestCase;
use ArtemProger\Action\Manipulation\Model\UpdateExistingPivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UpdateExistingPivotTest extends TestCase {

    public function testUpdateExistingPivot_WithRelationIdAttributesTouch_ApplyMethod()
    {
        $methodName = 'updateExistingPivot';
        $relation = 'users';
        $id = 2;
        $attributes = ['expires' => '2016-05-03'];
        $touch = false;
        $updated = 1;
        
        $relationMock = $this->getRelationMock($methodName, BelongsTo::class);
        $relationMock
            ->expects($this->once())
            ->method($methodName)
            ->with(
                $this->equalTo($id),
                $this->equalTo($attributes),
                $this->equalTo($touch)
            )
            ->willReturn($updated)
        ;
        $modelMock = $this->getModelMock($relation, $relationMock);
    
    
        $action = new UpdateExistingPivot($relation, $id, $attributes, $touch);
        $result = $action->do($modelMock);
        $expected = $updated;
        $this->assertEquals($expected, $result);
    }

    public function testUpdateExistingPivot_WithRelationIdAttributes_ApplyMethod()
    {
        $methodName = 'updateExistingPivot';
        $relation = 'users';
        $id = 2;
        $attributes = ['expires' => '2016-05-03'];
        $updated = 1;
        
        $relationMock = $this->getRelationMock($methodName, BelongsTo::class);
        $relationMock
            ->expects($this->once())
            ->method($methodName)
            ->with(
                $this->equalTo($id),
                $this->equalTo($attributes)
            )
            ->willReturn($updated)
        ;
        $modelMock = $this->getModelMock($relation, $relationMock);
    
    
        $action = new UpdateExistingPivot($relation, $id, $attributes);
        $result = $action->do($modelMock);
        $expected = $updated;
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testUpdateExistingPivot_WithRelationId_ThrowAnException()
    {
        $action = new UpdateExistingPivot('relation', 3);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testUpdateExistingPivot_WithRelationOnly_ThrowAnException()
    {
        $action = new UpdateExistingPivot('relationOnly');
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testUpdateExistingPivot_NoArguments_ThrowAnException()
    {
        $action = new UpdateExistingPivot('relationOnly');
    }
    
}
