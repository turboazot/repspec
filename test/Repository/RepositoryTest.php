<?php

namespace ArtemProger\Test\Repository;

use ArtemProger\Action\Base\ActionInterface;
use ArtemProger\Action\Base\ModelManipulation;
use ArtemProger\Repository\Repository;
use ArtemProger\Specification\SpecificationInterface;
use ArtemProger\Test\Models\User;
use ArtemProger\Test\TestCase;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class RepositoryTest extends TestCase {

    public function testMatch_WithSpecificationAndAction_ReturnResult()
    {
        $actionMock = $this->createMock(ActionInterface::class);
        $specMock = $this->createMock(SpecificationInterface::class);
        $doResult = [
            new User,
            new User
        ];
        $repositoryStub = $this->getRepositoryStub($doResult);

        $result = $repositoryStub->match($specMock, $actionMock);

        $expected = $doResult;
        $this->assertEquals($expected, $result);
    }

    public function testMatch_WithSpecificationAndAction_QueryShouldBeCalled()
    {
        $specMock = $this->createMock(SpecificationInterface::class);
        $actionMock = $this->createMock(ActionInterface::class);
        $repositoryStub = $this->getRepositoryStub();

        $repositoryStub->expects($this->once())
            ->method('query')
            ->with($this->equalTo($specMock));

        $repositoryStub->match($specMock, $actionMock);
    }

    public function testMatch_WithSpecificationAndAction_DoShouldBeCalled()
    {
        $specMock = $this->createMock(SpecificationInterface::class);
        $actionMock = $this->createMock(ActionInterface::class);
        $repositoryStub = $this->getRepositoryStub();
        $doResult = [
            new User,
            new User
        ];

        $repositoryStub->expects($this->once())
            ->method('do')
            ->with(
                $this->equalTo($this->getQueryMock()),
                $this->equalTo($actionMock)
            )
            ->willReturn($doResult);

        $repositoryStub->match($specMock, $actionMock);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testMatch_NoArguments_ThrowAnException()
    {
        $repository = $this->getRepositoryStub();
        $repository->match();
    }

    public function testDo_WithQueryAndAction_ActionMethodDoShouldBeCalled()
    {
        $repositoryStub = new class extends Repository {
            public function do(Builder $builder, ActionInterface $action = null)
            {
                return parent::do($builder, $action);
            }
        };
        $queryMock = $this->getQueryMock();
        $doResult = [
            new User,
            new User
        ];

        $specMock = $this->createMock(SpecificationInterface::class);
        $actionMock = $this->getMockBuilder(ActionInterface::class)
            ->setMethods(['do'])
            ->getMock();

        $actionMock->expects($this->once())
            ->method('do')
            ->with($this->equalTo($queryMock))
            ->willReturn($doResult);

        $repositoryStub->do($queryMock, $actionMock);
    }

    public function testDo_WithQueryOnly_ActionShouldBeCollection()
    {
        $repositoryStub = new class extends Repository {
            public function do(Builder $builder, ActionInterface $action = null)
            {
                return parent::do($builder, $action);
            }
        };


        $queryMock = $this->getMockBuilder(Builder::class)
            ->disableOriginalConstructor()
            ->setMethods(['get'])
            ->getMock();
        $queryMock->expects($this->once())
            ->method('get');

        $repositoryStub->do($queryMock);
    }

    public function testModel_WithModelAndManipulationAction_ReturnResult()
    {
        $repository = $this->getRepositoryStub();
        $model = new User;
        $doResult = [
            new User,
            new User
        ];
        $actionMock = $this->getMockBuilder(ModelManipulation::class)
            ->setMethods(['do'])
            ->getMock();

        $actionMock->method('do')
            ->with($this->equalTo($model))
            ->willReturn($doResult);

        $result = $repository->model($model, $actionMock);

        $expected = $doResult;
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testModel_WithModelOnly_ThrowAnException()
    {
        $repository = $this->getRepositoryStub();
        $repository->model(new User);
    }

    private function getRepositoryStub($result = [])
    {
        $repositoryStub = $this->getMockBuilder(Repository::class)
            ->setMethods(['query', 'do'])
            ->getMock();

        $queryMock = $this->getQueryMock();
        $repositoryStub
            ->method('query')
            ->willReturn($queryMock);

        $repositoryStub->method('do')
            ->willReturn($result);

        return $repositoryStub;
    }

    protected function getQueryMock(array $methods = [], string $queryClass = QueryBuilder::class)
    {
        return $this->createMock(Builder::class);
    }
}
