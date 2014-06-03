<?php
namespace Gram\Domain;


class DemoModel extends EntityBase
{
    static protected function initMetadata()
    {
        static::table('tablename');

        static::property('name')
            ->type(Type::TYPE_INTEGER);

    }
}