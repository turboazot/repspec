<?php

namespace ArtemProger\Test\Action\Manipulation\Model;

use ArtemProger\Test\TestCase;
use ArtemProger\Test\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use ArtemProger\Action\Manipulation\Model\SaveRelation;

class SaveRelationTest extends TestCase {

    public function testSave_WithRelationAndModel_ApplyMethod()
    {
        $methodName = 'save';
        $relation = 'user';
        $saveModel = new User();
        
        $relationMock = $this->getRelationMock($methodName, BelongsTo::class);
        $relationMock
            ->method($methodName)
            ->willReturn($saveModel);
        ;
        $relationMock
            ->expects($this->once())
            ->method($methodName)
            ->willReturn($saveModel);

        $modelMock = $this->getModelMock($relation, $relationMock);
    
        $action = new SaveRelation($relation, $saveModel);
        $result = $action->do($modelMock);
        $expected = $saveModel;
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testSaveRelation_withRelationOnly_ThrowAnException()
    {
        $action = new SaveRelation('relationOnly');
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testSaveRelation_NoArguments_ThrowAnException()
    {
        $action = new SaveRelation();
    }
}
