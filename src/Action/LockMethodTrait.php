<?php

namespace ArtemProger\Repspec\Action;

use ArtemProger\Repspec\Action\Lock\Lock;

trait LockMethodTrait {

    /**
     * @return Lock
     */
    public static function lockForUpdate()
    {
        return new Lock(true);
    }

    /**
     * @return Lock
     */
    public static function sharedLock()
    {
        return new Lock(false);
    }
}
