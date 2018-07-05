<?php

namespace ArtemProger\Repspec\Test\Action\Manipulation\Model;

use ArtemProger\Repspec\Test\TestCase;
use Illuminate\Database\Eloquent\Model;
use ArtemProger\Repspec\Test\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use ArtemProger\Repspec\Action\Manipulation\Model\Associate;

class AssociateTest extends TestCase {

    public function testAssociate_WithModel_ApplyMethod()
    {
        $methodName = 'associate';
        $relation = 'user';
        $childModel = new User();
        
        $relationMock = $this->getRelationMock($methodName, BelongsTo::class);
        $relationMock
            ->expects($this->once())
            ->method($methodName)
            ->with($this->equalTo($childModel))
            ->willReturn($childModel);
        $modelMock = $this->getModelMock($relation, $relationMock);

    
        $action = new Associate($relation, $childModel);
        $result = $action->do($modelMock);
        $this->assertEquals($childModel, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testAssociate_WithColumnOnly_ThrowAnException()
    {
        $action = new Associate('col');
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testAssociate_NoArguments_ThrowAnException()
    {
        $action = new Associate();
    }
}
