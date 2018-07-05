<?php

namespace ArtemProger\Action\Manipulation\Query;

use ArtemProger\Action\Base\NoArgumentAction;

class Delete extends NoArgumentAction {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'delete';
    }
}
