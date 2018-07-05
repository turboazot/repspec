<?php

namespace ArtemProger\Action\Structure;

use ArtemProger\Action\Base\PaginateAction;

class SimplePaginate extends PaginateAction {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'simplePaginate';
    }
}
