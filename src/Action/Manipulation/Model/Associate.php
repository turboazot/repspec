<?php

namespace ArtemProger\Action\Manipulation\Model;

use ArtemProger\Action\Base\ModelManipulation;

class Associate extends ModelManipulation {

    /**
     * @var $relation 
     */
    protected $relation;

    /**
     * @var $childModel 
     */
    protected $childModel;

    /**
     * Associate constructor.
     *
     * @param string $relation
     * @param $childModel
     */
    public function __construct(string $relation, $childModel)
    {
        $this->relation = $relation;
        $this->childModel = $childModel;
    }

    /**
     * @return mixed
     */
    public function getRelation()
    {
        return $this->relation;
    }

    /**
     * @return mixed
     */
    public function getChildModel()
    {
        return $this->childModel;
    }

    /**
     * {@inheritdoc}
     */
    public function do($parentModel)
    {
        $this->checkModel($parentModel);

        return $parentModel->{$this->relation}()->associate($this->childModel);
    }
}
