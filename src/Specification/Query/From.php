<?php

namespace ArtemProger\Specification\Query;

use ArtemProger\Specification\SpecificationInterface;

class From implements SpecificationInterface {

    /**
     * @var $table string
     */
    protected $table;

    /**
     * From constructor.
     *
     * @param string $table
     */
    public function __construct(string $table)
    {
        $this->table = $table;
    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }

    /**
     * {@inheritdoc}
     */
    public function apply($builder)
    {
        $builder->from($this->table);
    }
}
