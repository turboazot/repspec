<?php

namespace ArtemProger\Specification\Query;

use ArtemProger\Specification\Base\ConditionBooleanSpecification;

class Having extends ConditionBooleanSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'having';
    }
}
