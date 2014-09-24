<?php

namespace Gram\Domain\Mapping;


use Gram\Domain\IShardStrategy;

class Metadata
{
    /**
     * @var IShardStrategy
     */
    public $shardStrategy;

    /**
     * @var array<Property>
     */
    public $properties;

    /**
     * @var Property
     */
    public $primaryKey;

    /**
     * @var Cache
     */
    public $cache;


    /**
     * @param $name
     *
     * @return Property
     */
    function getProperty($name)
    {
        if (!isset($this->properties[$name])) {
            $this->properties[$name] = new Property($name);
        }
        return $this->properties[$name];
    }

    function getCache()
    {
        if (is_null($this->cache)) {
            $this->cache = new Cache();
        }
        return $this->cache;
    }
} 