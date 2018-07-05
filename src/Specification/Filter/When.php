<?php

namespace ArtemProger\Repspec\Specification\Filter;

use ArtemProger\Repspec\Specification\Base\ChildrenTrait;
use ArtemProger\Repspec\Specification\SpecificationInterface;
use Illuminate\Database\Eloquent\Builder;

class When implements SpecificationInterface {

    use ChildrenTrait;

    /**
     * @var $value mixed
     */
    protected $value;

    /**
     * @var $trueSpecs SpecificationInterface
     */
    protected $trueSpecs;

    /**
     * @var $falseSpecs SpecificationInterface
     */
    protected $falseSpecs;

    /**
     * When constructor.
     *
     * @param $value
     * @param array $trueSpecs
     * @param array $falseSpecs
     */
    public function __construct($value, array $trueSpecs, array $falseSpecs = [])
    {
        $this->value = $value;
        $this->trueSpecs = $trueSpecs;
        $this->falseSpecs = $falseSpecs;
    }

    /**
     * {@inheritdoc}
     */
    public function apply($builder)
    {
        $trueCallback = $this->createCallbackFromSpecs($this->trueSpecs);
        $falseCallback = $this->createCallbackFromSpecs($this->falseSpecs);

        if (count($this->falseSpecs) > 0) {
            $builder->when($this->value, $trueCallback, $falseCallback);
        } else {
            $builder->when($this->value, $trueCallback);

        }

    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return SpecificationInterface
     */
    public function getTrueSpecs(): SpecificationInterface
    {
        return $this->trueSpecs;
    }

    /**
     * @return SpecificationInterface
     */
    public function getFalseSpecs(): SpecificationInterface
    {
        return $this->falseSpecs;
    }

    /**
     * @param $specs array[Specification]
     *
     * @return \Closure
     */
    private function createCallbackFromSpecs(array $specs)
    {
        return function (Builder $builder) use ($specs) {

            array_walk($specs, function (SpecificationInterface $spec) use ($builder) {
                $spec->apply($builder);
            });

            return $builder;   
        };
    }
}
