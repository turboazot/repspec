<?php

namespace ArtemProger\Specification\Join;

use ArtemProger\Specification\SpecificationInterface;

class On implements SpecificationInterface {

    /**
     * @var $first 
     */
    protected $first;

    /**
     * @var $operator 
     */
    protected $operator;

    /**
     * @var $second 
     */
    protected $second;

    /**
     * @var $boolean string
     */
    protected $boolean;

    /**
     * On constructor.
     *
     * @param $first
     * @param null $operator
     * @param null $second
     * @param string $boolean
     */
    public function __construct($first, $operator = null, $second = null, $boolean = 'and')
    {
        $this->first = $first;
        $this->operator = $operator;
        $this->second = $second;
        $this->boolean = $boolean;
    }

    /**
     * @return mixed
     */
    public function getFirst()
    {
        return $this->first;
    }

    /**
     * @return mixed
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @return mixed
     */
    public function getSecond()
    {
        return $this->second;
    }

    /**
     * @return string
     */
    public function getBoolean(): string
    {
        return $this->boolean;
    }

    /**
     * {@inheritdoc}
     */
    public function apply($builder)
    {
        $builder->on(
            $this->first,
            $this->operator,
            $this->second,
            $this->boolean
        );
    }
}
