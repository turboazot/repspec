<?php

namespace ArtemProger\Specification;

use ArtemProger\Specification\Filter\Between;
use ArtemProger\Specification\Filter\Date;
use ArtemProger\Specification\Filter\Day;
use ArtemProger\Specification\Filter\ExistsX;
use ArtemProger\Specification\Filter\In;
use ArtemProger\Specification\Filter\IsNull;
use ArtemProger\Specification\Filter\Month;
use ArtemProger\Specification\Filter\OnlyTrashed;
use ArtemProger\Specification\Filter\Time;
use ArtemProger\Specification\Filter\When;
use ArtemProger\Specification\Filter\Where;
use ArtemProger\Specification\Filter\WhereX;
use ArtemProger\Specification\Filter\WithTrashed;
use ArtemProger\Specification\Filter\Year;

trait FilterMethodTrait {

    /**
     * @param $column
     * @param array $values
     * @param string $boolean
     * @param bool $not
     *
     * @return Between
     */
    public static function between($column, array $values, $boolean = 'and', $not = false)
    {
        return new Between($column, $values, $boolean, $not);
    }

    /**
     * @param $column
     * @param array $values
     *
     * @return Between
     */
    public static function orBetween($column, array $values)
    {
        return self::between($column, $values, 'or');
    }

    /**
     * @param $column
     * @param array $values
     * @param string $boolean
     *
     * @return Between
     */
    public static function notBetween($column, array $values, $boolean = 'and')
    {
        return self::between($column, $values, $boolean, true);
    }

    /**
     * @param $column
     * @param array $values
     *
     * @return Between
     */
    public static function orNotBetween($column, array $values)
    {
        return self::notBetween($column, $values, 'or');
    }

    /**
     * @param $column
     * @param $operator
     * @param null $value
     * @param string $boolean
     *
     * @return Date
     */
    public static function date($column, $operator, $value = null, $boolean = 'and')
    {
        return new Date($column, $operator, $value, $boolean);
    }

    /**
     * @param $column
     * @param $operator
     * @param null $value
     *
     * @return Date
     */
    public static function orDate($column, $operator, $value = null)
    {
        return self::date($column, $operator, $value, 'or');
    }

    /**
     * @param $column
     * @param $operator
     * @param null $value
     * @param string $boolean
     *
     * @return Day
     */
    public static function day($column, $operator, $value = null, $boolean = 'and')
    {
        return new Day($column, $operator, $value, $boolean);
    }

    /**
     * @param $column
     * @param $operator
     * @param null $value
     *
     * @return Day
     */
    public static function orDay($column, $operator, $value = null)
    {
        return self::day($column, $operator, $value, 'or');
    }

    /**
     * @param array $specs
     * @param string $boolean
     * @param bool $not
     *
     * @return ExistsX
     */
    public static function exists(array $specs, $boolean = 'and', $not = false)
    {
        return new ExistsX($specs, $boolean, $not);
    }

    /**
     * @param array $specs
     * @param bool $not
     *
     * @return ExistsX
     */
    public static function orExists(array $specs, $not = false)
    {
        return self::exists($specs, 'or', $not);
    }

    /**
     * @param array $specs
     * @param string $boolean
     *
     * @return ExistsX
     */
    public static function notExists(array $specs, $boolean = 'and')
    {
        return self::exists($specs, $boolean, true);
    }

    /**
     * @param array $specs
     *
     * @return ExistsX
     */
    public static function orNotExists(array $specs)
    {
        return self::orExists($specs, true);
    }

    /**
     * @param $column
     * @param $values
     * @param string $boolean
     * @param bool $not
     *
     * @return In
     */
    public static function in($column, $values, $boolean = 'and', $not = false)
    {
        return new In($column, $values, $boolean, $not);
    }

    /**
     * @param $column
     * @param $values
     *
     * @return In
     */
    public static function orIn($column, $values)
    {
        return self::in($column, $values, 'or');
    }

    /**
     * @param $column
     * @param $values
     * @param string $boolean
     *
     * @return In
     */
    public static function notIn($column, $values, $boolean = 'and')
    {
        return self::in($column, $values, $boolean, true);
    }

    /**
     * @param $column
     * @param $values
     *
     * @return In
     */
    public static function orWhereNotIn($column, $values)
    {
        return self::notIn($column, $values, 'or');
    }

    /**
     * @param $column
     * @param string $boolean
     * @param bool $not
     *
     * @return IsNull
     */
    public static function isNull($column, $boolean = 'and', $not = false)
    {
        return new IsNull($column, $boolean, $not);
    }

    /**
     * @param $column
     *
     * @return IsNull
     */
    public static function orIsNull($column)
    {
        return self::isNull($column, 'or');
    }

    /**
     * @param $column
     * @param string $boolean
     *
     * @return IsNull
     */
    public static function isNotNull($column, $boolean = 'and')
    {
        return self::isNull($column, $boolean, true);
    }

    /**
     * @param $column
     * @param $operator
     * @param null $value
     * @param string $boolean
     *
     * @return Month
     */
    public static function month($column, $operator, $value = null, $boolean = 'and')
    {
        return new Month($column, $operator, $value, $boolean);
    }

    /**
     * @param $column
     * @param $operator
     * @param null $value
     *
     * @return Month
     */
    public static function orMonth($column, $operator, $value = null)
    {
        return self::month($column, $operator, $value, 'or');
    }

    /**
     * @return OnlyTrashed
     */
    public static function onlyTrashed()
    {
        return new OnlyTrashed();
    }

    /**
     * @param $column
     * @param $operator
     * @param null $value
     * @param string $boolean
     *
     * @return Time
     */
    public static function time($column, $operator, $value = null, $boolean = 'and')
    {
        return new Time($column, $operator, $value, $boolean);
    }

    /**
     * @param $column
     * @param $operator
     * @param null $value
     *
     * @return Time
     */
    public static function orTime($column, $operator, $value = null)
    {
        return self::time($column, $operator, $value, 'or');
    }

    /**
     * @param $value
     * @param array $trueSpecs
     * @param array $falseSpecs
     *
     * @return When
     */
    public static function when($value, array $trueSpecs, array $falseSpecs = [])
    {
        return new When($value, $trueSpecs, $falseSpecs);
    }

    /**
     * @param $column
     * @param null $operator
     * @param null $value
     * @param string $boolean
     *
     * @return Where
     */
    public static function where($column, $operator = null, $value = null, $boolean = 'and')
    {
        return new Where($column, $operator, $value, $boolean);
    }

    /**
     * @param $column
     * @param null $operator
     * @param null $value
     *
     * @return Where
     */
    public static function orWhere($column, $operator = null, $value = null)
    {
        return self::where($column, $operator, $value, 'or');
    }

    /**
     * @param $first
     * @param null $operator
     * @param null $second
     * @param string $boolean
     *
     * @return WhereX
     */
    public static function column($first, $operator = null, $second = null, $boolean = 'and')
    {
        return new WhereX($first, $operator, $second, $boolean);
    }

    /**
     * @param $first
     * @param null $operator
     * @param null $second
     *
     * @return WhereX
     */
    public static function orColumn($first, $operator = null, $second = null)
    {
        return self::column($first, $operator, $second, 'or');
    }

    /**
     * @return WithTrashed
     */
    public static function withTrashed()
    {
        return new WithTrashed();
    }

    /**
     * @param $column
     * @param $operator
     * @param null $value
     * @param string $boolean
     *
     * @return Year
     */
    public static function year($column, $operator, $value = null, $boolean = 'and')
    {
        return new Year($column, $operator, $value, $boolean);
    }

    /**
     * @param $column
     * @param $operator
     * @param null $value
     *
     * @return Year
     */
    public static function orYear($column, $operator, $value = null)
    {
        return self::year($column, $operator, $value, 'or');
    }
}
