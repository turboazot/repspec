<?php

namespace ArtemProger\Repspec\Action\Manipulation\Query;

use ArtemProger\Repspec\Action\Base\NoArgumentAction;

class Delete extends NoArgumentAction {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'delete';
    }
}
