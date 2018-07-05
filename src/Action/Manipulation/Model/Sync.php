<?php

namespace ArtemProger\Repspec\Action\Manipulation\Model;

use ArtemProger\Repspec\Action\Base\ModelManipulation;

class Sync extends ModelManipulation {

    /**
     * @var $relation string
     */
    protected $relation;

    /**
     * @var $ids
     */
    protected $ids;

    /**
     * @var $detaching bool
     */
    protected $detaching;

    /**
     * Sync constructor.
     *
     * @param string $relation
     * @param $ids
     * @param bool $detaching
     */
    public function __construct(string $relation, $ids, $detaching = true)
    {
        $this->relation = $relation;
        $this->ids = $ids;
        $this->detaching = $detaching;
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
    public function getIds()
    {
        return $this->ids;
    }

    /**
     * @return bool
     */
    public function isDetaching(): bool
    {
        return $this->detaching;
    }

    /**
     * {@inheritdoc}
     */
    public function do($model)
    {
        $this->checkModel($model);

        return $model->{$this->relation}()->sync($this->ids, $this->detaching);
    }
}
