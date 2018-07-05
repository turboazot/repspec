<?php

namespace ArtemProger\Repspec\Action;

use ArtemProger\Repspec\Action\Logic\AndX;

trait LogicMethodTrait
{
    /**
     * @param array ...$actions
     *
     * @return AndX
     */
    public static function andX(...$actions)
    {
        return new AndX(...$actions);
    }
}