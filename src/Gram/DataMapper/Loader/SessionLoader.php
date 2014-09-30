<?php

/**
 *
 *
 * @version   1.0
 * @author    jianphu (me@ljf.me)
 * @create    2014/9/30 10:16
 * @copyright Copyright (c) 2014 (http://ljf.me)
 */

namespace Gram\DataMapper\Loader;

class SessionLoader
{
    /**
     * @var array
     */
    protected static $_container = array();

    /**
     * @var ILoader
     */
    protected $loader;

    /**
     * @var Parameters
     */
    protected $params;

    /**
     * @param Parameters $params
     * @param ILoader    $loader
     */
    function __construct(Parameters $params, $loader = null)
    {
        $this->params = $params;
        $this->loader = $loader;
    }

    function fetch($id)
    {
        $className = $this->params->metadata->className;
        $key = strval($id);
        if (isset(self::$_container[$className]) && isset(self::$_container[$className][$key])) {
            return self::$_container[$className][$key];
        }

        if (is_null($this->loader)) {
            return null;
        }

        $entity = $this->loader->fetch($key);
        $this->addToContainer($entity);
        return $entity;
    }

    function fetchAll(array $ids)
    {
        $className = $this->params->metadata->className;
        if (!isset(self::$_container[$className])) {
            self::$_container[$className] = array();
        }

        $existIds = array_map(
            function ($id) {
                return intval($id);
            },
            array_keys(self::$_container[$className])
        );

        $entities = array();
        $diff = array_diff($ids, $existIds);
        if (!is_null($this->loader)) {
            $entities = $this->loader->fetchAll($diff);
            foreach ($entities as $entity) {
                $this->addToContainer($entity);
            }
        }

        $intersect = array_intersect($ids, $existIds);
        foreach ($intersect as $id) {
            $entities[] = $this->fetch($id);
        }
        return $entities;
    }

    protected function addToContainer($entity)
    {
        $className = get_class($entity);
        if (!isset(self::$_container[$className])) {
            self::$_container[$className] = array();
        }

        $name = $this->params->metadata->primaryKey->name;
        $key = strval($entity->{$name});
        self::$_container[$className][$key] = $entity;
    }
} 