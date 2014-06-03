<?php

namespace Gram\Domain\Sharding;


use Gram\Domain\IShardStrategy;

class EmptyStrategy implements IShardStrategy
{
    protected $tableName;

    function __construct($tableName)
    {
        $this->tableName = $tableName;
    }
}