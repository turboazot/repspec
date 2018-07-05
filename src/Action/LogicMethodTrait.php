<?php

namespace ArtemProger\Action;

use ArtemProger\Action\Logic\AndX;

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