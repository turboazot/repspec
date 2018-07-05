<?php

namespace ArtemProger\Repspec\Action\Structure;

use ArtemProger\Repspec\Action\Base\PaginateAction;

class Paginate extends PaginateAction {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'paginate';
    }

}
