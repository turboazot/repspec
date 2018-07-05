<?php

namespace ArtemProger\Repspec\Specification\Logic;

use ArtemProger\Repspec\Specification\Base\ChildrenTrait;
use ArtemProger\Repspec\Specification\SpecificationInterface;
use Illuminate\Database\Eloquent\Builder;

class AndX implements SpecificationInterface {

    use ChildrenTrait;

    /**
     * AndX constructor.
     *
     * @param array ...$specs
     */
    public function __construct(...$specs)
    {
        if (count($specs) == 0) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Class %s accept one or more specifications in parameters', 
                    self::class
                )
            );
        }
          
        $this->setChildren($specs);
    }

    /**
     * {@inheritdoc}
     */
    public function apply($builder)
    {
        $this->applyChildrenToBuilder($builder);
    }
}
