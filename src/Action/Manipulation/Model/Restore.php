<?php

namespace ArtemProger\Repspec\Action\Manipulation\Model;

use ArtemProger\Repspec\Action\Base\RelationOptional;

class Restore extends RelationOptional {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'restore';
    }
}
