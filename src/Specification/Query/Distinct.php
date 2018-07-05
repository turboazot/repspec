<?php

namespace ArtemProger\Specification\Query;

use ArtemProger\Specification\Base\NoArgumentSpecification;

class Distinct extends NoArgumentSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'distinct';
    }
}
