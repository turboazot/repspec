<?php

namespace ArtemProger\Specification\Join;

use ArtemProger\Specification\Base\ChildrenTrait;
use ArtemProger\Specification\SpecificationInterface;

class Join implements SpecificationInterface {

    use ChildrenTrait;

    /**
     * @var $table string
     */
    protected $table;

    /**
     * @var $first string|array[SpecificationInterface]
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
     * @var $type string
     */
    protected $type;

    /**
     * @var $where bool
     */
    protected $where;

    /**
     * Join constructor.
     *
     * @param $table
     * @param $first
     * @param null $operator
     * @param null $second
     * @param string $type
     * @param bool $where
     */
    public function __construct($table, $first, $operator = null, $second = null, $type = 'inner', $where = false)
    {
        $this->table = $table;
        $this->first = $first;
        $this->operator = $operator;
        $this->second = $second;
        $this->type = $type;
        $this->where = $where;
    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }

    /**
     * @return array|string
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
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return bool
     */
    public function isWhere(): bool
    {
        return $this->where;
    }

    /**
     * {@inheritdoc}
     */
    public function apply($builder)
    {
        if (is_array($this->first)) {
            $this->children = $this->first;
            $builder->join($this->table, function ($join) {
                $this->applyChildrenToBuilder($join);   
            });
        } else {
            $builder->join(
                $this->table,
                $this->first,
                $this->operator,
                $this->second,
                $this->type,
                $this->where
            );
        }
    }
}
