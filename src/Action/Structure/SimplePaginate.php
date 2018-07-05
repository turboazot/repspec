<?php

namespace ArtemProger\Repspec\Action\Structure;

use ArtemProger\Repspec\Action\Base\PaginateAction;

class SimplePaginate extends PaginateAction {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'simplePaginate';
    }
}
