<?php

namespace ArtemProger\Specification\Filter;

use ArtemProger\Specification\Base\ChildrenTrait;
use ArtemProger\Specification\Query\From;
use ArtemProger\Specification\Query\Select;
use ArtemProger\Specification\SpecificationInterface;
use Illuminate\Database\Query\Builder;

class ExistsX implements SpecificationInterface {

    use ChildrenTrait;

    const ERROR_ARGUMENTS_COUNT = 1;
    const ERROR_SELECT_FROM = 2;

    /**
     * @var $boolean string
     */
    protected $boolean;

    /**
     * @var $not bool
     */
    protected $not;

    /**
     * ExistsX constructor.
     *
     * @param array $specs
     * @param string $boolean
     * @param bool $not
     */
    public function __construct(array $specs, $boolean = 'and', $not = false)
    {
        switch ($this->validateChildren($specs)) {
            case self::ERROR_ARGUMENTS_COUNT:
                throw new \ArgumentCountError(
                    sprintf('Class %s must contain at least 2 specifications', self::class)
                );
            case self::ERROR_SELECT_FROM:
                throw new \InvalidArgumentException(
                    sprintf('Class %s always must contain Select and From specifications', self::class)
                );
            default:
                break;
        }

        $this->children = $specs;
        $this->boolean = $boolean;
        $this->not = $not;
    }

    /**
     * @return string
     */
    public function getBoolean(): string
    {
        return $this->boolean;
    }

    /**
     * @return bool
     */
    public function isNot(): bool
    {
        return $this->not;
    }

    /**
     * @param array $specs
     *
     * @return int
     */
    private function validateChildren(array $specs)
    {
        if (count($specs) < 2) {
            return self::ERROR_ARGUMENTS_COUNT;
        }

        $selectSpecs = array_filter($specs, function (SpecificationInterface $spec) {
            return $spec instanceof Select;
        });

        if (count($selectSpecs) == 0) {
            return self::ERROR_SELECT_FROM;
        }

        $fromSpecs = array_filter($specs, function (SpecificationInterface $spec) {
            return $spec instanceof From;   
        });

        if (count($fromSpecs) == 0) {
            return self::ERROR_SELECT_FROM;
        }

        return 0;
    }

    /**
     * {@inheritdoc}
     */
    public function apply($builder)
    {
        $builder->whereExists(function (Builder $builder) {
            $this->applyChildrenToBuilder($builder);
        }, $this->boolean, $this->not);
    }
}
