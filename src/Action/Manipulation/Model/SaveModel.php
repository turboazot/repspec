<?php

namespace ArtemProger\Action\Manipulation\Model;

use ArtemProger\Action\Base\ModelManipulation;

class SaveModel extends ModelManipulation {

    /**
     * @var $options array
     */
    protected $options;

    /**
     * SaveModel constructor.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * {@inheritdoc}
     */
    public function do($model)
    {
        $this->checkModel($model);

        return $model->save($this->options);
    }
}
