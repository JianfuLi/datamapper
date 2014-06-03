<?php
namespace Gram\Domain;

use Gram\Domain\Metadata\Mapper;
use Gram\Domain\Metadata\Property;
use Gram\Domain\Metadata\MapIterator;

abstract class EntityBase // implements \IteratorAggregate, \ArrayAccess
{
    use EntityAccessor;
}