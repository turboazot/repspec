<?php

namespace ArtemProger\Repository;

use ArtemProger\Action\Base\ActionInterface;
use ArtemProger\Action\Base\ModelManipulation;
use ArtemProger\Action\Structure\Collection;
use ArtemProger\Specification\SpecificationInterface;
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
    
}
