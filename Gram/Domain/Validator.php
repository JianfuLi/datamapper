<?php

namespace Gram\Domain;


abstract class Validator
{
    abstract function validate($value);
} 