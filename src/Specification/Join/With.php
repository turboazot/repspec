<?php

namespace ArtemProger\Specification\Join;

use ArtemProger\Specification\Base\WithSpecification;

class With extends WithSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'with';
    }

}
