<?php

namespace ArtemProger\Specification\Query;

use ArtemProger\Specification\Base\ValueSpecification;

class Limit extends ValueSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'limit';
    }
}
