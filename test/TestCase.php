<?php

namespace ArtemProger\Repspec\Test;

use Illuminate\Database\Connection;
use Illuminate\Database\ConnectionResolverInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Query\Grammars\MySqlGrammar;
use Illuminate\Database\Query\Processors\MySqlProcessor;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase {

    protected function getConnectionMock()
    {
        $mock = $this->createMock(Connection::class);
        $mock->method('getQueryGrammar')
            ->willReturn($this->getGrammar());
        return $mock;
    }

    protected function getQueryBuilder()
    {
        return new QueryBuilder(
            $this->getConnectionMock(),
            $this->getGrammar(),
            $this->getProcessor()
        );
    }

    protected function getConnectionResolverMock()
    {
        $resolver = $this->createMock(ConnectionResolverInterface::class);
        $resolver->method('connection')
            ->willReturn($this->getConnectionMock());

        return $resolver;
    }

    protected function getQueryMock(array $methods = [], string $queryClass = QueryBuilder::class)
    {
        $queryMock = $this->getMockBuilder($queryClass)
            ->disableOriginalConstructor()
            ->setMethods($methods)
            ->getMock();

        return $queryMock;
    }

    protected function getModelMock(string $relationName = null, $relationMock = null, array $methods = null)
    {
        $modelMockBuilder = $this->getMockBuilder(Model::class)
            ->disableOriginalConstructor();

        if ($relationName) {
            $modelMockBuilder->setMethods([$relationName, 'save']);
        } else if ($methods) {
            $modelMockBuilder->setMethods($methods);
        }

        $modelMock = $modelMockBuilder->getMock();

        if ($relationName && $relationMock) {
            $modelMock->method($relationName)
                ->willReturn($relationMock);
        }


        return $modelMock;
    }

    protected function getRelationMock($method, string $relationClass)
    {
        $relationMock = $this->getMockBuilder($relationClass)
            ->disableOriginalConstructor()
            ->setMethods([$method])
            ->getMock();

        return $relationMock;
    }

    protected function getGrammar()
    {
        return new MySqlGrammar();
    }

    protected function getProcessor()
    {
        return new MySqlProcessor();
    }

    protected function getQuery(string $modelClassName)
    {
        $model = $this->getModel($modelClassName);

        return $model->newQuery();
    }

    protected function getModel(string $modelClassName)
    {
        Model::setConnectionResolver($this->getConnectionResolverMock());
        return new $modelClassName();
    }

    protected function formatOneLineSql($str)
    {
        return trim(
            preg_replace([
                "/\s+/",
                "/\(\s+/",
                "/\s+\)/"
            ], [
                ' ',
                '(',
                ')'
            ], 
            $str)
        );
    }
    
}

