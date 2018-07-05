<?php

namespace ArtemProger\Action\Manipulation\Model;

use ArtemProger\Action\Base\RelationValueAction;

class Create extends RelationValueAction {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'create';
    }
}
