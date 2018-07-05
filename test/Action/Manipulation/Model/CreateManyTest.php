<?php

namespace ArtemProger\Repspec\Test\Action\Manipulation\Model;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Action\Manipulation\Model\CreateMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CreateManyTest extends TestCase {

    public function testCreateMany_WithRelationAndValue_ApplyMethod()
    {
        $methodName = 'createMany';
        $relation = 'user';
        $value = [
            [
                'first_name' => 'Petya',
            ],
            [
                'first_name' => 'Vasya'
            ]
        ];
        
        $relationMock = $this->getRelationMock($methodName, BelongsToMany::class);
        $relationMock
            ->expects($this->once())
            ->method($methodName)
            ->with($this->equalTo($value));
        $modelMock = $this->getModelMock($relation, $relationMock);
    
    
        $action = new CreateMany($relation, $value);
        $action->do($modelMock);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testCreateMany_WithRelationOnly_ThrowAnException()
    {
        $action = new CreateMany('user');
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testCreateMany_NoArguments_ThrowAnException()
    {
        $action = new CreateMany();
    }
}
