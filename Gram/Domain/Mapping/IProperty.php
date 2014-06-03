<?php

namespace Gram\Domain\Mapping;


use Gram\Domain\IValidator;

interface IProperty
{
    /**
     * @param $type
     *
     * @return IProperty
     */
    function type($type);

    /**
     * @param IValidator $validator
     *
     * @return IProperty
     */
    function validator(IValidator $validator);
} 