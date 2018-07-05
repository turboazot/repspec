<?php

namespace ArtemProger\Repspec\Specification\Filter;

use ArtemProger\Repspec\Specification\SpecificationInterface;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OnlyTrashed implements SpecificationInterface {

    /**
     * {@inheritdoc}
     */
    public function apply($builder)
    {
        $model = $builder->getModel();

        $builder->withoutGlobalScope(new SoftDeletingScope)->whereNotNull(
            $model->getQualifiedDeletedAtColumn()
        );
    }
}
