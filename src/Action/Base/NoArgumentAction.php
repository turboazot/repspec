<?php

namespace ArtemProger\Repspec\Action\Base;

use App\Traits\Rememberable\Query\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class NoArgumentAction extends Action {

    /**
     * @var $builderOrModel Model|Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder|Model
     */
    public function do($builderOrModel)
    {
        return $builderOrModel->{$this->getMethodName()}();
    }
}
