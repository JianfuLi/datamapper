<?php
namespace Gram\Domain;


class DemoModel extends EntityBase
{
    static protected function initMetadata()
    {
        self::table(new ModShardStrategy(100));
        self::cache()
            ->provider('providerClass')
            ->expire(3600)
            ->useQueryCache();

        self::id('id')
            ->type(Type::TYPE_INTEGER)
            ->required();

        self::map('name')
            ->type(Type::TYPE_STRING)
            ->required()
            ->column('user_name')
            ->validator(Validator::range(3, 20));

        self::map('email')
            ->type(Type::TYPE_STRING)
            ->required()
            ->validator(Validator::email(30));
    }
}