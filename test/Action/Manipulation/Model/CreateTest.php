<?php

namespace ArtemProger\Repspec\Test\Action\Manipulation\Model;

use ArtemProger\Repspec\Test\TestCase;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use ArtemProger\Repspec\Action\Manipulation\Model\Create;

class CreateTest extends TestCase {

    public function testCreate_WithRelationAndValue_ApplyMethod()
    {
        $methodName = 'create';
        $relation = 'user';
        $value = [
            'first_name' => 'Petya'
        ];
        
        $relationMock = $this->getRelationMock($methodName, BelongsTo::class);
        $relationMock
            ->expects($this->once())
            ->method($methodName)
            ->with($this->equalTo($value));
        $modelMock = $this->getModelMock($relation, $relationMock);
    
    
        $action = new Create($relation, $value);
        $action->do($modelMock);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testCreate_WithRelationOnly_ThrowAnException()
    {
        $action = new Create('user');
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testCreate_NoArguments_ThrowAnException()
    {
        $action = new Create();
    }
}
