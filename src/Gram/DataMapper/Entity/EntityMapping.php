<?php

namespace Gram\DataMapper\Entity;


use Gram\DataMapper\Mapping\CacheMapping;
use Gram\DataMapper\Mapping\Metadata;
use Gram\DataMapper\Mapping\PropertyMapping;
use Gram\DataMapper\IShardStrategy;
use Gram\DataMapper\Sharding\EmptyShardStrategy;

/**
 * Class EntityMapping
 *
 * @package Gram\DataMapper\Entity
 */
abstract class EntityMapping
{
    /**
     * @var Metadata
     */
    private static $_md = null;

    /**
     *
     */
    abstract static protected function initMetadata();

    /**
     * 获取对象元数据
     *
     * @return Metadata
     */
    static function getMetadata()
    {
        if (is_null(static::$_md)) {
            static::$_md = new Metadata();
        }

        return static::$_md;
    }

    /**
     * 定义属性名称
     *
     * @param $name
     *
     * @return PropertyMapping
     */
    static protected function map($name)
    {
        $md = static::getMetadata();
        return new PropertyMapping($md->getProperty($name));
    }

    /**
     * @param $name
     *
     * @return PropertyMapping
     */
    static protected function id($name)
    {
        $md = static::getMetadata();
        $md->primaryKey = $md->getProperty($name);
        return new PropertyMapping($md->primaryKey);
    }

    /**
     * 定义表名
     *
     * @param $tableName
     *
     * @throws \Exception
     */
    static protected function table($tableName)
    {
        $md = static::getMetadata();
        if ($tableName instanceof IShardStrategy) {
            $strategy = $tableName;
        } elseif (is_string($tableName)) {
            $strategy = new EmptyShardStrategy($tableName);
        } else {
            throw new \Exception();
        }
        $md->shardStrategy = $strategy;
    }

    /**
     * @return CacheMapping
     */
    static protected function cache()
    {
        $md = static::getMetadata();
        return new CacheMapping($md->getCache());
    }
} 