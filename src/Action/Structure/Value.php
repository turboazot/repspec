<?php

namespace ArtemProger\Action\Structure;

use ArtemProger\Action\Base\ActionInterface;

class Value implements ActionInterface {

    /**
     * @var $column string
     */
    protected $column;

    /**
     * Value constructor.
     *
     * @param string $column
     */
    public function __construct(string $column)
    {
        $this->column = $column;
    }

    /**
     * @return string
     */
    public function getColumn(): string
    {
        return $this->column;
    }

    /**
     * {@inheritdoc}
     */
    public function do($builder)
    {
        return $builder->value($this->column);
    }
}
