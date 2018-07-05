<?php

namespace ArtemProger\Specification;

use ArtemProger\Specification\Join\CrossJoin;
use ArtemProger\Specification\Join\Join;
use ArtemProger\Specification\Join\On;
use ArtemProger\Specification\Join\With;
use ArtemProger\Specification\Join\WithCount;

trait JoinMethodTrait {

    /**
     * @param $table
     * @param $first
     * @param null $operator
     * @param null $second
     * @param string $type
     * @param bool $where
     * @param array|null $specs
     *
     * @return Join
     */
    public static function join(
        $table,
        $first,
        $operator = null,
        $second = null,
        $type = 'inner',
        $where = false,
        array $specs = null
    ) {
        $join = new Join($table, $first, $operator, $second, $type, $where);
        $join->setChildren($specs);

        return $join;
    }

    /**
     * @param $table
     * @param $first
     * @param $operator
     * @param $second
     * @param string $type
     * @param array|null $specs
     *
     * @return Join
     */
    public static function joinWhere($table, $first, $operator, $second, $type = 'inner', array $specs = null)
    {
        return self::join($table, $first, $operator, $second, $type, true, $specs);
    }

    /**
     * @param $table
     * @param $first
     * @param null $operator
     * @param null $second
     * @param array|null $specs
     *
     * @return Join
     */
    public static function leftJoin($table, $first, $operator = null, $second = null, array $specs = null)
    {
        return self::join($table, $first, $operator, $second, 'left', $specs);
    }

    /**
     * @param $table
     * @param $first
     * @param $operator
     * @param $second
     * @param array|null $specs
     *
     * @return Join
     */
    public static function leftJoinWhere($table, $first, $operator, $second, array $specs = null)
    {
        return self::joinWhere($table, $first, $operator, $second, 'left', $specs);
    }

    /**
     * @param $table
     * @param $first
     * @param null $operator
     * @param null $second
     * @param array|null $specs
     *
     * @return Join
     */
    public static function rightJoin($table, $first, $operator = null, $second = null, array $specs = null)
    {
        return self::join($table, $first, $operator, $second, 'right', $specs);
    }

    /**
     * @param $table
     * @param $first
     * @param $operator
     * @param $second
     * @param array|null $specs
     *
     * @return Join
     */
    public static function rightJoinWhere($table, $first, $operator, $second, array $specs = null)
    {
        return self::joinWhere($table, $first, $operator, $second, 'right', $specs);
    }

    /**
     * @param $table
     * @param null $first
     * @param null $operator
     * @param null $second
     * @param array|null $specs
     *
     * @return CrossJoin
     */
    public static function crossJoin($table, $first = null, $operator = null, $second = null, array $specs = null)
    {
        $crossJoin = new CrossJoin($table, $first, $operator, $second);
        $crossJoin->setChildren($specs);

        return $crossJoin;
    }

    /**
     * @param $first
     * @param null $operator
     * @param null $second
     * @param string $boolean
     *
     * @return On
     */
    public static function on($first, $operator = null, $second = null, $boolean = 'and')
    {
        return new On($first, $operator, $second, $boolean);
    }

    /**
     * @param $first
     * @param null $operator
     * @param null $second
     *
     * @return On
     */
    public static function orOn($first, $operator = null, $second = null)
    {
        return self::on($first, $operator, $second, 'or');
    }

    /**
     * @param $relations
     *
     * @return With
     */
    public static function with($relations)
    {
        return new With($relations);
    }

    /**
     * @param $relations
     *
     * @return WithCount
     */
    public static function withCount($relations)
    {
        return new WithCount($relations);
    }
}
