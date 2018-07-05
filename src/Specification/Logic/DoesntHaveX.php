<?php

namespace ArtemProger\Repspec\Specification\Logic;

use ArtemProger\Repspec\Specification\Base\ChildrenTrait;
use ArtemProger\Repspec\Specification\Base\HaveSpecification;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class DoesntHaveX extends HaveSpecification {

    /**
     * DoesntHaveX constructor.
     *
     * @param $relation
     * @param string $boolean
     * @param array|null $children
     */
    public function __construct($relation, $boolean = 'and', array $children = null) {
        $this->relation = $relation;
        $this->operator = '<';
        $this->count = '1';
        $this->boolean = $boolean;
        $this->children = $children;
    }
}
