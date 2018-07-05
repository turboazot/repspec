<?php

namespace ArtemProger\Specification\Base;

use ArtemProger\Specification\Base\Specification;
use Illuminate\Database\Eloquent\Builder;

abstract class NoArgumentSpecification extends Specification {

    /**
     * {@inheritdoc}
     */
    public function apply($builder)
    {
        $builder->{$this->getMethodName()}();
    }
}
