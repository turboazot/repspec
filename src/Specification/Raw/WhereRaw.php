<?php

namespace ArtemProger\Specification\Raw;

use ArtemProger\Specification\Base\RawBooleanSpecification;

class WhereRaw extends RawBooleanSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'whereRaw';
    }
}
