<?php

namespace Gram\DataMapper\Database;

use Gram\DataMapper\Mapping\Metadata;

class Builder
{
    /**
     * @var Metadata
     */
    protected $metadata;

    function __construct(Metadata $metadata)
    {
        $this->metadata = $metadata;
    }

    public function cache($key, $expiration)
    {

    }

    public function sql($condition, $params)
    {
        $args = func_get_args();
        $condition = array_shift($condition);
        $params = $args;
        return $this;
    }

    public function all()
    {
        return array();
    }

    public function one()
    {
        return array();
    }
}