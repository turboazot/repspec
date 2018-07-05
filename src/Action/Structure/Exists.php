<?php

namespace ArtemProger\Action\Structure;

use ArtemProger\Action\Base\NoArgumentAction;

class Exists extends NoArgumentAction {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'exists';
    }
}
