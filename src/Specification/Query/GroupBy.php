<?php

namespace ArtemProger\Repspec\Specification\Query;

use ArtemProger\Repspec\Specification\SpecificationInterface;

class GroupBy implements SpecificationInterface {

    /**
     * @var $column
     */
    protected $groups;

    /**
     * GroupBy constructor.
     *
     * @param array ...$groups
     */
    public function __construct(...$groups)
    {
        if (count($groups) == 0) {
            throw new \ArgumentCountError(
                sprintf(
                    'Class %s accepts at least one argument',
                    self::class
                )
            );
        }
        $this->groups = $groups;
    }

    /**
     * @return mixed
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param $builder
     */
    public function apply($builder)
    {
        $builder->groupBy(...$this->groups);
    }
}
