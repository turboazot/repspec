<?php

namespace ArtemProger\Repspec\Action\Manipulation\Model;

use ArtemProger\Repspec\Action\Base\ModelManipulation;
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
     * @var $pivotAttributes array
     */
    protected $pivotAttributes;

    /**
     * @var $touch bool
     */
    protected $touch;

    /**
     * SaveRelation constructor.
     *
     * @param string $relation
     * @param Model $model
     * @param array $pivotAttributes
     * @param bool $touch
     */
    public function __construct(string $relation, Model $model, array $pivotAttributes = [], $touch = true)
    {
        $this->relation = $relation;
        $this->model = $model;
        $this->pivotAttributes = $pivotAttributes;
        $this->touch = $touch;
    }

    /**
     * {@inheritdoc}
     */
    public function do($model)
    {
        $this->checkModel($model);

        return $model->{$this->relation}()->save(
            $this->model,
            $this->pivotAttributes,
            $this->touch
        );
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
