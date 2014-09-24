<?php

namespace Gram\DataMapper\Mapping;

/**
 * Class Property
 *
 * @package Gram\DataMapper\Mapping
 */
class Property
{
    /**
     * 属性名称
     * @var string
     */
    public $name;
    /**
     * 属性类型
     * @var string
     */
    public $type;

    /**
     * @var bool
     */
    public $required = false;

    /**
     * @var bool
     */
    public $pk = false;

    /**
     * @var string
     */
    public $column = '';
    /**
     * 属性验证器
     * @var array
     */
    public $validators;

    /**
     *
     * @param string $name
     * @param string $type
     * @param bool   $required
     * @param array  $validators
     */
    function __construct($name, $type = null, $required = false, $validators = array())
    {
        $this->name = $name;
        $this->column = $name;
        $this->type = $type;
        $this->required = $required;
        $this->validators = $validators;
    }
}