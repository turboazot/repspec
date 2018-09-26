<?php

namespace ArtemProger\Repspec\Action\Logic;

use ArtemProger\Repspec\Action\Base\ActionInterface;
use ArtemProger\Repspec\Action\Base\ModelManipulation;
use ArtemProger\Repspec\Action\Lock\Lock;

class AndX extends ModelManipulation {

    /**
     * @var $actions 
     */
    protected $actions;

    /**
     * AndX constructor.
     *
     * @param array ...$actions
     */
    public function __construct(...$actions)
    {
        if (count($actions) > 2 || count($actions) == 0) {
            throw new \ArgumentCountError(
                sprintf(
                    '%s action accepts only 1 or 2 actions',
                    self::class
                )
            );
        }

        if (count($actions) == 2 && (!$actions[0] instanceof Lock || $actions[1] instanceof Lock)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'When 2 actions are specified, then %s action must contain first action as %s class and second - all exclude %s',
                    self::class,
                    Lock::class,
                    Lock::class
                )
            );
        }

        $this->actions = $actions;
    }

    /**
     * @return mixed
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * {@inheritdoc}
     */
    public function do($builder)
    {
        if (count($this->actions) == 2) {
            $lockAction = $this->actions[0];
            $anotherAction = $this->actions[1];

            $lockAction->do($builder);
        } else {
            $anotherAction = $this->actions[0];
        }
        return $anotherAction->do($builder);
    }

    /**
     * @param ActionInterface $action
     */
    public function addAction(ActionInterface $action)
    {
        $this->actions []= $action;
    }
}
