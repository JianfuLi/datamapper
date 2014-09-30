<?php
/**
 *
 *
 * @version   1.0
 * @author    jianphu (me@ljf.me)
 * @create    2014/9/25 14:32
 * @copyright Copyright (c) 2014 (http://ljf.me)
 */

namespace Gram\DataMapper\Entity;

use Gram\DataMapper\Database\QueryBuilder;

abstract class Query extends Access
{
    public static function query()
    {
        return new QueryBuilder(static::getMetadata());
    }
} 