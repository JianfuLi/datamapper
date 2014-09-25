<?php

/**
 *
 *
 * @version   1.0
 * @author    jianphu (me@ljf.me)
 * @create    2014/9/25 14:33
 * @copyright Copyright (c) 2014 (http://ljf.me)
 */
class EntityQueryTest extends PHPUnit_Framework_TestCase
{
    public function testQuery()
    {
        $users = User::query()->sql('user_id = ?', 1)->all();
    }
}


class User extends \Gram\DataMapper\EntityBase
{
    static protected function initMetadata()
    {
        static::id('id')->type(\Gram\DataMapper\Type::TYPE_INTEGER);
        static::map('name')->type(\Gram\DataMapper\Type::TYPE_STRING);
    }
}