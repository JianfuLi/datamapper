<?php
/**
 *
 *
 * @version   1.0
 * @author    jianphu (me@ljf.me)
 * @create    2014/9/30 10:22
 * @copyright Copyright (c) 2014 (http://ljf.me)
 */

namespace Gram\DataMapper\Loader;


class ObjectLoader
{
    /**
     * @var Parameters
     */
    protected $params;

    function __construct(Parameters $params)
    {
        $this->params = $params;
    }

    public function fetch($id)
    {
        return $this->getLoader()->fetch($id);
    }

    public function fetchAll(array $ids)
    {
        $items = $this->getLoader()->fetchAll($ids);

    }

    protected function getLoader()
    {
        $dbLoader = new DatabaseLoader($this->params);
        $cacheLoader = new RedisLoader($this->params, $dbLoader);
        $sessionLoader = new SessionLoader($this->params, $cacheLoader);
        return $sessionLoader;
    }

    protected function sort(array $entities, array $ids)
    {
        $ordered = array();
        foreach ($ids as $id) {
            if (array_key_exists($key, $array)) {
                $ordered[$key] = $array[$key];
                unset($array[$key]);
            }
        }
        return $ordered + $array;
    }
} 