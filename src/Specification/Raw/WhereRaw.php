<?php

namespace ArtemProger\Repspec\Specification\Raw;

use ArtemProger\Repspec\Specification\Base\RawBooleanSpecification;

class WhereRaw extends RawBooleanSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'whereRaw';
    }
}
