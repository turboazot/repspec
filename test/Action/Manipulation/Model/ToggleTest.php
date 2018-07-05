<?php

namespace ArtemProger\Test\Action\Manipulation\Model;

use ArtemProger\Test\TestCase;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use ArtemProger\Action\Manipulation\Model\Toggle;

class ToggleTest extends TestCase {

    public function testToggle_WithRelationValueDetaching_ApplyMethod()
    {
        $methodName = 'toggle';
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
    
        $action = new Toggle($relation, $values, $detaching);
        $result = $action->do($modelMock);
        $expected = $changes;
        $this->assertEquals($expected, $result);
    }

    public function testToggle_WithRelationAndValue_ApplyMethod()
    {
        $methodName = 'toggle';
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
    
        $action = new Toggle($relation, $values);
        $result = $action->do($modelMock);
        $expected = $changes;
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testToggle_WithRelationOnly_ThrowAnException()
    {
        $action = new Toggle('relationOnly');
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testToggle_NoArguments_ThrowAnException()
    {
        $action = new Toggle();
    }
}
