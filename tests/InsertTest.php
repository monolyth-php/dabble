<?php

namespace Monolyth\Dabble\Test;

use Monolyth\Dabble\Adapter;
use Monolyth\Dabble\Query\InsertException;

/**
 * Insertions
 */
trait InsertTest
{
    /**
     * insert should insert a new row {?}
     */
    public function testInsert(Adapter &$db = null)
    {
        $db = $this->db;
        $res = $db->insert('test', ['name' => 'monomelodies']);
        yield assert($res == 1);
    }

    /**
     * insert should throw an exception if nothing was inserted {?}
     */
    public function testNoInsert(Adapter &$db = null)
    {
        $db = $this->db;
        $e = null;
        try {
            $db->insert('test2', ['test' => null]);
        } catch (InsertException $e) {
        }
        yield assert($e instanceof InsertException);
    }
}

