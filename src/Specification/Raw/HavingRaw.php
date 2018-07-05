<?php

namespace ArtemProger\Repspec\Specification\Raw;

use ArtemProger\Repspec\Specification\Base\RawBooleanSpecification;

class HavingRaw extends RawBooleanSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'havingRaw';
    }
}
