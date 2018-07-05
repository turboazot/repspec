<?php

namespace ArtemProger\Action\Structure;

use ArtemProger\Action\Base\NoArgumentAction;

class DoesntExist extends NoArgumentAction {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'doesntExist';
    }
}
