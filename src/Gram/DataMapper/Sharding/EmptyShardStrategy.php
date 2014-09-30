<?php

namespace Gram\DataMapper\Sharding;


use Gram\DataMapper\IShardStrategy;

class EmptyShardStrategy implements IShardStrategy
{
    protected $tableName;

    function __construct($tableName)
    {
        $this->tableName = $tableName;
    }

    function getTableName($args)
    {
        return $this->tableName;
    }
}