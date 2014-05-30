<?php
namespace Gram\Domain;

use Gram\Domain\Metadata\Mapper;
use Gram\Domain\Metadata\Property;
use Gram\Domain\Metadata\MapIterator;

abstract class Base implements \IteratorAggregate, \ArrayAccess
{
    /**
     * 布尔值类型
     * @var string
     */
    const TYPE_BOOLEAN = 'boolean';

    /**
     * 整型类型
     * @var string
     */
    const TYPE_INTEGER = 'integer';

    /**
     * 双精度类型，由于历史原因，如果是 float 则返回“double”，而不是“float”
     *
     * @var string
     */
    const TYPE_DOUBLE = 'double';

    /**
     * 字符串类型
     * @var string
     */
    const TYPE_STRING = 'string';

    /**
     * 数组类型
     * @var string
     */
    const TYPE_ARRAY = 'array';

    /**
     * 对象元数据
     * @var array
     */
    private static $_md = null;

    /**
     * 对象反射类
     * @var \ReflectionClass
     */
    private static $_r = null;

    /**
     * 对象属性
     * @var array
     */
    private $_ps;

    private $_mc;

    abstract protected function initMappers();

    private function _ensureMetadata()
    {
        if (!is_null(self::$_md)) {
            return;
        }

        $this->initMappers();
        self::$_md = $this->_mc;
    }

    private function _getReflector()
    {
        if (is_null(self::$_r)) {
            self::$_r = new \ReflectionClass($this);
        }

        return self::$_r;
    }

    protected function map($property)
    {
        return new Mapper($property, $this);
    }

    function __mergePropertyMetadata(Property $property)
    {
        $this->_mc[$property->name] = $property;
    }

    function __get($name)
    {
        $this->_ensureMetadata();

        if (!isset(self::$_md[$name])) {
            throw new \Exception("试图访问未定义的属性“$name”");
        }
        $md = self::$_md[$name];
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
        $this->_ensureMetadata();

        if (!isset(self::$_md[$name])) {
            throw new \Exception("试图访问未定义的属性“$name”");
        }
        $md = self::$_md[$name];
        if (is_null($md->type)) {
            throw new \Exception("未设置属性“$name”的类型");
        }
        if (!$md->writable) {
            throw new \Exception("试图对只读属性“$name”进行写入操作");
        }
        $castValue = self::_castValue($value, $md->type);
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

    function getIterator()
    {
        $this->_ensureMetadata();

        $properties = array();
        foreach (self::$_md as $name => $md) {
            $properties[$name] = $this->{$name};
        }

        $reflector = $this->_getReflector();
        $ps = $reflector->getProperties(\ReflectionProperty::IS_PUBLIC);
        foreach ($ps as $p) {
            $properties[$p->getName()] = $this->{$p->getName()};
        }
        return new MapIterator($properties);
    }

    function offsetExists($offset)
    {
        return property_exists($this, $offset);
    }

    function offsetGet($offset)
    {
        return $this->$offset;
    }

    function offsetSet($offset, $item)
    {
        $this->$offset = $item;
    }

    function offsetUnset($offset)
    {
        unset($this->$offset);
    }

    private static function _saveGet(array $arr, $index, $default = null)
    {
        return isset($arr[$index]) ? $arr[$index] : $default;
    }

    private static function _castValue($value, $type)
    {
        $valueType = gettype($value);
        if ($valueType === 'object') {
            if (!($value instanceof $type)) {
                throw new \Exception('类型错误');
            }
        } elseif ($valueType !== $type) {
            settype($value, $type);
        }
        return $value;
    }
} 