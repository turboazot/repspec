<?php

namespace ArtemProger\Repspec\Specification\Query;

use ArtemProger\Repspec\Specification\Base\ValueSpecification;

class Limit extends ValueSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'limit';
    }
}
