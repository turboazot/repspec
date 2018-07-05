<?php

namespace ArtemProger\Repspec\Action\Structure;

use ArtemProger\Repspec\Action\Base\NoArgumentAction;

class Collection extends NoArgumentAction {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'get';
    }
}
