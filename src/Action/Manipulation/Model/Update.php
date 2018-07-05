<?php

namespace ArtemProger\Action\Manipulation\Model;

use ArtemProger\Action\Base\ModelManipulation;

class Update extends ModelManipulation {

    /**
     * @var $attributes array
     */
    protected $attributes;

    /**
     * @var $options array
     */
    protected $options;

    /**
     * Update constructor.
     * @param array $attributes
     * @param array $options
     */
    public function __construct(array $attributes = [], array $options = [])
    {
        $this->attributes = $attributes;
        $this->options = $options;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
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

        return $model->update($this->attributes, $this->options);
    }
}
