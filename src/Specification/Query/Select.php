<?php

namespace ArtemProger\Specification\Query;

use ArtemProger\Specification\Base\UndefinedArgsCountSpecification;

class Select extends UndefinedArgsCountSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'select';
    }
}
