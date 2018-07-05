<?php

namespace ArtemProger\Test\Action\Manipulation\Model;

use ArtemProger\Test\TestCase;
use ArtemProger\Test\Models\User;
use ArtemProger\Action\Manipulation\Model\Attach;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AttachTest extends TestCase {

    public function testAttach_WithId_ApplyMethod()
    {
        $methodName = 'attach';
        $relation = 'user';
        $id = 1;
        $saveResult = true;
        
        $relationMock = $this->getRelationMock($methodName, BelongsToMany::class);
        $relationMock
            ->expects($this->once())
            ->method($methodName)
            ->with($id)
        ;

        $modelMock = $this->getModelMock($relation, $relationMock);
        $modelMock
            ->expects($this->once())
            ->method('save')
            ->willReturn($saveResult)
        ;
    
    
        $action = new Attach($relation, $id);
        $result = $action->do($modelMock);

        $expected = $saveResult;
        $this->assertEquals($expected, $result);
    }

    public function testAttach_WithIdAndAttributes_ApplyMethod()
    {
        $methodName = 'attach';
        $relation = 'user';
        $id = 1;
        $attributes = ['expires' => '2016-12-13'];
        $saveResult = true;

        $relationMock = $this->getRelationMock($methodName, BelongsTo::class);
        $relationMock
            ->expects($this->once())
            ->method($methodName)
            ->with(
                $this->equalTo(1),
                $this->equalTo($attributes)
            );

        $modelMock = $this->getModelMock($relation, $relationMock);
        $modelMock
            ->expects($this->once())
            ->method('save')
            ->willReturn($saveResult)
        ;
    
        $action = new Attach($relation, $id, $attributes);
        $result = $action->do($modelMock);

        $expected = $saveResult;
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testAttach_NoArguments_ThrowAnException()
    {
        $action = new Attach();
    }
    
}
