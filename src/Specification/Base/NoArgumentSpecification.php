<?php

namespace ArtemProger\Repspec\Specification\Base;

use ArtemProger\Repspec\Specification\Base\Specification;
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
