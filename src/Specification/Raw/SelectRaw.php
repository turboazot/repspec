<?php

namespace ArtemProger\Repspec\Specification\Raw;

use ArtemProger\Repspec\Specification\Base\RawSpecification;

class SelectRaw extends RawSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'selectRaw';
    }
}
