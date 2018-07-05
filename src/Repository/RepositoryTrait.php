<?php

namespace ArtemProger\Repspec\Repository;

use ArtemProger\Repspec\Action\Base\ActionInterface;
use ArtemProger\Repspec\Action\Base\ModelManipulation;
use ArtemProger\Repspec\Action\Structure\Collection;
use ArtemProger\Repspec\Specification\SpecificationInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait RepositoryTrait {

    /**
     * @var $modelClass string
     */
    protected $modelClass;

    /**
     * @param SpecificationInterface $spec
     * @param ActionInterface|null $action
     *
     * @return Builder|Model
     */
    public function match(SpecificationInterface $spec, ActionInterface $action = null)
    {
        $query = $this->query($spec);

        return $this->do($query, $action);
    }

    /**
     * @param Model $model
     * @param ModelManipulation $action
     *
     * @return Builder|Model
     */
    public function model(Model $model, ModelManipulation $action)
    {
        return $action->do($model);
    }

    /**
     * @param SpecificationInterface $spec
     *
     * @return mixed
     */
    public function query(SpecificationInterface $spec)
    {
        $query = $this->getQuery();

        $spec->apply($query);

        return $query;
    }

    /**
     * @return mixed
     */
    public function getQuery()
    {
        return $this->getModelClass()::query();
    }

    /**
     * @param $modelClass
     */
    public function setModelClass($modelClass)
    {
        $this->modelClass = $modelClass;
    }

    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return $this->modelClass;
    }

    /**
     * @param Builder $builder
     * @param ActionInterface|null $action
     *
     * @return Builder|Model
     */
    protected function do(Builder $builder, ActionInterface $action = null)
    {
        if (is_null($action)) {
            $action = new Collection();
        }

        return $action->do($builder);
    }

    /**
     * Find a related model by its primary key.
     *
     * @param  mixed  $id
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|null
     */
    public function find($id, $columns = ['*'])
    {
        return $this->getModelClass()::find($id, $columns);
    }

    /**
     * Find multiple related models by their primary keys.
     *
     * @param  mixed  $ids
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findMany($ids, $columns = ['*'])
    {
        return $this->getModelClass()::findMany($ids, $columns);
    }

    /**
     * Find a related model by its primary key or throw an exception.
     *
     * @param  mixed  $id
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findOrFail($id, $columns = ['*'])
    {
        return $this->getModelClass()::findOrFail($id, $columns);
    }

    /**
     * Execute the query and get the first result.
     *
     * @param  array   $columns
     * @return mixed
     */
    public function first($columns = ['*'])
    {
        return $this->getModelClass()::first($columns);
    }

    /**
     * Execute the query and get the first result or throw an exception.
     *
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Model|static
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function firstOrFail($columns = ['*'])
    {
        return $this->getModelClass()::firstOrFail($columns);
    }

    /**
     * Get the results of the relationship.
     *
     * @return mixed
     */
    public function getResults()
    {
        return $this->getModelClass()::getResults();
    }

    /**
     * Execute the query as a "select" statement.
     *
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function get($columns = ['*'])
    {
        return $this->getModelClass()::get($columns);
    }
    
}
