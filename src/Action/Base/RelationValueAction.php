<?php

namespace ArtemProger\Action\Base;

use ArtemProger\MethodNameTrait;

abstract class RelationValueAction extends ModelManipulation {

    use MethodNameTrait;

    /**
     * @var $relation string
     */
    protected $relation;

    /**
     * @var $value mixed
     */
    protected $value;

    /**
     * RelationValueAction constructor.
     *
     * @param string $relation
     * @param $value
     */
    public function __construct(string $relation, $value)
    {
        $this->relation = $relation;
        $this->value = $value;
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
    public function getValue()
    {
        return $this->value;
    }

    public function do($model)
    {
        $this->checkModel($model);

        return $model->{$this->relation}()->{$this->getMethodName()}($this->value);
    }
    
}
