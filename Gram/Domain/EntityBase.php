<?php
namespace Gram\Domain;

abstract class EntityBase // implements \IteratorAggregate, \ArrayAccess
{
    use EntityAccessor;
}