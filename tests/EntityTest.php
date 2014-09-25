<?php

class Property
{
}

/**
 * Class ExampleEntity
 *
 * @property integer   id
 * @property string    name
 * @property string    obj
 */
class Entity extends Gram\DataMapper\EntityBase
{
    /**
     *
     */
    static protected function initMetadata()
    {
        static::id('id')->type(\Gram\DataMapper\Type::TYPE_INTEGER);
        static::map('name')->type(\Gram\DataMapper\Type::TYPE_STRING);
        static::map('obj')->type('Property');
    }
}

/**
 *
 *
 * @version   1.0
 * @author    jianphu (me@ljf.me)
 * @create    2014/9/24 16:26
 * @copyright Copyright (c) 2014 (http://ljf.me)
 */
class EntityTest extends PHPUnit_Framework_TestCase
{
    public function testPropertyTypeAutoConverter()
    {
        $entity = new Entity();
        $this->assertTrue(0 === $entity->id);

        $entity->id = '10';
        $this->assertTrue(10 === $entity->id);
        $entity->id = 'a';
        $this->assertTrue(0 === $entity->id);
        $entity->id = '';
        $this->assertTrue(0 === $entity->id);
        $entity->id = null;
        $this->assertTrue(0 === $entity->id);

        $this->assertEquals(null, $entity->name);
        $entity->name = 1;
        $this->assertEquals('1', $entity->name);

        $this->assertTrue(null === $entity->obj);

        $obj = new Property();
        $entity->obj = $obj;
        $this->assertTrue($obj === $entity->obj);
    }

    public function testAccessNotExistProperty()
    {

    }
}