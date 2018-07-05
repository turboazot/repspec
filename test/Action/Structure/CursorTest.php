<?php

namespace ArtemProger\Test\Structure;

use ArtemProger\Test\TestCase;
use ArtemProger\Action\Structure\Cursor;

class CursorTest extends TestCase {

    public function testCursor_NoArguments_ReturnCursor()
    {
        $methodName = 'cursor';
        $queryMock = $this->getQueryMock([$methodName]);
        $cursor = new \stdClass();
    
        $action = new Cursor();
        $queryMock->expects($this->once())
            ->method($methodName)
            ->willReturn($cursor)
        ;
    
        $result = $action->do($queryMock);
        $expected = $cursor;
        $this->assertEquals($expected, $result);
    }
}
