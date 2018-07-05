<?php

namespace ArtemProger\Repspec\Test\Action\Structure;

use ArtemProger\Repspec\Test\TestCase;
use ArtemProger\Repspec\Test\Models\User;
use ArtemProger\Repspec\Action\Structure\SimplePaginate;

class SimplePaginateTest extends TestCase {

    public function testSimplePaginate_WithPerPageColumnsPageNamePage_ApplyMethod()
    {
        $methodName = 'simplePaginate';
        $queryMock = $this->getQueryMock([$methodName]);
        $perPage = 5;
        $columns = ['first_name', 'last_name'];
        $pageName = 'stranica';
        $page = 2;

        $data = [
            new User,
            new User,
            new User,
            new User,
            new User
        ];
    
        $action = new SimplePaginate($perPage, $columns, $pageName, $page);
        $queryMock->expects($this->once())
            ->method($methodName)
            ->with(
                $this->equalTo($perPage),
                $this->equalTo($columns),
                $this->equalTo($pageName),
                $this->equalTo($page)
            )
            ->willReturn($data)
        ;
    
        $result = $action->do($queryMock);
        $expected = $data;
        $this->assertEquals($expected, $result);
    }

    public function testSimplePaginate_WithPerPageColumnsPageName_ApplyMethod()
    {
        $methodName = 'simplePaginate';
        $queryMock = $this->getQueryMock([$methodName]);
        $perPage = 5;
        $columns = ['first_name', 'last_name'];
        $pageName = 'stranica';

        $data = [
            new User,
            new User,
            new User,
            new User,
            new User
        ];
    
        $action = new SimplePaginate($perPage, $columns, $pageName);
        $queryMock->expects($this->once())
            ->method($methodName)
            ->with(
                $this->equalTo($perPage),
                $this->equalTo($columns),
                $this->equalTo($pageName)
            )
            ->willReturn($data)
        ;
    
        $result = $action->do($queryMock);
        $expected = $data;
        $this->assertEquals($expected, $result);
    }

    public function testSimplePaginate_WithPerPageColumns_ApplyMethod()
    {
        $methodName = 'simplePaginate';
        $queryMock = $this->getQueryMock([$methodName]);
        $perPage = 5;
        $columns = ['first_name', 'last_name'];

        $data = [
            new User,
            new User,
            new User,
            new User,
            new User
        ];
    
        $action = new SimplePaginate($perPage, $columns);
        $queryMock->expects($this->once())
            ->method($methodName)
            ->with(
                $this->equalTo($perPage),
                $this->equalTo($columns)
            )
            ->willReturn($data)
        ;
    
        $result = $action->do($queryMock);
        $expected = $data;
        $this->assertEquals($expected, $result);
    }

    public function testSimplePaginate_WithPerPage_ApplyMethod()
    {
        $methodName = 'simplePaginate';
        $queryMock = $this->getQueryMock([$methodName]);
        $perPage = 5;
        $data = [
            new User,
            new User,
            new User,
            new User,
            new User
        ];
    
        $action = new SimplePaginate($perPage);
        $queryMock->expects($this->once())
            ->method($methodName)
            ->with($this->equalTo($perPage))
            ->willReturn($data)
        ;
    
        $result = $action->do($queryMock);
        $expected = $data;
        $this->assertEquals($expected, $result);
    }

    public function testSimplePaginate_NoArguments_ApplyMethod()
    {
        $methodName = 'simplePaginate';
        $queryMock = $this->getQueryMock([$methodName]);
        $data = [
            new User,
            new User,
            new User,
            new User,
            new User
        ];
    
        $action = new SimplePaginate();
        $queryMock->expects($this->once())
            ->method($methodName)
            ->willReturn($data)
        ;
    
        $result = $action->do($queryMock);
        $expected = $data;
        $this->assertEquals($expected, $result);
    }
}
