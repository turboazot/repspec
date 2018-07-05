<?php

namespace ArtemProger\Specification\Filter;

use ArtemProger\Specification\Base\ConditionBooleanSpecification;

class Time extends ConditionBooleanSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'whereTime';
    }
}
