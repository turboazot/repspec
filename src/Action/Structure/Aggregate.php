<?php

namespace ArtemProger\Action\Structure;

use ArtemProger\Action\Base\ActionInterface;

class Aggregate implements ActionInterface {

    const COUNT = 'count';
    const MAX = 'max';
    const MIN = 'min';
    const AVG = 'avg';
    const SUM = 'sum';

    /**
     * @var $function string
     */
    protected $function;

    /**
     * @var $columns array
     */
    protected $columns;

    /**
     * @var $availableFunctions array
     */
    protected static $availableFunctions = [
        self::COUNT, self::AVG, self::SUM,
        self::MIN, self::MAX
    ];

    /**
     * Aggregate constructor.
     *
     * @param $function
     * @param array $columns
     */
    public function __construct($function, $columns = ['*'])
    {
        if (!in_array($function, self::$availableFunctions)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Function "%s" is not available. Available - %s',
                    $function,
                    implode (', ', self::$availableFunctions)
                )
            );
        }
        $this->function = $function;
        $this->columns = $columns;
    }

    /**
     * @return string
     */
    public function getFunction(): string
    {
        return $this->function;
    }

    /**
     * @return array
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * @return array
     */
    public static function getAvailbleFunctions(): array
    {
        return self::$availableFunctions;
    }

    /**
     * {@inheritdoc}
     */
    public function do($builder)
    {
        return $builder->{$this->function}($this->columns);
    }
}
