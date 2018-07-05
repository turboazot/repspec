<?php

namespace ArtemProger\Repspec\Action\Base;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface ActionInterface {

    /**
     * Applies action to builder or model
     *
     * @param $builder
     * @return Builder|Model
     */
    public function do($builder);
}
