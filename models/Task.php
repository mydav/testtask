<?php

namespace models;

class Task extends \models\Base
{
    private static $instance;
    private $iHelper;

    public function __construct()
    {
        parent::__construct();
        $this->iHelper = \includes\Helper::Instance();
        $this->table = 'tasks';
        $this->pk = 'id';
    }

    public static function Instance()
    {
        if(self::$instance === null)
           return self::$instance = new self;
        return self::$instance;
    }

    public function getAllTasks($sort)
    {
        return $this->getAll($sort);
    }

    public function getOneTask($id)
    {
	    $getDetail = $this->getDBArray($id);

		if(is_array($getDetail) && count($getDetail) > 0)
        {
			return $getDetail;

		}else {
			return false;
		}

    }


    public function recordTask($id, Array $obj)
    {
        $this->db->update($this->table, $obj, $id, $this->pk );

        return true;
    }

    public function createNewTask($obj)
    {
        return $this->db->insert($this->table, $obj);

    }

    public function updateTask(Array $obj, $id)
    {
        $this->update($this->table, $obj, $id, $this->pk);
    }

    public function deleteTask(Array $obj)
    {
        $this->delete($this->table, $obj);
        $this->iHelper->redirectTo('/');
    }
}
