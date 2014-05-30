<?php
namespace Gram\Domain\Metadata;

use Gram\Domain\Base;
use Gram\Domain\Validator;

class Mapper
{
    /**
     * @var Property
     */
    public $property;
    /**
     * @var Base
     */
    public $owner;

    function __construct($property, Base $owner)
    {
        $this->property = new Property($property);
        $this->owner = $owner;
        $this->merge();
    }

    function type($type)
    {
        $this->property->type = $type;
        $this->merge();
        return $this;
    }

//    /**
//     * @return Mapper
//     */
//    function readOnly()
//    {
//        $this->property->readable = true;
//        $this->property->writable = false;
//        $this->merge();
//        return $this;
//    }
//
//    /**
//     * @return Mapper
//     */
//    function writeOnly()
//    {
//        $this->property->readable = false;
//        $this->property->writable = true;
//        $this->merge();
//        return $this;
//    }

    /**
     *
     *
     * @param Validator $validator
     *
     * @return Mapper
     */
    function validator(Validator $validator)
    {
        $this->property->validators[] = $validator;
        $this->merge();
        return $this;
    }

    protected function merge()
    {
        $this->owner->__mergePropertyMetadata($this->property);
    }
} 