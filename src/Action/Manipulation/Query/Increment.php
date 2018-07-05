<?php

namespace ArtemProger\Action\Manipulation\Query;

use ArtemProger\Action\Base\XCrementAction;

class Increment extends XCrementAction {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'increment';
    }
}
