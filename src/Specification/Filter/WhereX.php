<?php

namespace ArtemProger\Repspec\Specification\Filter;

use ArtemProger\Repspec\Specification\Base\UndefinedArgsCountSpecification;

class WhereX extends UndefinedArgsCountSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'whereColumn';
    }
}
