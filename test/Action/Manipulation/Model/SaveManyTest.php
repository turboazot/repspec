<?php

namespace ArtemProger\Test\Action\Manipulation\Model;

use ArtemProger\Test\TestCase;
use ArtemProger\Action\Manipulation\Model\SaveMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use ArtemProger\Test\Models\User;

class SaveManyTest extends TestCase {

    public function testSaveMany_WithRelationModelsAndPivotAttributes_ApplyMethod()
    {
        $methodName = 'saveMany';
        $relation = 'users';
        $models = [new User, new User];
        $pivotAttributes = ['expires' => '2016-02-03'];
        
        $relationMock = $this->getRelationMock($methodName, BelongsTo::class);
        $relationMock
            ->expects($this->once())
            ->method($methodName)
            ->with(
                $models,
                $pivotAttributes
            )
            ->willReturn($models);
        ;
        $modelMock = $this->getModelMock($relation, $relationMock);
    
    
        $action = new SaveMany($relation, $models, $pivotAttributes);
        $result = $action->do($modelMock);
        $expected = $models;
        $this->assertEquals($expected, $result);
    }

    public function testSaveMany_WithRelationAndModels_ApplyMethod()
    {
        $methodName = 'saveMany';
        $relation = 'users';
        $models = [new User, new User];
        
        $relationMock = $this->getRelationMock($methodName, BelongsTo::class);
        $relationMock
            ->expects($this->once())
            ->method($methodName)
            ->with($models)
            ->willReturn($models);
        ;
        $modelMock = $this->getModelMock($relation, $relationMock);
    
        $action = new SaveMany($relation, $models);
        $result = $action->do($modelMock);
        $expected = $models;
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testSaveMany_WithRelationOnly_ThrowAnException()
    {
        $action = new SaveMany('relationOnly');
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testSaveMany_NoArguments_ThrowAnException()
    {
        $action = new SaveMany();
    }

}
