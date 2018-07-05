<?php

namespace ArtemProger\Repspec\Specification\Filter;

use ArtemProger\Repspec\Specification\Base\ConditionBooleanSpecification;

class Day extends ConditionBooleanSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'whereDay';
    }
}
