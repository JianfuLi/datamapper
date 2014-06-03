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

    /**
     * @param $name
     *
     * @return Property
     */
    function getProperty($name)
    {
        if (!isset($this->properties[$name])) {
            $this->properties[$name] = new Property($name);
        }
        return $this->properties[$name];
    }
} 