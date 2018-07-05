<?php

namespace ArtemProger\Repspec\Specification\Query;

use ArtemProger\Repspec\Specification\Base\ValueSpecification;

class Offset extends ValueSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'offset';
    }
}
