<?php

namespace ArtemProger\Action\Manipulation\Query;

use ArtemProger\Action\Base\ActionInterface;

class Update implements ActionInterface {

    /**
     * @var $value mixed
     */
    protected $value;

    /**
     * Update constructor.
     *
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function do($builder)
    {
        return $builder->update($this->value);
    }
}
