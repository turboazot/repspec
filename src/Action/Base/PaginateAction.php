<?php

namespace ArtemProger\Action\Base;

use ArtemProger\Action\Base\Action;
use Illuminate\Database\Eloquent\Builder;

abstract class PaginateAction extends Action {

    /**
     * @var $perPage 
     */
    protected $perPage;

    /**
     * @var $columns 
     */
    protected $columns;

    /**
     * @var $pageName 
     */
    protected $pageName;

    /**
     * @var $page 
     */
    protected $page;

    /**
     * PaginateAction constructor.
     *
     * @param null $perPage
     * @param array $columns
     * @param string $pageName
     * @param null $page
     */
    public function __construct($perPage = null, $columns = ['*'], $pageName = 'page', $page = null)
    {
        $this->perPage = $perPage;
        $this->columns = $columns;
        $this->pageName = $pageName;
        $this->page = $page;
    }

    /**
     * @return mixed
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * @return mixed
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @return mixed
     */
    public function getPageName()
    {
        return $this->pageName;
    }

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * {@inheritdoc}
     */
    public function do($builder)
    {
        return $builder->{$this->getMethodName()}(
            $this->perPage,
            $this->columns,
            $this->pageName,
            $this->page
        );
    }
    
}
