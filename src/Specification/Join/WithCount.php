<?php

namespace ArtemProger\Repspec\Specification\Join;

use ArtemProger\Repspec\Specification\Base\WithSpecification;

class WithCount extends WithSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'withCount';
    }
}
