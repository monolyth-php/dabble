<?php

/**
 * @package Monolyth\Dabble
 * @subpackage Query
 */

namespace Monolyth\Dabble\Query;

class InsertException extends Exception
{
    public function __construct($m = '', $c = null, $p = null)
    {
        parent::__construct($m, self::NOAFFECTEDROWS, $p);
    }
}

