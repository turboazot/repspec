<?php

namespace ArtemProger\Repspec\Specification\Query;

use ArtemProger\Repspec\Specification\SpecificationInterface;

class OrderBy implements SpecificationInterface {

    const ASC = 'asc';
    const DESC = 'desc';

    /**
     * @var $column string
     */
    protected $column;

    /**
     * @var $orderType 
     */
    protected $orderType;

    /**
     * @var $availableTypes array
     */
    protected static $availableTypes = [self::ASC, self::DESC];

    /**
     * OrderBy constructor.
     *
     * @param $column
     * @param string $orderType
     */
    public function __construct($column, $orderType = self::ASC)
    {
        if (!in_array($orderType, self::$availableTypes)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Invalid order type "%s". Class %s accepts only (%s) order types',
                    $orderType,
                    self::class,
                    implode(', ', self::$availableTypes)
                )
            );
        }
        $this->column = $column;
        $this->orderType = $orderType;
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
    public function getOrderType()
    {
        return $this->orderType;
    }

    /**
     * {@inheritdoc}
     */
    public function apply($builder)
    {
        $builder->orderBy($this->column, $this->orderType);
    }
}
