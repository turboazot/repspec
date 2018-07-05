<?php

namespace ArtemProger\Action\Structure;

use ArtemProger\Action\Base\NoArgumentAction;

class Single extends NoArgumentAction {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'first';
    }
}
