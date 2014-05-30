<?php

namespace Gram\Domain\Metadata;


class MapIterator implements \Iterator
{
    private $_d;

    private $_keys;

    private $_key;

    public function __construct(&$data)
    {
        $this->_d =& $data;
        $this->_keys = array_keys($data);
        $this->_key = reset($this->_keys);
    }

    public function rewind()
    {
        $this->_key = reset($this->_keys);
    }

    public function key()
    {
        return $this->_key;
    }

    public function current()
    {
        return $this->_d[$this->_key];
    }

    public function next()
    {
        $this->_key = next($this->_keys);
    }

    public function valid()
    {
        return $this->_key !== false;
    }
}