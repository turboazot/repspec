<?php

namespace ArtemProger\Specification\Filter;

use ArtemProger\Specification\Base\ConditionBooleanSpecification;

class Day extends ConditionBooleanSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'whereDay';
    }
}
