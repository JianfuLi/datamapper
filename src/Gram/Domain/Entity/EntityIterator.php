<?php

namespace Gram\Domain\Entity;

/**
 * Class EntityIterator
 *
 * @package Gram\Domain\Traits
 */
class EntityIterator implements \Iterator
{
    private $_d;
    private $_keys;
    private $_key;

    /**
     * @param $data
     */
    public function __construct(&$data)
    {
        $this->_d =& $data;
        $this->_keys = array_keys($data);
        $this->_key = reset($this->_keys);
    }

    /**
     *
     */
    public function rewind()
    {
        $this->_key = reset($this->_keys);
    }

    /**
     * @return mixed
     */
    public function key()
    {
        return $this->_key;
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return $this->_d[$this->_key];
    }

    /**
     *
     */
    public function next()
    {
        $this->_key = next($this->_keys);
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return $this->_key !== false;
    }
}