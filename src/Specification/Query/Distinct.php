<?php

namespace ArtemProger\Repspec\Specification\Query;

use ArtemProger\Repspec\Specification\Base\NoArgumentSpecification;

class Distinct extends NoArgumentSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'distinct';
    }
}
