<?php


namespace app\DB;


use app\Config;
use PDO;
class Database
{
    private $db = null;

    private $select = [];
    private $from = [];
    private $where = [];

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
        $pdo = new PDO('mysql:host='. $config['DB_HOST'] .';dbname='. $config['DB_NAME'], $config['DB_USER'], $config['DB_PASS']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public function prepare($query,$params,$class,$fetchOne = true)
    {
        $result = $this->getDb()->prepare($query);
        $result->execute($params);
        $result->setFetchMode(\PDO::FETCH_CLASS, $class);
        if($fetchOne) {
            return $result->fetch();
        }
        return $result->fetchAll();
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


    public function select() {
        $this->select = func_get_args();
        return $this;
    }

    public function from() {
        $this->from = func_get_args();
        return $this;
    }

    public function where($where)
    {
        $this->where[] = ' WHERE ' . $where;
        return $this;
    }

    public function get()
    {
        return 'SELECT ' . join(',', $this->select) . ' FROM ' . join(',', $this->from) . ' ' . join(' AND ', $this->where);
    }
}