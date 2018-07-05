<?php

namespace ArtemProger\Test\Action\Logic;

use ArtemProger\Test\TestCase;
use ArtemProger\Action\Structure\Collection;
use ArtemProger\Action\Lock\Lock;
use ArtemProger\Test\Models\User;
use ArtemProger\Action\Logic\AndX;
use ArtemProger\Action\Structure\Single;

class AndXTest extends TestCase {

    public function testAndX_WithLockActionAndAnotherAction_ApplyMethod()
    {
        $lockMethodName = 'lock';
        $lockValue = true;
        $anotherMethodName = 'get';
        $queryMock = $this->getQueryMock([$lockMethodName, $anotherMethodName]);
        $collection = [
            new User,
            new User
        ];
    
        $lockAction = new Lock($lockValue);
        $anotherAction = new Collection();
        $action = new AndX(
            $lockAction, $anotherAction
        );
        $queryMock->expects($this->once())
            ->method($lockMethodName)
            ->with($this->equalTo($lockValue))
            ->willReturn($collection)
        ;
        $queryMock->expects($this->once())
            ->method($anotherMethodName)
            ->willReturn($collection)
        ;
    
        $result = $action->do($queryMock);
        $expected = $collection;
        $this->assertEquals($expected, $result);
    }

    public function testAndX_WithAnotherActionOnly_ApplyMethod()
    {
        $methodName = 'get';
        $queryMock = $this->getQueryMock([$methodName]);
        $collection = [
            new User,
            new User
        ];
    
        $anotherAction = new Collection();
        $action = new AndX(
            $anotherAction
        );
        $queryMock->expects($this->once())
            ->method($methodName)
            ->willReturn($collection)
        ;
    
        $result = $action->do($queryMock);
        $expected = $collection;
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testAndX_WithMoreThan2Actions_ThrowAnException()
    {
        $action = new AndX(
            new Lock,
            new Collection,
            new Single('field1')
        );
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testAndX_NoArguments_ThrowAnException()
    {
        $action = new AndX();
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testAndX_WithSecondArgumentAsLock_ThrowAnException()
    {
        $action = new AndX(new Lock, new Lock);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testAndX_WithFirstActionNoLock_ThrowAnException()
    {
        $action = new AndX(new Collection, new Lock);
    }
}
