<?php

namespace ArtemProger\Repspec\Action\Manipulation\Model;

use ArtemProger\Repspec\Action\Base\ModelManipulation;

class SaveMany extends ModelManipulation {

    /**
     * @var $relation string
     */
    protected $relation;

    /**
     * @var $models 
     */
    protected $models;

    /**
     * @var $pivotAttributes 
     */
    protected $pivotAttributes;

    /**
     * SaveMany constructor.
     *
     * @param string $relation
     * @param $models
     * @param array $pivotAttributes
     */
    public function __construct(string $relation, $models, array $pivotAttributes = [])
    {
        $this->relation = $relation;
        $this->models = $models;
        $this->pivotAttributes = $pivotAttributes;
    }

    /**
     * @return string
     */
    public function getRelation(): string
    {
        return $this->relation;
    }

    /**
     * @return mixed
     */
    public function getModels()
    {
        return $this->models;
    }

    /**
     * @return mixed
     */
    public function getPivotAttributes()
    {
        return $this->pivotAttributes;
    }

    /**
     * {@inheritdoc}
     */
    public function do($model)
    {
        $this->checkModel($model);

        return $model->{$this->relation}()->saveMany($this->models, $this->pivotAttributes);
    }
}
