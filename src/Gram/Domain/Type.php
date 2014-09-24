<?php

namespace Gram\Domain;

use Gram\Exception\TypeException;

final class Type
{
    /**
     * 布尔值类型
     * @var string
     */
    const TYPE_BOOLEAN = 'boolean';

    /**
     * 整型类型
     * @var string
     */
    const TYPE_INTEGER = 'integer';

    /**
     * 双精度类型，由于历史原因，如果是 float 则返回“double”，而不是“float”
     *
     * @var string
     */
    const TYPE_DOUBLE = 'double';

    /**
     * 字符串类型
     * @var string
     */
    const TYPE_STRING = 'string';

    /**
     * 数组类型
     * @var string
     */
    const TYPE_ARRAY = 'array';

    /**
     *
     */
    const TYPE_DATETIME = 'DateTime';

    /**
     * @param $value
     * @param $type
     *
     * @return mixed
     * @throws \Gram\Exception\TypeException
     */
    static function convert($value, $type)
    {
        $valueType = gettype($value);
        if ($valueType === 'object') {
            if (!($value instanceof $type)) {
                throw new TypeException('类型错误');
            }
        } elseif ($valueType !== $type) {
            settype($value, $type);
        }
        return $value;
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    static function toInt($value)
    {
        return self::convert($value, self::TYPE_INTEGER);
    }
} 