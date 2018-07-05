<?php

namespace ArtemProger\Specification\Filter;

use ArtemProger\Specification\Base\NoArgumentSpecification;

class WithTrashed extends NoArgumentSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'withTrashed';
    }
}
