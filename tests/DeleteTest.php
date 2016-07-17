<?php

namespace Monolyth\Dabble\Test;

use Monolyth\Dabble\Adapter;
use Monolyth\Dabble\Query\DeleteException;

/**
 * Deletion
 */
trait DeleteTest
{
    /**
     * delete should delete a row {?}
     */
    public function testDelete(Adapter &$db = null)
    {
        $db = $this->db;
        $res = $db->delete('test', ['id' => 1]);
        yield assert($res == 1);
    }
    
    /**
     * delete should throw an exception if nothing was deleted {?}
     */
    public function testNoDelete(Adapter &$db = null)
    {
        $db = $this->db;
        $e = null;
        try {
            $db->delete('test', ['id' => 12345]);
        } catch (DeleteException $e) {
        }
        yield assert($e instanceof DeleteException);
    }
}

