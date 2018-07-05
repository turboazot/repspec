<?php

namespace ArtemProger\Action\Manipulation\Model;

use ArtemProger\Action\Base\ModelManipulation;

class Attach extends ModelManipulation {

    /**
     * @var $relation string
     */
    protected $relation;

    /**
     * @var $id
     */
    protected $id;

    /**
     * @var $attributes array
     */
    protected $attributes;

    /**
     * @var $touch bool
     */
    protected $touch;

    /**
     * Attach constructor.
     *
     * @param string $relation
     * @param $id
     * @param array $attributes
     * @param bool $touch
     */
    public function __construct(string $relation, $id, array $attributes = [], $touch = true)
    {
        $this->relation = $relation;
        $this->id = $id;
        $this->attributes = $attributes;
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
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

        $parentModel->{$this->relation}()->attach(
            $this->id,
            $this->attributes,
            $this->touch
        );

        return $parentModel->save();
    }
}
