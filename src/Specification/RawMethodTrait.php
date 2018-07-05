<?php

namespace ArtemProger\Repspec\Specification;

use ArtemProger\Repspec\Specification\Query\OrderBy;
use ArtemProger\Repspec\Specification\Raw\HavingRaw;
use ArtemProger\Repspec\Specification\Raw\SelectRaw;
use ArtemProger\Repspec\Specification\Raw\WhereRaw;

trait RawMethodTrait {

    /**
     * @param string $expression
     * @param array $parameters
     * @param string $boolean
     *
     * @return HavingRaw
     */
    public static function havingRaw(string $expression, array $parameters = [], $boolean = 'and')
    {
        return new HavingRaw($expression, $parameters, $boolean);
    }

    /**
     * @param $sql
     * @param array $bindings
     *
     * @return HavingRaw
     */
    public static function orHavingRaw($sql, array $bindings = [])
    {
        return self::havingRaw($sql, $bindings, 'or');
    }

    /**
     * @param string $expression
     * @param array $parameters
     *
     * @return OrderBy
     */
    public static function orderByRaw(string $expression, array $parameters = [])
    {
        return new OrderBy($expression, $parameters);
    }

    /**
     * @param string $expression
     * @param array $parameters
     *
     * @return SelectRaw
     */
    public static function selectRaw(string $expression, array $parameters = [])
    {
        return new SelectRaw($expression, $parameters);
    }

    /**
     * @param string $expression
     * @param array $parameters
     * @param string $boolean
     *
     * @return WhereRaw
     */
    public static function whereRaw(string $expression, array $parameters = [], $boolean = 'and')
    {
        return new WhereRaw($expression, $parameters, $boolean);
    }

    /**
     * @param $sql
     * @param array $bindings
     *
     * @return WhereRaw
     */
    public static function orWhereRaw($sql, $bindings = [])
    {
        return self::whereRaw($sql, $bindings, 'or');
    }
}
