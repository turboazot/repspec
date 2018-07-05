<?php

namespace ArtemProger\Action;

use ArtemProger\Action\Manipulation\Model\Associate;
use ArtemProger\Action\Manipulation\Model\Attach;
use ArtemProger\Action\Manipulation\Model\Create;
use ArtemProger\Action\Manipulation\Model\CreateMany;
use ArtemProger\Action\Manipulation\Model\Detach;
use ArtemProger\Action\Manipulation\Model\Dissociate;
use ArtemProger\Action\Manipulation\Model\ForceDelete;
use ArtemProger\Action\Manipulation\Model\Restore;
use ArtemProger\Action\Manipulation\Model\SaveMany;
use ArtemProger\Action\Manipulation\Model\SaveModel;
use ArtemProger\Action\Manipulation\Model\SaveRelation;
use ArtemProger\Action\Manipulation\Model\Sync;
use ArtemProger\Action\Manipulation\Model\Toggle;
use ArtemProger\Action\Manipulation\Model\Update as UpdateModel;
use ArtemProger\Action\Manipulation\Model\UpdateExistingPivot;
use ArtemProger\Action\Manipulation\Query\Decrement;
use ArtemProger\Action\Manipulation\Query\Delete;
use ArtemProger\Action\Manipulation\Query\Increment;
use ArtemProger\Action\Manipulation\Query\Update as UpdateQuery;
use Illuminate\Database\Eloquent\Model;

trait ManipulationMethodTrait {

    /**
     * Model actions
     */

    /**
     * @param string $relation
     * @param $childModel
     *
     * @return Associate
     */
    public static function associate(string $relation, $childModel)
    {
        return new Associate($relation, $childModel);
    }

    /**
     * @param string $relation
     * @param $id
     * @param array $attributes
     * @param bool $touch
     *
     * @return Attach
     */
    public static function attach(string $relation, $id, array $attributes = [], $touch = true)
    {
        return new Attach($relation, $id, $attributes, $touch);
    }

    /**
     * @param string $relation
     * @param $value
     *
     * @return Create
     */
    public static function create(string $relation, $value)
    {
        return new Create($relation, $value);
    }

    /**
     * @param string $relation
     * @param $value
     *
     * @return CreateMany
     */
    public static function createMany(string $relation, $value)
    {
        return new CreateMany($relation, $value);
    }

    /**
     * @param string $relation
     * @param null $ids
     * @param bool $touch
     *
     * @return Detach
     */
    public static function detach(string $relation, $ids = null, $touch = true)
    {
        return new Detach($relation, $ids, $touch);
    }

    /**
     * @param $relation
     *
     * @return Dissociate
     */
    public static function dissociate($relation)
    {
        return new Dissociate($relation);
    }

    /**
     * @param string|null $relation
     *
     * @return ForceDelete
     */
    public static function forceDelete(string $relation = null)
    {
        return new ForceDelete($relation);
    }

    /**
     * @param string|null $relation
     *
     * @return Restore
     */
    public static function restore(string $relation = null)
    {
        return new Restore($relation);
    }

    /**
     * @param string $relation
     * @param $models
     * @param array $pivotAttributes
     *
     * @return SaveMany
     */
    public static function saveMany(string $relation, $models, array $pivotAttributes = [])
    {
        return new SaveMany($relation, $models, $pivotAttributes);
    }

    /**
     * @param array $options
     *
     * @return SaveModel
     */
    public static function save(array $options = [])
    {
        return new SaveModel($options);
    }

    /**
     * @param string $relation
     * @param Model $model
     *
     * @return SaveRelation
     */
    public static function saveRelation(string $relation, Model $model)
    {
        return new SaveRelation($relation, $model);
    }

    /**
     * @param string $relation
     * @param $ids
     *
     * @return Sync
     */
    public static function sync(string $relation, $ids)
    {
        return new Sync($relation, $ids, true);
    }

    /**
     * @param string $relation
     * @param $ids
     *
     * @return Sync
     */
    public static function syncWithoutDetaching(string $relation, $ids)
    {
        return new Sync($relation, $ids, false);
    }

    /**
     * @param string $relation
     * @param $ids
     * @param bool $touch
     *
     * @return Toggle
     */
    public static function toggle(string $relation, $ids, $touch = true)
    {
        return new Toggle($relation, $ids, $touch);
    }

    /**
     * @param array $attributes
     * @param array $options
     *
     * @return UpdateModel
     */
    public static function updateModel(array $attributes = [], array $options = [])
    {
        return new UpdateModel($attributes, $options);
    }

    /**
     * @param string $relation
     * @param $id
     * @param array $attributes
     * @param bool $touch
     *
     * @return UpdateExistingPivot
     */
    public static function updateExistingPivot(string $relation, $id, array $attributes, $touch = true)
    {
        return new UpdateExistingPivot($relation, $id, $attributes, $touch);
    }

    /**
     * Query actions
     */

    /**
     * @param $column
     * @param int $amount
     * @param array $extra
     *
     * @return Decrement
     */
    public static function decrement($column, $amount = 1, array $extra = [])
    {
        return new Decrement($column, $amount, $extra);
    }

    /**
     * @return Delete
     */
    public static function delete()
    {
        return new Delete();
    }

    /**
     * @param $column
     * @param int $amount
     * @param array $extra
     *
     * @return Increment
     */
    public static function increment($column, $amount = 1, array $extra = [])
    {
        return new Increment($column, $amount, $extra);
    }

    /**
     * @param $value
     *
     * @return UpdateQuery
     */
    public static function updateQuery($value)
    {
        return new UpdateQuery($value);
    }
}
