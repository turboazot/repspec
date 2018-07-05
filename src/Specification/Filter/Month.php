<?php

namespace ArtemProger\Specification\Filter;

use ArtemProger\Specification\Base\ConditionBooleanSpecification;

class Month extends ConditionBooleanSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'whereMonth';
    }
}
