<?php

namespace ArtemProger\Specification\Filter;

use ArtemProger\Specification\Base\ColumnValueBooleanNotSpecification;

class In extends ColumnValueBooleanNotSpecification {

    /**
     * @return string
     */
    public function getMethodName()
    {
        return 'whereIn';
    }
}
