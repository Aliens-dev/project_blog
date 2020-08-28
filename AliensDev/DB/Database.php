<?php


namespace app\DB;


use app\Config;
use PDO;
class Database
{
    private $db = null;

    public function __construct()
    {
        $this->getInstance();
    }
    private function getInstance() {
        if($this->db !== null) {
            return $this->getDb();
        }
        return $this->db;
    }

    private function getDb() {
        $config = Config::get('DB');
        $pdo = null;
        try {
            $pdo = new PDO('mysql:host='. $config['DB_HOST'] .';dbname='. $config['DB_NAME'], $config['DB_USER'], $config['DB_PASS']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch (\Exception $e) {
            echo $e->getMessage();
            die();
        }
        return $pdo;
    }

    public function prepare($query,$params,$class,$fetchOne = true)
    {
        $pdo = $this->getDb();
        $id = null;
        $result = null;
        $pdo->beginTransaction();
        try {
            $result = $pdo->prepare($query);
            $result->execute($params);
            $id = $pdo->lastInsertId();
            $pdo->commit();
            $result->setFetchMode(\PDO::FETCH_CLASS, $class);
        }catch (\Exception $e) {
            echo $e->getMessage();
        }
        if(is_null($fetchOne)) {
            return $id;
        }
        if($fetchOne) {
            $result = $result->fetch();
            return $result;
        }
        return $result->fetchAll();
    }

    public function delete($table,$params) {
        $result = $this->getDb()->prepare("DELETE FROM ". $table . " WHERE id =?");
        $executed = $result->execute($params);
        return $executed;
    }

    public function query($query, $class, $fetchOne = true)
    {
        $result = $this->getDb()->query($query);
        $result->setFetchMode(\PDO::FETCH_CLASS, $class);
        if($fetchOne) {
            return $result->fetch();
        }
        return $result->fetchAll();
    }
}