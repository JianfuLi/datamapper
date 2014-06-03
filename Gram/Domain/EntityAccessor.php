<?php

namespace Gram\Domain;


trait EntityAccessor
{
    use EntityMapping;

    function __get($name)
    {
        $md = static::getMetadata();
        if (!isset($md[$name])) {
            throw new \Exception("试图访问未定义的属性“$name”");
        }
        if (!$md->readable) {
            throw new \Exception("试图对只写属性“$name”进行读取操作");
        }
        $methodName = 'get' . ucfirst($name);
        if (method_exists($this, $methodName)) {
            return $this->$methodName();
        }
        return self::_saveGet($this->_ps, $name);
    }

    function __set($name, $value)
    {
        $md = static::getMetadata();
        if (!isset($md[$name])) {
            throw new \Exception("试图访问未定义的属性“$name”");
        }
        if (is_null($md->type)) {
            throw new \Exception("未设置属性“$name”的类型");
        }
        if (!$md->writable) {
            throw new \Exception("试图对只读属性“$name”进行写入操作");
        }

        $castValue = Type::convert($value, $md->type);
        foreach ($md->validators as $v) {
            $v->validate($castValue);
        }

        $methodName = 'set' . ucfirst($name);
        if (method_exists($this, $methodName)) {
            return $this->$methodName($castValue);
        } else {
            $this->_properties[$name] = $castValue;
        }
    }

    private static function _saveGet(array $arr, $index, $default = null)
    {
        return isset($arr[$index]) ? $arr[$index] : $default;
    }
} 