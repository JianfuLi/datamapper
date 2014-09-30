<?php

namespace Gram\DataMapper\Loader;

use Gram\DataMapper\Mapping\Metadata;

class LoaderBuilder
{
    /**
     * @var Parameters
     */
    protected $params;

    function __construct(Metadata $metadata)
    {
        $this->params = new Parameters();
        $this->params->metadata = $metadata;
    }


    public function shard($args)
    {
        $this->params->shardParams = func_get_args();
    }

    /**
     * @param $key
     * @param $expiration
     *
     * @return $this
     */
    public function cache($key, $expiration)
    {
        $this->params->cacheKey = $key;
        $this->params->cacheExpire = $expiration;
        return $this;
    }

    public function sql($condition, $params)
    {

    }

    public function fetch($id)
    {
        $objectLoader = new ObjectLoader($this->params);
        return $objectLoader->fetch($id);
    }

    public function fetchAll(array $ids)
    {
        $objectLoader = new ObjectLoader($this->params);
        return $objectLoader->fetchAll($ids);
    }
}