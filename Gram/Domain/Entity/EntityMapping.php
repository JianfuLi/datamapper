<?php

namespace Gram\Domain\Entity;


use Gram\Domain\Mapping\Metadata;
use Gram\Domain\Mapping\PropertyMapping;
use Gram\Domain\IShardStrategy;
use Gram\Domain\Sharding\EmptyStrategy;

/**
 * Class EntityMapping
 *
 * @package Gram\Domain\Traits
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
    static protected function property($name)
    {
        $md = static::getMetadata();
        return new PropertyMapping($md->getProperty($name));
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
            $strategy = new EmptyStrategy($tableName);
        } else {
            throw new \Exception();
        }
        $md->shardStrategy = $strategy;
    }
} 