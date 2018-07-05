<?php

namespace ArtemProger\Repspec\Specification\Query;

use ArtemProger\Repspec\Specification\Base\UndefinedArgsCountSpecification;

class Select extends UndefinedArgsCountSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'select';
    }
}
