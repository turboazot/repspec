<?php

namespace ArtemProger\Specification\Base;

use ArtemProger\Specification\Base\Specification;
use Illuminate\Database\Eloquent\Builder;

abstract class ColumnValueSpecification extends Specification {

    /**
     * @var $column string
     */
    protected $column;

    /**
     * @var $value mixed
     */
    protected $value;

    /**
     * ColumnValueSpecification constructor.
     *
     * @param string $column
     * @param $value
     */
    public function __construct(string $column, $value)
    {
        $this->column = $column;
        $this->value = $value;
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
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function apply($builder)
    {
        $builder->{$this->getMethodName()}($this->column, $this->value);
    }
}
