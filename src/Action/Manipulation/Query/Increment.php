<?php

namespace ArtemProger\Repspec\Action\Manipulation\Query;

use ArtemProger\Repspec\Action\Base\XCrementAction;

class Increment extends XCrementAction {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'increment';
    }
}
