<?php
namespace Gram\Type;

class DateTime extends \DateTime implements IType
{
    const ZH_CN = "Y-m-d H:i:s";

    function __toString()
    {
        return $this->format(self::ZH_CN);
    }
}