<?php

namespace ArtemProger\Repspec\Test\Action\Structure;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Action\Structure\Collection;

class CollectionTest extends TestCase {

    public function testCollection_NoArguments_ReturnCollection()
    {
        $methodName = 'get';
        $queryMock = $this->getQueryMock([$methodName]);
        $collection = collect([]);
    
        $action = new Collection();
        $queryMock->expects($this->once())
            ->method($methodName)
            ->willReturn($collection)
        ;
    
        $result = $action->do($queryMock);
        $expected = $collection;
        $this->assertEquals($expected, $result);
    }
    
}
