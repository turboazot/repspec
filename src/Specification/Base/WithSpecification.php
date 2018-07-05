<?php

namespace ArtemProger\Specification\Base;

abstract class WithSpecification extends Specification {

    use ChildrenTrait;

    /**
     * @var $relations string|array['relation' => [SpecificationInterface]...]
     */
    protected $relations;

    /**
     * WithSpecification constructor.
     *
     * @param $relations
     */
    public function __construct($relations)
    {
        $this->relations = $relations;
    }

    /**
     * @return array|string
     */
    public function getRelations()
    {
        return $this->relations;
    }

    /**
     * {@inheritdoc}
     */
    public function apply($builder)
    {
        $relations = $this->relations;

        if (is_array($this->relations)) {
            $this->children = $relations;
            array_walk(
                $relations,
                [$this, 'convertArrayRelationsToWithArgument'] 
            );

            $builder->{$this->getMethodName()}($relations);
        } else {
            $builder->{$this->getMethodName()}($this->relations);
        }
    }

    public function convertArrayRelationsToWithArgument(&$value, $key)
    {
        if (is_array($value)) {
            $value = function ($builder) {
                $this->applyChildrenToBuilder($builder);
            };
        }
    }
    
}
