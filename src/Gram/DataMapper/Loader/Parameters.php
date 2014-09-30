<?php
/**
 *
 *
 * @version   1.0
 * @author    jianphu (me@ljf.me)
 * @create    2014/9/30 10:52
 * @copyright Copyright (c) 2014 (http://ljf.me)
 */

namespace Gram\DataMapper\Loader;

use Gram\DataMapper\Mapping\Metadata;

class Parameters
{
    /**
     * @var Metadata
     */
    public $metadata;
    /**
     * @var array
     */
    public $shardParams = array();
    /**
     * @var string
     */
    public $cacheKey;
    /**
     * @var int
     */
    public $cacheExpire;
} 