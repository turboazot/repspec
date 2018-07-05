<?php

namespace ArtemProger\Action\Lock;

use ArtemProger\Action\Base\ActionInterface;

class Lock implements ActionInterface {

    /**
     * @var $value bool
     */
    protected $value;

    /**
     * Lock constructor.
     *
     * @param bool $value
     */
    public function __construct($value = true)
    {
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function getValue(): bool
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function do($builder)
    {
        return $builder->lock($this->value);
    }
}
