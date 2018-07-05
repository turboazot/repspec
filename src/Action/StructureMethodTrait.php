<?php

namespace ArtemProger\Action;

use ArtemProger\Action\Structure\Chunk;
use ArtemProger\Action\Structure\Collection;
use ArtemProger\Action\Structure\Cursor;
use ArtemProger\Action\Structure\DoesntExist;
use ArtemProger\Action\Structure\Exists;
use ArtemProger\Action\Structure\Paginate;
use ArtemProger\Action\Structure\SimplePaginate;
use ArtemProger\Action\Structure\Single;
use ArtemProger\Action\Structure\Value;

trait StructureMethodTrait {

    /**
     * @param string $count
     * @param callable $handler
     *
     * @return Chunk
     */
    public static function chunk(string $count, callable $handler)
    {
        return new Chunk($count, $handler);
    }

    /**
     * @return Collection
     */
    public static function toCollection()
    {
        return new Collection();
    }

    /**
     * @return Cursor
     */
    public static function toCursor()
    {
        return new Cursor();
    }

    /**
     * @return DoesntExist
     */
    public static function checkDoesntExist()
    {
        return new DoesntExist();
    }

    /**
     * @return Exists
     */
    public static function checkExists()
    {
        return new Exists();
    }

    /**
     * @param null $perPage
     * @param array $columns
     * @param string $pageName
     * @param null $page
     *
     * @return Paginate
     */
    public static function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null)
    {
        return new Paginate($perPage, $columns, $pageName, $page);
    }

    /**
     * @param null $perPage
     * @param array $columns
     * @param string $pageName
     * @param null $page
     *
     * @return SimplePaginate
     */
    public static function simplePaginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null)
    {
        return new SimplePaginate($perPage, $columns, $pageName, $page);
    }

    /**
     * @return Single
     */
    public static function toSingle()
    {
        return new Single();
    }

    /**
     * @param string $column
     *
     * @return Value
     */
    public static function toValue(string $column)
    {
        return new Value($column);
    }
}
