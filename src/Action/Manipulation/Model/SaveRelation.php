<?php

namespace ArtemProger\Action\Manipulation\Model;

use ArtemProger\Action\Base\ActionInterface;
use ArtemProger\Action\Base\ModelManipulation;
use Illuminate\Database\Eloquent\Model;

class SaveRelation extends ModelManipulation {

    /**
     * @var $relation string
     */
    protected $relation;

    /**
     * @var $model Model
     */
    protected $model;

    /**
     * SaveRelation constructor.
     *
     * @param string $relation
     * @param Model $model
     */
    public function __construct(string $relation, Model $model)
    {
        $this->relation = $relation;
        $this->model = $model;
    }

    /**
     * {@inheritdoc}
     */
    public function do($model)
    {
        $this->checkModel($model);

        return $model->{$this->relation}()->save($this->model);
    }

    /**
     * @return string
     */
    public function getRelation(): string
    {
        return $this->relation;
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }
}
