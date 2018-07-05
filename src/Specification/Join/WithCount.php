<?php

namespace ArtemProger\Specification\Join;

use ArtemProger\Specification\Base\WithSpecification;

class WithCount extends WithSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'withCount';
    }
}
