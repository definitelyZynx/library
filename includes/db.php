<?php

class db
{
    private $server_name = "localhost";
    private $db_user_name = "root";
    private $db_password = "";
    private $db_name = "book_catalog";

    private $instance;

    function __construct()
    {
        try {
            $dsn = "mysql:host={$this->server_name};dbname={$this->db_name}";
            $this->instance = new PDO($dsn, $this->db_user_name, $this->db_password);
            $this->instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    function process_db($sql, $params = [], $flag = false)
    {
        try {
            $stmt = $this->instance->prepare($sql);
            $stmt->execute($params);

            if ($flag) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }

            $stmt->closeCursor();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    function insert_id()
    {
        return $this->instance->lastInsertId();
    }

    function __destruct()
    {
        $this->instance = null;
    }
}

date_default_timezone_set('Asia/Singapore');
$db = new db();
