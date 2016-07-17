<?php

namespace Monolyth\Dabble\Test;

use Monolyth\Dabble\Adapter;
use Monolyth\Dabble\Query\UpdateException;

/**
 * Updating
 */
trait UpdateTest
{
    /**
     * update should update a row {?}
     */
    public function testUpdate(Adapter &$db = null, $table = 'test', $values = ['name' => 'douglas'], $where = ['id' => 1])
    {
        $db = $this->db;
        $res = $db->update('test', ['name' => 'douglas'], ['id' => 1]);
        yield assert($res == 1);
    }

    /**
     * update should throw an exception if nothing was updated {?}
     */
    public function testNoUpdate(Adapter &$db = null, $table = 'test', $values = ['name' => 'adams'], $where = ['id' => 12345])
    {
        $db = $this->db;
        $e = null;
        try {
            $db->update('test', ['name' => 'adams'], ['id' => 12345]);
        } catch (UpdateException $e) {
        }
        yield assert($e instanceof UpdateException);
    }
}

