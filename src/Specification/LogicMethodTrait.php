<?php

namespace ArtemProger\Repspec\Specification;

use ArtemProger\Repspec\Specification\Logic\AndX;
use ArtemProger\Repspec\Specification\Logic\DoesntHaveX;
use ArtemProger\Repspec\Specification\Logic\HasX;

trait LogicMethodTrait {

    /**
     * @param array ...$specs
     *
     * @return AndX
     */
    public static function andX(...$specs)
    {
        return new AndX(...$specs);
    }

    /**
     * @param $relation
     * @param string $boolean
     * @param array|null $children
     *
     * @return DoesntHaveX
     */
    public static function doesntHaveX($relation, $boolean = 'and', array $children = null)
    {
        return new DoesntHaveX($relation, $boolean, $children);
    }

    /**
     * @param $relation
     * @param string $operator
     * @param int $count
     * @param string $boolean
     * @param array|null $children
     *
     * @return HasX
     */
    public static function hasX(
        $relation,
        $operator = '>=',
        $count = 1,
        $boolean = 'and',
        array $children = null
    ) {
        return new HasX(
            $relation,
            $operator,
            $count,
            $boolean,
            $children
        );
    }

}
