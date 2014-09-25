<?php
namespace Gram\DataMapper;

use Gram\DataMapper\Entity\Query;
use Gram\DataMapper\Entity\EntityIterator;

/**
 * Class EntityBase
 *
 * @package Gram\DataMapper
 */
abstract class EntityBase extends Query implements \IteratorAggregate, \ArrayAccess
{
    /**
     * @var \ReflectionClass
     */
    protected static $rc = null;

    /**
     * @return \ReflectionClass
     */
    protected function getReflector()
    {
        if (is_null(static::$rc)) {
            static::$rc = new \ReflectionClass($this);
        }
        return static::$rc;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Retrieve an external iterator
     *
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     *       <b>Traversable</b>
     */
    public function getIterator()
    {
        $md = static::getMetadata();
        $properties = array();
        foreach ($md->properties as $name => $md) {
            $properties[$name] = $this->{$name};
        }

        $reflector = $this->getReflector();
        $ps = $reflector->getProperties(\ReflectionProperty::IS_PUBLIC);
        foreach ($ps as $p) {
            $properties[$p->getName()] = $this->{$p->getName()};
        }
        return new EntityIterator($properties);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Whether a offset exists
     *
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param mixed $offset <p>
     *                      An offset to check for.
     *                      </p>
     *
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     */
    function offsetExists($offset)
    {
        return property_exists($this, $offset);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to retrieve
     *
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param mixed $offset <p>
     *                      The offset to retrieve.
     *                      </p>
     *
     * @return mixed Can return all value types.
     */
    function offsetGet($offset)
    {
        return $this->$offset;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to set
     *
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param mixed $offset <p>
     *                      The offset to assign the value to.
     *                      </p>
     * @param mixed $value  <p>
     *                      The value to set.
     *                      </p>
     *
     * @return void
     */
    function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to unset
     *
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param mixed $offset <p>
     *                      The offset to unset.
     *                      </p>
     *
     * @return void
     */
    function offsetUnset($offset)
    {
        unset($this->$offset);
    }
}