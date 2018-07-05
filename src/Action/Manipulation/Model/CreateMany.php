<?php

namespace ArtemProger\Repspec\Action\Manipulation\Model;

use ArtemProger\Repspec\Action\Base\RelationValueAction;

class CreateMany extends RelationValueAction {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'createMany';
    }
}
