<?php

namespace ArtemProger\Action\Base;

use Illuminate\Database\Eloquent\Model;

abstract class ModelManipulation implements ActionInterface
{
    /**
     * Checks if data is model
     *
     * @param $data mixed
     */
    public function checkModel($data)
    {
        if (!$data instanceof Model) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Class %s works with models only',
                    get_class($this)
                )
            );
        }
    }
}