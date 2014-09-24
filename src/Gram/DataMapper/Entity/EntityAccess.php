<?php

namespace Gram\DataMapper\Entity;

use Gram\DataMapper\Type;

/**
 * Class EntityAccess
 *
 * @package Gram\DataMapper\Entity
 */
abstract class EntityAccess extends EntityMapping
{
    private $_ps;

    /**
     * @param $name
     *
     * @return null
     * @throws \Exception
     */
    function __get($name)
    {
        $md = static::getMetadata();
        if (!isset($md->properties[$name])) {
            throw new \Exception("试图访问未定义的属性“$name”");
        }

        $methodName = 'get' . ucfirst($name);
        if (method_exists($this, $methodName)) {
            return $this->$methodName();
        }
        return self::_saveGet($this->_ps, $name);
    }

    /**
     * @param $name
     * @param $value
     *
     * @return mixed
     * @throws \Exception
     */
    function __set($name, $value)
    {
        $md = static::getMetadata();
        if (!isset($md->properties[$name])) {
            throw new \Exception("试图访问未定义的属性“$name”");
        }

        $m = $md->properties[$name];
        if (is_null($m->type)) {
            throw new \Exception("未定义属性“$name”的类型");
        }

        $castValue = Type::convert($value, $m->type);
        foreach ($m->validators as $v) {
            $v->validate($castValue);
        }

        $methodName = 'set' . ucfirst($name);
        if (method_exists($this, $methodName)) {
            return $this->$methodName($castValue);
        } else {
            $this->_ps[$name] = $castValue;
        }
    }

    private static function _saveGet(array $arr, $index, $default = null)
    {
        return isset($arr[$index]) ? $arr[$index] : $default;
    }
} 