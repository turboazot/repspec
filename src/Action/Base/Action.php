<?php

namespace ArtemProger\Action\Base;

use ArtemProger\MethodNameTrait;
use Illuminate\Database\Eloquent\Model;

abstract class Action implements ActionInterface {

    use MethodNameTrait;

    /**
     * @param $model Model
     */
    protected function checkModel($model)
    {
        
        if (!$model instanceof Model) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Class %s accepts only %s instance',
                    self::class,
                    Model::class
                )
            );
        }
    }
}
