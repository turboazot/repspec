<?php

namespace ArtemProger\Action\Manipulation\Query;

use ArtemProger\Action\Base\XCrementAction;

class Decrement extends XCrementAction {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'decrement';
    }
}
