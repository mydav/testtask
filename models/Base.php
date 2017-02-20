<?php
namespace models;

abstract class Base
{
    protected $db;
    protected $table;
    protected $pk;


    public function __construct()
    {
        $this->db = \includes\Sql::instance();
    }


    public function getDBArray($value)
    {
        $array = $this->db->query("   SELECT * FROM {$this->table} WHERE {$this->pk} = '$value'   ");
        return $array;
    }

    public function getAll($sort)
    {
        return $this->db->query("SELECT * FROM {$this->table} ORDER BY {$sort} ");
    }

    public function insert($table, Array $obj)
    {
        return $this->db->insert($table, $obj);
    }

    public function update($table, Array $obj, $id, $pk)
    {
        $id = (int)$id;
        return $this->db->update($table, $obj, "$pk = $id");
    }

    public function delete($table, Array $obj)
    {
        $this->db->delete($table, $obj);

        return true;
    }
}
