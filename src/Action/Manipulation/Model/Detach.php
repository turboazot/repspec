<?php

namespace ArtemProger\Action\Manipulation\Model;

use ArtemProger\Action\Base\ModelManipulation;

class Detach extends ModelManipulation {

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
     * Detach constructor.
     *
     * @param string $relation
     * @param null $ids
     * @param bool $touch
     */
    public function __construct(string $relation, $ids = null, $touch = true)
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
    public function do($parentModel)
    {
        $this->checkModel($parentModel);

        return $parentModel->{$this->relation}()->detach(
            $this->ids,
            $this->touch
        );
    }
}
