<?php

namespace ArtemProger\Repspec\Specification;

use ArtemProger\Repspec\Specification\Query\Distinct;
use ArtemProger\Repspec\Specification\Query\From;
use ArtemProger\Repspec\Specification\Query\GroupBy;
use ArtemProger\Repspec\Specification\Query\Having;
use ArtemProger\Repspec\Specification\Query\Limit;
use ArtemProger\Repspec\Specification\Query\Offset;
use ArtemProger\Repspec\Specification\Query\OrderBy;
use ArtemProger\Repspec\Specification\Query\Random;
use ArtemProger\Repspec\Specification\Query\Select;

trait QueryMethodTrait {

    /**
     * @return Distinct
     */
    public static function distinct()
    {
        return new Distinct();
    }

    /**
     * @param string $table
     *
     * @return From
     */
    public static function from(string $table)
    {
        return new From($table);
    }

    /**
     * @param array ...$groups
     *
     * @return GroupBy
     */
    public static function groupBy(...$groups)
    {
        return new GroupBy(...$groups);
    }

    /**
     * @param $column
     * @param null $operator
     * @param null $value
     * @param string $boolean
     *
     * @return Having
     */
    public static function having($column, $operator = null, $value = null, $boolean = 'and')
    {
        return new Having($column, $operator, $value, $boolean);
    }

    /**
     * @param $column
     * @param null $operator
     * @param null $value
     *
     * @return Having
     */
    public static function orHaving($column, $operator = null, $value = null)
    {
        return self::having($column, $operator, $value, 'or');
    }

    /**
     * @param $value
     *
     * @return Limit
     */
    public static function limit($value)
    {
        return new Limit($value);
    }

    /**
     * @param $value
     *
     * @return Offset
     */
    public static function offset($value)
    {
        return new Offset($value);
    }

    /**
     * @param $column
     * @param string $orderType
     *
     * @return OrderBy
     */
    public static function orderBy($column, $orderType = OrderBy::ASC)
    {
        return new OrderBy($column, $orderType);
    }

    /**
     * @return Random
     */
    public static function random()
    {
        return new Random();
    }

    /**
     * @param array ...$args
     *
     * @return Select
     */
    public static function select(...$args)
    {
        return new Select(...$args);
    }

}
