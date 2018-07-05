<?php

namespace ArtemProger\Repspec\Specification\Join;

use ArtemProger\Repspec\Specification\Base\WithSpecification;

class With extends WithSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'with';
    }

}
