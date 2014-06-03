<?php

namespace Gram\Domain\Mapping;


use Gram\Domain\IValidator;

class Property implements IProperty
{
    protected $name;
    protected $type;
    protected $validators;

    function __construct($name, $type = null, $validators = array())
    {
        $this->name = $name;
        $this->type = $type;
        $this->validators = $validators;
    }

    function getName()
    {
        return $this->name;
    }

    function getType()
    {
        return $this->type;
    }

    function getValidators()
    {
        return $this->validators;
    }

    /**
     * @param IValidator $v
     *
     * @return IProperty
     */
    function validator(IValidator $v)
    {
        $this->validators[] = $v;
        return $this;
    }

    /**
     * @param $type
     *
     * @return IProperty
     */
    function type($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param $name
     *
     * @return IProperty
     */
    static function name($name)
    {
        return new Property($name);
    }
}