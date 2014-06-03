<?php

namespace Gram\Domain\Mapping;


class Cache
{
    public $provider = null;
    public $cacheable = false;
    public $useQueryCache = false;
    public $expiration = 3600;

    function __construct($cacheable = true)
    {
        $this->cacheable = $cacheable;
    }
}