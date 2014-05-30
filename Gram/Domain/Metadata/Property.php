<?php

namespace Gram\Domain\Metadata;


class Property
{
    public $name;
    public $type;
    public $readable;
    public $writable;
    public $validators;

    function __construct($name, $type = null, $readable = true, $writable = true, $validators = array())
    {
        $this->name = $name;
        $this->type = $type;
        $this->readable = $readable;
        $this->validators = $validators;
        $this->writable = $writable;
    }
} 