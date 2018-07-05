<?php

namespace ArtemProger\Repspec\Specification\Filter;

use ArtemProger\Repspec\Specification\Base\ColumnValueBooleanNotSpecification;

class Between extends ColumnValueBooleanNotSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'whereBetween';
    }
}
