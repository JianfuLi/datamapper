<?php
namespace Gram\Domain;


class DemoModel extends EntityBase
{
    static protected function initMetadata()
    {
        self::table('tablename');
        self::cache()
            ->provider('providerClass')
            ->expire(3600)
            ->useQueryCache();

        self::id('id')
            ->type(Type::TYPE_INTEGER);

        self::map('name')
            ->type(Type::TYPE_STRING);

    }
}