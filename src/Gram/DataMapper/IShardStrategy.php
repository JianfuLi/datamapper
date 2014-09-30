<?php

namespace Gram\DataMapper;


interface IShardStrategy
{
    function getTableName($args);
} 