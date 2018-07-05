<?php

namespace ArtemProger\Specification\Filter;

use ArtemProger\Specification\Base\ColumnValueBooleanNotSpecification;

class Between extends ColumnValueBooleanNotSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'whereBetween';
    }
}
