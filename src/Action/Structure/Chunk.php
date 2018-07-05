<?php

namespace ArtemProger\Repspec\Action\Structure;

use ArtemProger\Repspec\Action\Base\ActionInterface;
use Illuminate\Database\Eloquent\Builder;

class Chunk implements ActionInterface {

    /**
     * @var $count string
     */
    protected $count;

    /**
     * @var $hanlder callable
     */
    protected $handler;

    /**
     * Chunk constructor.
     *
     * @param string $count
     * @param callable $handler
     */
    public function __construct(string $count, callable $handler)
    {
        $this->count = $count;
        $this->handler = $handler;
    }

    /**
     * @return string
     */
    public function getCount(): string
    {
        return $this->count;
    }

    /**
     * @return callable
     */
    public function getHandler(): callable
    {
        return $this->handler;
    }

    /**
     * {@inheritdoc}
     */
    public function do($builder)
    {
        return $builder->chunk($this->count, $this->handler);
    }
}
