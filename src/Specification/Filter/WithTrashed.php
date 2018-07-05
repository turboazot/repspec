<?php

namespace ArtemProger\Repspec\Specification\Filter;

use ArtemProger\Repspec\Specification\Base\NoArgumentSpecification;

class WithTrashed extends NoArgumentSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'withTrashed';
    }
}
