<?php

namespace includes;

class Sql
{
    private static $instance;

    private $db;

    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new Sql();
        }

        return self::$instance;
    }

    private function __construct()
    {
        $dsn = 'mysql:host=localhost' . ';dbname=' . 'test_task' . ';charset=utf8';
        $opt = [
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        ];

        try {
            setlocale(LC_ALL, 'ru.RU');
            $this->db = new \PDO($dsn, 'root', '123456', $opt);
        } catch (\PDOException $e) {
            die('Подключение к базе данных не удалось ' . $e->getMessage());
        }
    }


    public function query($query)
    {
        try {
            $q = $this->db->prepare($query);
            $q->execute();

            return $q->fetchAll();
        } catch (\PDOException $e) {
            die('Ошибка запроса ' . $e->getMessage());
        }
    }

    /**
     * @param $table string
     * @param array $obj вида ['field1' => 'val1', 'field2' => 'val2']
     */
    public function insert($table, $obj)
    {
        $columns = [];
        $masks = [];

        foreach ($obj as $key => $value) {
            $columns[] = $key;
            $masks[] = ":$key";

            if ($value == null) {
                $obj[$key] = 'NULL';
            }
        }

        $columns_s = implode(',', $columns);
        $masks_s = implode(',', $masks);


        $query = "INSERT INTO `$table` ($columns_s) VALUES ($masks_s)";

        try {
            $q = $this->db->prepare($query);
            $q->execute($obj);

            return $this->db->lastInsertId();
        } catch (\PDOException $e) {
            die('Ошибка запроса ' . $e->getMessage());
        }
    }

    public function update($table, Array $obj, $where = '')
    {
        $sets = [];

        foreach ($obj as $key => $value) {
            $sets[] = "$key=:$key";

            if ($value == null) {
                $obj[$key] = 'NULL';
            }
        }

        $sets_s = implode(',', $sets);

        $query = "UPDATE $table SET $sets_s WHERE $where";


        try {
            $q = $this->db->prepare($query);
            $q->execute($obj);

            return $q->rowCount();
        } catch (\PDOException $e) {
            die('Ошибка запроса ' . $e->getMessage());
        }
    }

    public function delete($table, Array $obj)
    {
        $sets = [];

        foreach ($obj as $key => $value) {
            $sets[] = "$key=:$key";

            if ($value == null) {
                $obj[$key] = 'NULL';
            }
        }

        $sets_s = implode(',', $sets);
        $query = "DELETE FROM $table WHERE $sets_s;";


        try {
            $q = $this->db->prepare($query);
            $q->execute($obj);

            return $q->rowCount();
        } catch (\PDOException $e) {
            die('Ошибка запроса ' . $e->getMessage());
        }
    }
}
