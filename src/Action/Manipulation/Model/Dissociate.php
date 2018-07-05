<?php

namespace ArtemProger\Repspec\Action\Manipulation\Model;

use ArtemProger\Repspec\Action\Base\ModelManipulation;;

class Dissociate extends ModelManipulation {

    /**
     * @var $relation 
     */
    protected $relation;

    /**
     * Dissociate constructor.
     *
     * @param $relation
     */
    public function __construct($relation)
    {
        $this->relation = $relation;
    }

    /**
     * @return mixed
     */
    public function getRelation()
    {
        return $this->relation;
    }

    /**
     * {@inheritdoc}
     */
    public function do($parentModel)
    {
        $this->checkModel($parentModel);

        $parentModel->{$this->relation}()->dissociate();
        return $parentModel->save();
    }
}
