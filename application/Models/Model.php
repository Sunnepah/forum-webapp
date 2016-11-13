<?php

namespace Application\Models;

use Lustre\Database\Database;

abstract class Model
{
    /**
     * @param Database $db
     * @return array
     */
    public function findAll(Database $db) {
        return $db->getAll($this->table);
    }

    /**
     * @param Database $db
     * @param $data
     * @return string
     */
    public function save(Database $db, $data) {
        return $db->insert($this->table, $data);
    }
}