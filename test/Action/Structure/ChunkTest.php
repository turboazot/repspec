<?php

namespace ArtemProger\Repspec\Test\Structure;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Action\Structure\Chunk;
use ArtemProger\Repspec\Test\Models\User;

class ChunkTest extends TestCase {

    public function testChunk_WithCountAndHandler_ApplyMethod()
    {
        $methodName = 'chunk';
        $queryMock = $this->getQueryMock([$methodName]);
        $count = 2;
        $callback = function ($users) {
            return true;   
        };

        $chunk = [
            0 => [
                new User,
                new User
            ],
            1 => [
                new User,
                new User
            ]
        ];
    
        $action = new Chunk($count, $callback);
        $queryMock->expects($this->once())
            ->method($methodName)
            ->with(
                $this->equalTo($count),
                $this->equalTo($callback)
            )
            ->willReturn($chunk)
        ;
    
        $result = $action->do($queryMock);
        $expected = $chunk;
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testChunk_WithCountOnly_ThrowAnException()
    {
        $action = new Chunk(2);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testChunk_NoArguments_ThrowAnException()
    {
        $action = new Chunk();
    }
}
