<?php

namespace ArtemProger\Specification;

use Illuminate\Database\Eloquent\Builder;

interface SpecificationInterface {

    /**
     * Call specification method on builder
     *
     * @param $builder Builder
     *
     * @return mixed
     */
    public function apply($builder);
}
