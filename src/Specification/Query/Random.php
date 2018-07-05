<?php

namespace ArtemProger\Specification\Query;

use ArtemProger\Specification\Base\NoArgumentSpecification;

class Random extends NoArgumentSpecification {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'inRandomOrder';
    }
}
