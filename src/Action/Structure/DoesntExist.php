<?php

namespace ArtemProger\Repspec\Action\Structure;

use ArtemProger\Repspec\Action\Base\NoArgumentAction;

class DoesntExist extends NoArgumentAction {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'doesntExist';
    }
}
