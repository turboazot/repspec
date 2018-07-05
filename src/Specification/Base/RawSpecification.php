<?php

namespace ArtemProger\Specification\Base;

use ArtemProger\Specification\Base\Specification;

abstract class RawSpecification extends Specification {

    /**
     * @var $expression string
     */
    protected $expression;

    /**
     * @var $parameters array
     */
    protected $parameters;

    /**
     * @var $boolean string
     */
    protected $boolean;

    /**
     * RawSpecification constructor.
     *
     * @param string $expression
     * @param array $parameters
     */
    public function __construct(string $expression, array $parameters = [])
    {
        $this->expression = $expression;
        $this->parameters = $parameters;
    }

    /**
     * @return string
     */
    public function getExpression(): string
    {
        return $this->expression;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @return string
     */
    public function getBoolean(): string
    {
        return $this->boolean;
    }

    /**
     * {@inheritdoc}
     */
    public function apply($builder)
    {
        $builder->{$this->getMethodName()}($this->expression, $this->parameters);
    }
}
