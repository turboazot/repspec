<?php

namespace ArtemProger\Repspec\Action\Base;

abstract class XCrementAction extends Action {
    
    /**
     * @var $column string
     */
    protected $column;

    /**
     * @var $amount mixed
     */
    protected $amount;

    /**
     * @var $extra []
     */
    protected $extra;

    /**
     * XCrementAction constructor.
     *
     * @param $column
     * @param int $amount
     * @param array $extra
     */
    public function __construct($column, $amount = 1, array $extra = [])
    {
        $this->column = $column;
        $this->amount = $amount;
        $this->extra = $extra;
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
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return mixed
     */
    public function getExtra()
    {
        return $this->extra;
    }

    public function do($builder)
    {
        return $builder->{$this->getMethodName()}(
            $this->column,
            $this->amount,
            $this->extra
        );
    }
}
