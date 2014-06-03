<?php
namespace Gram\Domain;


use Gram\Domain\Mapping\Property;

class DemoModel extends EntityBase
{
    static protected function initMetadata()
    {
        static::table('tablename');

        static::property(Property::name('id')->type(Type::TYPE_INTEGER));

    }
} 