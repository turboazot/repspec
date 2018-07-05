<?php

namespace ArtemProger\Test\Action\Structure;

use ArtemProger\Test\TestCase;
use ArtemProger\Test\Models\User;
use ArtemProger\Action\Structure\Paginate;

class PaginateTest extends TestCase {

    public function testPaginate_WithPerPageColumnsPageNamePage_ApplyMethod()
    {
        $methodName = 'paginate';
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
    
        $action = new Paginate($perPage, $columns, $pageName, $page);
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

    public function testPaginate_WithPerPageColumnsPageName_ApplyMethod()
    {
        $methodName = 'paginate';
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
    
        $action = new Paginate($perPage, $columns, $pageName);
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

    public function testPaginate_WithPerPageColumns_ApplyMethod()
    {
        $methodName = 'paginate';
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
    
        $action = new Paginate($perPage, $columns);
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

    public function testPaginate_WithPerPage_ApplyMethod()
    {
        $methodName = 'paginate';
        $queryMock = $this->getQueryMock([$methodName]);
        $perPage = 5;
        $data = [
            new User,
            new User,
            new User,
            new User,
            new User
        ];
    
        $action = new Paginate($perPage);
        $queryMock->expects($this->once())
            ->method($methodName)
            ->with($this->equalTo($perPage))
            ->willReturn($data)
        ;
    
        $result = $action->do($queryMock);
        $expected = $data;
        $this->assertEquals($expected, $result);
    }

    public function testPaginate_NoArguments_ApplyMethod()
    {
        $methodName = 'paginate';
        $queryMock = $this->getQueryMock([$methodName]);
        $data = [
            new User,
            new User,
            new User,
            new User,
            new User
        ];
    
        $action = new Paginate();
        $queryMock->expects($this->once())
            ->method($methodName)
            ->willReturn($data)
        ;
    
        $result = $action->do($queryMock);
        $expected = $data;
        $this->assertEquals($expected, $result);
    }
}
