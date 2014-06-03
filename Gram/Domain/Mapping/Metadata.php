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
} 