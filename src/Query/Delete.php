<?php

/**
 * Class for generating DELETE queries.
 *
 * @package Monolyth\Dabble
 * @subpackage Query
 * @author Marijn Ophorst <marijn@monomelodies.nl>
 * @copyright MonoMelodies 2015, 2016
 */

namespace Monolyth\Dabble\Query;

use Monolyth\Dabble\Query;
use Monolyth\Dabble\Adapter;

class Delete extends Query
{
    protected $where;

    public function __construct(Adapter $adapter, $table, Where $where)
    {
        parent::__construct($adapter, $table);
        $this->where = $where;
        $this->bound = $where->getBindings();
    }

    /**
     * Delete a row from the database.
     *
     * @param string $table The table to delete from.
     * @param array $where Array of where statements to limit deletes.
     * @return int The number of deleted rows.
     * @throws Monolyth\Dabble\Query\DeleteException if no rows were deleted.
     * @throws Monolyth\Dabble\Query\SqlException on error.
     */
    public function execute()
    {
        $stmt = parent::execute();
        if ($affectedRows = $stmt->rowCount() and $affectedRows) {
            return $affectedRows;
        }
        $info = $stmt->errorInfo();
        $msg = "{$info[0]} / {$info[1]}: {$info[2]} - $this";
        throw new DeleteException($this->error($msg, $this->bound));
    }

    public function __toString()
    {
        return sprintf(
            "DELETE FROM %s WHERE %s",
            $this->table,
            $this->where
        );
    }
}

