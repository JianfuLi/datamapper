<?php

namespace Gram\DataMapper\Entity;

use Gram\DataMapper\Type;
use Gram\DataMapper\Exception\TypeException;
use Gram\DataMapper\Exception\PropertyException;

/**
 * Class EntityAccess
 *
 * 对象属性访问基类
 *
 * @package Gram\DataMapper\Entity
 */
abstract class EntityAccess extends EntityMapping
{
    protected $ps = array();

    /**
     * @param $name
     *
     * @return null
     * @throws PropertyException
     * @throws TypeException
     */
    function __get($name)
    {
        $md = static::getMetadata();
        if (!isset($md->properties[$name])) {
            throw new PropertyException('试图访问未定义的属性' . $name);
        }

        $methodName = 'get' . ucfirst($name);
        if (method_exists($this, $methodName)) {
            return $this->$methodName();
        }

        $m = $md->properties[$name];
        if (is_null($m->type)) {
            throw new TypeException('未定义属性' . $name . '的类型');
        }
        $value = self::saveGet($this->ps, $name);
        return Type::convert($value, $m->type);
    }

    /**
     * @param $name
     * @param $value
     *
     * @throws PropertyException
     * @throws TypeException
     */
    function __set($name, $value)
    {
        $md = static::getMetadata();
        if (!isset($md->properties[$name])) {
            throw new PropertyException('试图访问未定义的属性' . $name);
        }

        $m = $md->properties[$name];
        if (is_null($m->type)) {
            throw new TypeException('未定义属性' . $name . '的类型');
        }

        $castValue = Type::convert($value, $m->type);
        foreach ($m->validators as $v) {
            $v->validate($castValue);
        }

        $methodName = 'set' . ucfirst($name);
        if (method_exists($this, $methodName)) {
            return $this->$methodName($castValue);
        } else {
            $this->ps[$name] = $castValue;
        }
    }

    protected static function saveGet(array $arr, $index, $default = null)
    {
        return isset($arr[$index]) ? $arr[$index] : $default;
    }
} 