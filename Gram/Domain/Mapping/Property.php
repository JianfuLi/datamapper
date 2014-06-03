<?php

namespace Gram\Domain\Mapping;

/**
 * Class Property
 *
 * @package Gram\Domain\Mapping
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
     * 属性验证器
     * @var array
     */
    public $validators;

    /**
     *
     * @param string $name
     * @param string $type
     * @param array  $validators
     */
    function __construct($name, $type = null, $validators = array())
    {
        $this->name = $name;
        $this->type = $type;
        $this->validators = $validators;
    }
}