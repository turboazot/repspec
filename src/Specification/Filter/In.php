<?php

namespace ArtemProger\Repspec\Specification\Filter;

use ArtemProger\Repspec\Specification\Base\ColumnValueBooleanNotSpecification;

class In extends ColumnValueBooleanNotSpecification {

    /**
     * @return string
     */
    public function getMethodName()
    {
        return 'whereIn';
    }
}
