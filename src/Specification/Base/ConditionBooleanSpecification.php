<?php

namespace ArtemProger\Repspec\Specification\Base;

use ArtemProger\Repspec\Specification\Base\Specification;
use Illuminate\Database\Eloquent\Builder;

abstract class ConditionBooleanSpecification extends Specification {

    const EQ = '=';
    const NEQ = '<>';
    const GT = '>';
    const GTE = '>=';
    const LT = '<';
    const LTE = '<=';
    const LIKE = 'like';

    /**
     * @var $operator string
     */
    protected $operator;

    /**
     * @var $column string
     */
    protected $column;

    /**
     * @var $value mixed
     */
    protected $value;

    /**
     * @var $boolean bool
     */
    protected $boolean;

    /**
     * @var $likeable bool
     */
    protected $likeable = false;

    /**
     * @var $optionalOperator bool
     */
    protected $optionalOperator = false;

    /**
     * @var $availableOperators 
     */
    protected static $availableOperators = [
        self::EQ, self::NEQ,
        self::GT, self::GTE,
        self::LT, self::LTE
    ];

    /**
     * ConditionBooleanSpecification constructor.
     *
     * @param $column
     * @param null $operator
     * @param null $value
     * @param string $boolean
     */
    public function __construct($column, $operator = null, $value = null, $boolean = 'and')
    {
        if (!$this->optionalOperator && is_null($operator)) {
            throw new \ArgumentCountError(
                sprintf(
                    'Class %s expects at least 2 arguments in constructor',
                    self::class
                )
            );
        }

        $availableOperators = $this->likeable
            ? array_merge(self::$availableOperators, [self::LIKE])
            : self::$availableOperators;
         
        if (!is_null($operator) && !in_array($operator, $availableOperators)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Operator "%s" is invalid, available operators are %s',
                    $operator, 
                    implode(', ', $availableOperators)
                )
            );
        }

        $this->column = $column;
        $this->operator = $operator;
        $this->value = $value;
        $this->boolean = $boolean;
    }

    /**
     * @return string
     */
    public function getOperator(): string
    {
        return $this->operator;
    }

    /**
     * @return string
     */
    public function getColumn(): string
    {
        return $this->column;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return bool
     */
    public function isBoolean(): bool
    {
        return $this->boolean;
    }

    /**
     * @return bool
     */
    public function isLikeable(): bool
    {
        return $this->likeable;
    }

    /**
     * @return bool
     */
    public function isOptionalOperator(): bool
    {
        return $this->optionalOperator;
    }

    /**
     * {@inheritdoc}
     */
    public function apply($builder)
    {
        $builder->{$this->getMethodName()}(
            $this->column, 
            $this->operator, 
            $this->value,
            $this->boolean
        );
    }
}

