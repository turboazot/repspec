<?php

namespace ArtemProger\Specification\Base;

abstract class RawBooleanSpecification extends Specification {

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
     * RawBooleanSpecification constructor.
     *
     * @param string $expression
     * @param array $parameters
     * @param string $boolean
     */
    public function __construct(string $expression, array $parameters = [], $boolean = 'and')
    {
        $this->expression = $expression;
        $this->parameters = $parameters;
        $this->boolean = $boolean;
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
        $builder->{$this->getMethodName()}(
            $this->expression,
            $this->parameters,
            $this->boolean
        );
    }
}

