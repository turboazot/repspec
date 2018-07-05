<?php

namespace ArtemProger\Repspec\Specification\Base;

abstract class UndefinedArgsCountSpecification extends Specification {

    /**
     * @var $args array
     */
    protected $args;

    /**
     * UndefinedArgsCountSpecification constructor.
     *
     * @param array ...$args
     */
    public function __construct(...$args)
    {
        if (count($args) == 0) {
            throw new \ArgumentCountError(sprintf(
                'Class %s expects 1 or more arguments',
                get_class($this)
            ));
        }
        $this->args = $args;
    }

    /**
     * @return array
     */
    public function getArgs(): array
    {
        return $this->args;
    }

    /**
     * {@inheritdoc}
     */
    public function apply($builder)
    {
        $builder->{$this->getMethodName()}(...$this->args);
    }
}
