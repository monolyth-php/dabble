<?php

namespace Monolyth\Dabble\Test;

use Monolyth\Dabble\Adapter;
use Monolyth\Dabble\Query;
use Carbon\Carbon;

/**
 * Selecting
 */
trait SelectTest
{
    /**
     * select should yield 3 rows when called with no where {?}
     */
    public function testSelects(Adapter &$db = null)
    {
        $db = $this->db;
        $tests = [];
        foreach ($db->select('test', '*', [], ['order' => 'id']) as $row) {
            $test[] = (int)$row['id'];
        }
        yield assert($test == [1, 2, 3]);
    }

    /**
     * fetch should yield just the first row {?}
     */
    public function testFetch(Adapter &$db = null)
    {
        $db = $this->db;
        $row = $db->fetch('test', '*', [], ['order' => 'id']);
        yield assert($row['id'] == 1);
    }

    /**
     * column should yield just a single columna {?}
     */
    public function testColumn(Adapter &$db = null)
    {
        $db = $this->db;
        $col = $db->column('test', '*', [], ['order' => 'id']);
        yield assert($col == 1);
    }

    /**
     * For no results, select should throw an exception {?}
     */
    public function testNoResults(Adapter &$db = null)
    {
        $db = $this->db;
        $e = null;
        try {
            $db->select('test', '*', ['id' => 12345]);
        } catch (Query\SelectException $e) {
        }
        yield assert($e instanceof Query\SelectException);
    }

    /**
     * count should return 3 for the 'test' table. {?}
     */
    public function testCount(Adapter &$db = null)
    {
        $db = $this->db;
        yield assert($db->count('test') == 3);
    }

    /**
     * fetchAll should return 3 rows for the 'test' table {?}.
     */
    public function testAll(Adapter &$db = null)
    {
        $db = $this->db;
        $rows = $db->fetchAll('test', '*');
        yield assert(count($rows) == 3);
    }

    /**
     * fetch should correctly alias a column {?}.
     */
    public function testAlias(Adapter &$db = null)
    {
        $db = $this->db;
        $res = $db->fetch('test', ['foo' => 'name'], ['id' => 1]);
        yield assert($res['foo'] == 'foo');
    }

    /**
     * fetch should be able to handle a subquery {?}.
     */
    public function testSubquery(Adapter &$db = null)
    {
        $db = $this->db;
        $where = ['id' => new Query\Select(
            $db,
            'test2',
            ['test'],
            new Query\Where(['data' => 'lorem ipsum']),
            new Query\Options
        )];
        $res = $db->fetch('test', 'name', $where);
        yield assert($res['name'] == 'foo');
    }
}

