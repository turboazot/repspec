<?php

namespace ArtemProger\Specification\Filter;

use ArtemProger\Specification\Base\UndefinedArgsCountSpecification;

class WhereX extends UndefinedArgsCountSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'whereColumn';
    }
}
