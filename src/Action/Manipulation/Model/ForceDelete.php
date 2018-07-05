<?php

namespace ArtemProger\Action\Manipulation\Model;

use ArtemProger\Action\Base\RelationOptional;

class ForceDelete extends RelationOptional {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'forceDelete';
    }
}
