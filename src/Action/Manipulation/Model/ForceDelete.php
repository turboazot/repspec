<?php

namespace ArtemProger\Repspec\Action\Manipulation\Model;

use ArtemProger\Repspec\Action\Base\RelationOptional;

class ForceDelete extends RelationOptional {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'forceDelete';
    }
}
