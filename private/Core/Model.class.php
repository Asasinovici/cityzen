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

    function getAll()
    {
        $query = 'SELECT * FROM ' . $this->table . ';';

        $data = $this->db->runSelectQuery($query);

        return $data;
    }

    function find($id = null)
    {
        if (!isset($id)) {
            return null;
        };

        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ' . $id . ' LIMIT 1;';

        $data = $this->db->runSelectQuery($query);

        if (!isset($data[0])) {
            return null;
        }
        return $data[0];
    }

    function delete($id = null)
    {
        if (!isset($id)) {
            return false;
        };

        $query = 'DELETE FROM ' . $this->table . ' WHERE id = ' . $id . ';';

        $data = $this->db->runCUDQuery($query);

        return $data;
    }

    function create($data = [])
    {
        if (!isset($data)) {
            return false;
        };

        $query = 'INSERT INTO ' . $this->table;

        $columns = [];
        $values = [];
        $k = [];

        foreach ($data as $column => $value) {
            $columns[] = $column;
            $values[] = $value;
            $k[] = '?';
        }

        $query = $query . ' ( ' . implode(', ', $columns) . ' ) VALUES ( ' . implode(', ', $k) . ' )';

        $data = $this->db->runCUDQuery($query, $values);

        return $data;
    }

    function update($id, $data = [])
    {
        if (!isset($id) || !isset($data)) {
            return false;
        };

        $query = 'UPDATE ' . $this->table . ' SET ';

        $columns = [];
        $values = [];

        foreach ($data as $column => $value) {
            $columns[] = $column . ' = :' . $column;
            $values[':' . $column] = $value;
        }
        $values[':id'] = $id;
        $query .= implode(', ', $columns) . ' WHERE id = :id';

        $data = $this->db->runCUDQuery($query, $values);

        return $data;
    }
}