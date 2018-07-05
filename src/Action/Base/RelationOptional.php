<?php

namespace ArtemProger\Action\Base;

use ArtemProger\MethodNameTrait;

abstract class RelationOptional extends ModelManipulation {

    use MethodNameTrait;

    /**
     * @var $relation string|null
     */
    protected $relation;

    /**
     * RelationOptional constructor.
     *
     * @param string|null $relation
     */
    public function __construct(string $relation = null)
    {
        $this->relation = $relation;
    }

    /**
     * @return null|string
     */
    public function getRelation()
    {
        return $this->relation;
    }

    /**
     * {@inheritdoc}
     */
    public function do($model)
    {
        $this->checkModel($model);

        return $this->relation
            ? $model->{$this->relation}()->{$this->getMethodName()}()
            : $model->{$this->getMethodName()}();
    }
}
