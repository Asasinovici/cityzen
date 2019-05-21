<?php


namespace Core;

class Model
{
    protected $db = null;
    protected $table = null;

    function __construct()
    {
        $this->db = Database::getInstance();
    }

    function getAllRecords()
    {
        $query = 'SELECT * FROM ' . $this->table . ';';

        $data = $this->db->runQuery($query);

        return $data;
    }

    function find($id = null)
    {
        if (!isset($id)) {
            return null;
        };

        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ' . $id . ' LIMIT 1;';

        $data = $this->db->runQuery($query);

        if (!isset($data[0])) {
            return null;
        }
        return $data[0];
    }
}