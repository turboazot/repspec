<?php

namespace ArtemProger\Specification\Raw;

use ArtemProger\Specification\Base\RawSpecification;

class SelectRaw extends RawSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'selectRaw';
    }
}
