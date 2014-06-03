<?php

namespace Gram\Domain\Mapping;

/**
 * Class PropertyMapping
 *
 * @package Gram\Domain\Mapping
 */
class PropertyMapping
{
    /**
     * @var Property
     */
    protected $property;

    /**
     * @param Property $property
     */
    function __construct(Property &$property)
    {
        $this->property = $property;
    }


    /**
     * @param IValidator $v
     *
     * @return PropertyMapping
     */
    function validator(IValidator $v)
    {
        $this->property->validators[] = $v;
        return $this;
    }

    /**
     * @param $type
     *
     * @return PropertyMapping
     */
    function type($type)
    {
        $this->property->type = $type;
        return $this;
    }

    /**
     * @return $this
     */
    function required()
    {
        $this->property->required = true;
        return $this;
    }
} 