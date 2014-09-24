<?php

namespace Gram\DataMapper\Mapping;


use Gram\DataMapper\Type;

class CacheMapping
{
    protected $cache;

    function __construct(Cache &$cache)
    {
        $this->cache = $cache;
    }

    function provider($provider)
    {
        $this->cache->provider = $provider;
        return $this;
    }

    function useQueryCache()
    {
        $this->cache->useQueryCache = true;
        return $this;
    }

    function expire($seconds)
    {
        $this->cache->expiration = Type::toInt($seconds);
        return $this;
    }
} 