<?php

namespace ArtemProger\Test\Action\Manipulation\Model;

use ArtemProger\Test\TestCase;
use ArtemProger\Action\Manipulation\Model\Sync;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SyncTest extends TestCase {

    public function testSync_WithRelationValueDetaching_ApplyMethod()
    {
        $methodName = 'sync';
        $relation = 'users';
        $values = [1, 2, 3];
        $detaching = true;
        $changes = ['attached' => 1, 'dettached' => 0, 'updated' => 1];
        
        $relationMock = $this->getRelationMock($methodName, BelongsTo::class);
        $relationMock
            ->expects($this->once())
            ->method($methodName)
            ->with(
                $this->equalTo($values),
                $this->equalTo($detaching)
            )
            ->willReturn($changes)
        ;

        $modelMock = $this->getModelMock($relation, $relationMock);
    
        $action = new Sync($relation, $values, $detaching);
        $result = $action->do($modelMock);
        $expected = $changes;
        $this->assertEquals($expected, $result);
    }

    public function testSync_WithRelationAndValue_ApplyMethod()
    {
        $methodName = 'sync';
        $relation = 'users';
        $values = [1, 2, 3];
        $changes = ['attached' => 1, 'dettached' => 0, 'updated' => 1];
        
        $relationMock = $this->getRelationMock($methodName, BelongsTo::class);
        $relationMock
            ->expects($this->once())
            ->method($methodName)
            ->with($this->equalTo($values))
            ->willReturn($changes)
        ;

        $modelMock = $this->getModelMock($relation, $relationMock);
    
        $action = new Sync($relation, $values);
        $result = $action->do($modelMock);
        $expected = $changes;
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testSync_WithRelationOnly_ThrowAnException()
    {
        $action = new Sync('relationOnly');
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testSync_NoArguments_ThrowAnException()
    {
        $action = new Sync();
    }
}
