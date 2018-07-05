<?php

namespace ArtemProger\Repspec\Specification\Base;

use ArtemProger\Repspec\Specification\SpecificationInterface;

abstract class ColumnValueBooleanNotSpecification implements SpecificationInterface {

    /**
     * @var $column string
     */
    protected $column;

    /**
     * @var $values 
     */
    protected $values;

    /**
     * @var $boolean string
     */
    protected $boolean;

    /**
     * @var $not bool
     */
    protected $not;

    /**
     * ColumnValueBooleanNotSpecification constructor.
     *
     * @param $column
     * @param array $values
     * @param string $boolean
     * @param bool $not
     */
    public function __construct($column, array $values, $boolean = 'and', $not = false)
    {
        $this->column = $column;
        $this->values = $values;
        $this->boolean = $boolean;
        $this->not = $not;
    }

    /**
     * @return string
     */
    public function getColumn(): string
    {
        return $this->column;
    }

    /**
     * @return mixed
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @return string
     */
    public function getBoolean(): string
    {
        return $this->boolean;
    }

    /**
     * @return bool
     */
    public function isNot(): bool
    {
        return $this->not;
    }

    /**
     * {@inheritdoc}
     */
    public function apply($builder)
    {
        $builder->{$this->getMethodName()}(
            $this->column,
            $this->values,
            $this->boolean,
            $this->not
        );
    }
}

