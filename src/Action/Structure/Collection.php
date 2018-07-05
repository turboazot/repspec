<?php

namespace ArtemProger\Action\Structure;

use ArtemProger\Action\Base\NoArgumentAction;

class Collection extends NoArgumentAction {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'get';
    }
}
