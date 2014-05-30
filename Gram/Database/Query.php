<?php
namespace Gram\Database;

class Query
{
    private $_table;

    public function __construct($table)
    {
        $this->_table=$table;
    }

    public static function Build($table)
    {
        return new Query($table);
    }

}