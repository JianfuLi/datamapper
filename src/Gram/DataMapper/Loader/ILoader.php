<?php

/**
 *
 *
 * @version   1.0
 * @author    jianphu (me@ljf.me)
 * @create    2014/9/30 10:17
 * @copyright Copyright (c) 2014 (http://ljf.me)
 */
namespace Gram\DataMapper\Loader;

interface ILoader
{
    function fetch($id);

    function fetchAll(array $ids);
} 