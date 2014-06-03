<?php

namespace Gram\Domain\Mapping;


class Metadata
{
    protected $tableName;

    protected $properties;

    function __construct()
    {
    }

    function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

    function getTableName()
    {
        return $this->tableName;
    }

    function getProperties()
    {
        $this->properties;
    }

    function setProperty(Property $property)
    {
        $this->properties[$property->getName()] = $property;
    }
} 