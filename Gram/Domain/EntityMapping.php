<?php

namespace Gram\Domain;


use Gram\Domain\Mapping\Metadata;
use Gram\Domain\Mapping\PropertyMapping;
use Gram\Domain\Sharding\EmptyStrategy;

trait EntityMapping
{
    /**
     * @var Metadata
     */
    private static $_md = null;

    /**
     * @return mixed
     */
    abstract static protected function initMetadata();

    static function getMetadata()
    {
        if (is_null(static::$_md)) {
            static::$_md = new Metadata();
        }

        return static::$_md;
    }

    static protected function property($name)
    {
        $md = static::getMetadata();
        return new PropertyMapping($md->getProperty($name));
    }

    static protected function table($tableName)
    {
        $md = static::getMetadata();

        if ($tableName instanceof IShardStrategy) {
            $strategy = $tableName;
        } elseif (is_string($tableName)) {
            $strategy = new EmptyStrategy($tableName);
        } else {
            throw new \Exception();
        }
        $md->shardStrategy = $strategy;
    }
} 