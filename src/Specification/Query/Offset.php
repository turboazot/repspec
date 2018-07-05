<?php

namespace ArtemProger\Specification\Query;

use ArtemProger\Specification\Base\ValueSpecification;

class Offset extends ValueSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'offset';
    }
}
