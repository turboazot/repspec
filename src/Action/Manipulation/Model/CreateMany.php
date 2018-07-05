<?php

namespace ArtemProger\Action\Manipulation\Model;

use ArtemProger\Action\Base\RelationValueAction;

class CreateMany extends RelationValueAction {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'createMany';
    }
}
