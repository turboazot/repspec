<?php

namespace ArtemProger\Repspec\Action\Manipulation\Model;

use ArtemProger\Repspec\Action\Base\ModelManipulation;

class Delete extends ModelManipulation {

    /**
     * {@inheritdoc}
     */
    public function do($model)
    {
        $this->checkModel($model);

        return $model->delete();
    }
}
