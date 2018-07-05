<?php

namespace ArtemProger\Specification\Filter;

use ArtemProger\Specification\Base\ConditionBooleanSpecification;

class Year extends ConditionBooleanSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'whereYear';
    }
}
