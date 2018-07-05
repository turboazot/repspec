<?php

namespace ArtemProger\Specification\Filter;

use ArtemProger\Specification\Base\ConditionBooleanSpecification;


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
