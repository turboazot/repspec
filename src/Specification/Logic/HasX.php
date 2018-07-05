<?php

namespace ArtemProger\Specification\Logic;

use ArtemProger\Specification\Base\ChildrenTrait;
use ArtemProger\Specification\Base\HaveSpecification;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class HasX extends HaveSpecification {

    /**
     * HasX constructor.
     *
     * @param $relation
     * @param string $operator
     * @param int $count
     * @param string $boolean
     * @param array|null $children
     */
    public function __construct(
        $relation, 
        $operator = '>=', 
        $count = 1, 
        $boolean = 'and', 
        array $children = null
    ) {
        $this->relation = $relation;
        $this->operator = $operator;
        $this->count = $count;
        $this->boolean = $boolean;
        $this->children = $children;
    }
}
