<?php

namespace ArtemProger\Action\Manipulation\Model;

use ArtemProger\Action\Base\RelationOptional;

class Restore extends RelationOptional {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'restore';
    }
}
