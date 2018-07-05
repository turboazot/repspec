<?php

namespace ArtemProger\Action\Structure;

use ArtemProger\Action\Base\PaginateAction;

class Paginate extends PaginateAction {

    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'paginate';
    }

}
