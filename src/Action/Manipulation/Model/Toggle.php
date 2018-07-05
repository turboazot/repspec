<?php

namespace ArtemProger\Action\Manipulation\Model;

use ArtemProger\Action\Base\ModelManipulation;

class Toggle extends ModelManipulation {

    /**
     * @var $relation string
     */
    protected $relation;

    /**
     * @var $ids
     */
    protected $ids;

    /**
     * @var $touch bool
     */
    protected $touch;

    /**
     * Toggle constructor.
     *
     * @param string $relation
     * @param $ids
     * @param bool $touch
     */
    public function __construct(string $relation, $ids, $touch = true)
    {
        $this->relation = $relation;
        $this->ids = $ids;
        $this->touch = $touch;
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
    public function isTouch(): bool
    {
        return $this->touch;
    }

    /**
     * {@inheritdoc}
     */
    public function do($model)
    {
        $this->checkModel($model);

        return $model->{$this->relation}()->toggle($this->ids, $this->touch);
    }
}
