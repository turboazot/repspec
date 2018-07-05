<?php

namespace ArtemProger\Repspec\Specification\Filter;

use ArtemProger\Repspec\Specification\Base\ColumnSpecification;
use ArtemProger\Repspec\Specification\SpecificationInterface;

class IsNull implements SpecificationInterface {

    /**
     * @var $column string
     */
    protected $column;

    /**
     * @var $boolean string
     */
    protected $boolean;

    /**
     * @var $not bool
     */
    protected $not;

    /**
     * IsNull constructor.
     *
     * @param $column
     * @param string $boolean
     * @param bool $not
     */
    public function __construct($column, $boolean = 'and', $not = false)
    {
        $this->column = $column;
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
        $builder->whereNull(
            $this->column,
            $this->boolean,
            $this->not
        );
    }
}
