<?php

namespace Gram\Type;


class String implements IType
{
    private $value;

    function __construct($value)
    {
        $this->value = $value;
    }

    function concat($value)
    {
        if (is_array($value)) {
            $this->value .= implode('', $value);
        } else {
            $this->value .= $value;
        }
    }

    function contains($value)
    {
        return strpos($this->value, $value) !== false;
    }

    function format($format)
    {
        return sprintf($format, $this->value);
    }

    function startsWith($value)
    {
        return $value === '' || strpos($this->value, $value) === 0;
    }

    function endsWith($value)
    {
        return $value === '' || substr($this->value, -strlen($value)) === $value;
    }

    function indexOf($value)
    {
        $index = strpos($this->value, $value);
        return $index === false ? -1 : $index;
    }

    function lastIndexOf($value)
    {
        $index = strrpos($this->value, $value);
        return $index === false ? -1 : $index;
    }

    function padLeft($length, $str)
    {
        return str_pad($this->value, $length, $str, STR_PAD_LEFT);
    }

    function padRight($length, $str)
    {
        return str_pad($this->value, $length, $str, STR_PAD_RIGHT);
    }

    function replace($old, $new)
    {
        return str_replace($this->value, $old, $new);
    }

    function split($separator, $limit = null)
    {
        return explode($separator, $this->value, $limit);
    }

    function substring($start, $length = null)
    {
        return substr($this->value, $start, $length);
    }

    function toLower()
    {
        return strtolower($this->value);
    }

    function toUpper()
    {
        return strtoupper($this->value);
    }

    function trim()
    {
        return trim($this->value);
    }

    function trimEnd()
    {
        return rtrim($this->value);
    }

    function trimStart()
    {
        return ltrim($this->value);
    }

    function isNullOrEmpty()
    {
        return empty($this->value);
    }

    function __toString()
    {
        return strval($this->value);
    }
}