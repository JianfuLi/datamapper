<?php

namespace Gram\Domain\Sharding;


use Gram\Domain\IShardStrategy;

class EmptyShardStrategy implements IShardStrategy
{
    protected $tableName;

    function __construct($tableName)
    {
        $this->tableName = $tableName;
    }
}