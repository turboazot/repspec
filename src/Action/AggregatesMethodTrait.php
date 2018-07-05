<?php

namespace ArtemProger\Repspec\Action;

use ArtemProger\Repspec\Action\Structure\Aggregate;

trait AggregatesMethodTrait {

    /**
     * @param array $columns
     *
     * @return Aggregate
     */
    public static function avg($columns = ['*'])
    {
        return new Aggregate('avg', $columns);
    }

    /**
     * @param array $columns
     *
     * @return Aggregate
     */
    public static function count($columns = ['*'])
    {
        return new Aggregate('count', $columns);
    }

    /**
     * @param array $columns
     *
     * @return Aggregate
     */
    public static function max($columns = ['*'])
    {
        return new Aggregate('max', $columns);
    }

    /**
     * @param array $columns
     *
     * @return Aggregate
     */
    public static function min($columns = ['*'])
    {
        return new Aggregate('min', $columns);
    }

    /**
     * @param array $columns
     *
     * @return Aggregate
     */
    public static function sum($columns = ['*'])
    {
        return new Aggregate('sum', $columns);
    }
}
