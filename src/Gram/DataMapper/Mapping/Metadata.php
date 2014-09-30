<?php

namespace Gram\DataMapper\Mapping;


use Gram\DataMapper\IShardStrategy;

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
     * @var string
     */
    public $className;

    /**
     * @param $className
     */
    function __construct($className)
    {
        $this->className = $className;
    }

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