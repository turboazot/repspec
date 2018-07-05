<?php

namespace ArtemProger\Repspec\Specification\Filter;

use ArtemProger\Repspec\Specification\Base\ConditionBooleanSpecification;


class Where extends ConditionBooleanSpecification {

    /**
     * {@inheritdoc}
     */
    protected $likeable = true;

    /**
     * {@inheritdoc}
     */
    protected $optionalOperator = true;

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'where';
    }
}
