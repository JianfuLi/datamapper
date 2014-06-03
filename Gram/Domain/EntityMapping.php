<?php

namespace Gram\Domain;


use Gram\Domain\Mapping\Metadata;

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

    static protected function property(IProperty $property)
    {
        $md = static::getMetadata();
        $md->setProperty($property);
    }

    static protected function table($tableName)
    {
        $md = static::getMetadata();
        $md->setTableName($tableName);
    }
} 