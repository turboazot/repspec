<?php

namespace ArtemProger\Specification\Base;

use ArtemProger\Specification\SpecificationInterface;

trait ChildrenTrait {

    /**
     * @var $children [Specification]
     */
    protected $children;

    /**
     * @param array $children
     *
     * @return $this
     */
    public function setChildren(array $children)
    {
        $this->children = $children;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param $builder
     */
    public function applyChildrenToBuilder($builder)
    {
        array_walk($this->children, function ($data) use ($builder) {
            if (is_array($data)) {
                array_walk($data, function (SpecificationInterface $spec) use ($builder) {
                    $spec->apply($builder); 
                });
            } else {
                /**
                 * @var $data SpecificationInterface 
                 */
                $data->apply($builder);
            }
        });
    }
}
