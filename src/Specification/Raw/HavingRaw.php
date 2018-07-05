<?php

namespace ArtemProger\Specification\Raw;

use ArtemProger\Specification\Base\RawBooleanSpecification;

class HavingRaw extends RawBooleanSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'havingRaw';
    }
}
