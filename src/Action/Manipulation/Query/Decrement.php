<?php

namespace ArtemProger\Repspec\Action\Manipulation\Query;

use ArtemProger\Repspec\Action\Base\XCrementAction;

class Decrement extends XCrementAction {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'decrement';
    }
}
