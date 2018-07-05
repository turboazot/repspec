<?php

namespace ArtemProger\Specification\Base;

use ArtemProger\Specification\Base\ChildrenTrait;
use ArtemProger\Specification\SpecificationInterface;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class HaveSpecification implements SpecificationInterface {

    use ChildrenTrait;

    /**
     * @var $relation string
     */
    protected $relation;

    /**
     * @var $operator string
     */
    protected $operator;

    /**
     * @var $count int
     */
    protected $count;

    /**
     * @var $boolean string
     */
    protected $boolean;

    /**
     * @var $children array|null
     */
    protected $children;

    /**
     * HaveSpecification constructor.
     *
     * @param $relation
     * @param string $operator
     * @param int $count
     * @param string $boolean
     * @param array|null $children
     */
    public function __construct(
        $relation, 
        $operator = '>=', 
        $count = 1, 
        $boolean = 'and', 
        array $children = null
    ) {
        $this->relation = $relation;
        $this->operator = $operator;
        $this->count = $count;
        $this->boolean = $boolean;
        $this->children = $children;
    }

    /**
     * @return string
     */
    public function getRelation(): string
    {
        return $this->relation;
    }

    /**
     * @return string
     */
    public function getOperator(): string
    {
        return $this->operator;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @return string
     */
    public function getBoolean(): string
    {
        return $this->boolean;
    }

    /**
     * @return array|null
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * {@inheritdoc}
     */
    public function apply($builder)
    {
        $builder->has(
            $this->relation,
            $this->operator,
            $this->count,
            $this->boolean,
            $this->children
                ? Closure::fromCallable([$this, 'applyChildrenToBuilder'])
                : null
        );
    }
}

