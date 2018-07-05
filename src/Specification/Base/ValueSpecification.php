<?php

namespace ArtemProger\Repspec\Specification\Base;

abstract class ValueSpecification extends Specification {

    /**
     * @var $value mixed
     */
    protected $value;

    /**
     * ValueSpecification constructor.
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
    public function apply($builder)
    {
        $builder->{$this->getMethodName()}($this->value);
    }
}
