<?php

namespace ArtemProger\Repspec\Action;

use ArtemProger\Repspec\Action\Structure\Aggregate;

trait AggregatesMethodTrait {

    /**
     * @param array $columns
     *
     * @return Aggregate
     */
    public static function avg($column)
    {
        return new Aggregate(__FUNCTION__, [$column]);
    }

    /**
     * @param array $columns
     *
     * @return Aggregate
     */
    public static function count($columns = '*')
    {
        if (is_null($columns)) {
            $columns = [];
        }

        $columns = !is_array($columns) ? [$columns] : $columns;

        return (int) new Aggregate(__FUNCTION__, $columns);
    }

    /**
     * @param array $columns
     *
     * @return Aggregate
     */
    public static function max($column)
    {
        return new Aggregate('max', [$column]);
    }

    /**
     * @param array $columns
     *
     * @return Aggregate
     */
    public static function min($column)
    {
        return new Aggregate('min', [$column]);
    }

    /**
     * @param array $columns
     *
     * @return Aggregate
     */
    public static function sum($column)
    {
        return new Aggregate('sum', [$column]);
    }
}
