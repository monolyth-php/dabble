<?php

/**
 * @package Monolyth\Dabble
 * @subpackage Query
 */

namespace Monolyth\Dabble\Query;

class SelectException extends Exception
{
    public function __construct($m = '', $c = null, $p = null)
    {
        parent::__construct($m, self::EMPTYRESULT, $p);
    }
}

