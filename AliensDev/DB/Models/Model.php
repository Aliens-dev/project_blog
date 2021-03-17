<?php


namespace app\DB\Models;


use app\App;

class Model
{
    protected static $table;

    public static function __callStatic($method, $args)
    {
        call_user_func_array([get_called_class(),$method], $args);
    }
    
    public function url($prefix = '') {
        $model = strtolower(str_replace(__NAMESPACE__. '\\','',get_called_class())) . 's';
        return $prefix . '/'. $model. '/' . $this->id;
    }

    public function insert($keys,$values) {
        $from = join(',', $keys);
        $count = count($values);
        $str = self::getCommas($count);
        $query = "INSERT INTO ". static::$table . "(". $from .") VALUES (" . $str . ")";
        return App::getDB()->prepare($query, $values,get_called_class(),null);
    }

    public function update($keys, $values)
    {
        $str = '';
        for($i=0;$i < count($values) - 1; $i++) {
            if($i < count($values) - 2) {
                $str .= $keys[$i] . "=" . "?,";
            }else {
                $str .= $keys[$i] . "=" . "?";
            }
        }
        $query = "UPDATE ". static::$table . " SET ". $str . " WHERE id=?";
        return App::getDB()->prepare($query, $values,get_called_class(),null);
    }

    public function getCommas($count)
    {
        $str = '';
        for($i=0;$i < $count;$i++) {
            if($i != $count - 1) {
                $str .= '?,';
            }else {
                $str .= '?';
            }
        }
        return $str;
    }

    public function delete($id)
    {
        return App::getDB()->delete(static::$table, [$id]);
    }

    public function all($desc = 'DESC')
    {
        return App::getDB()->query('SELECT * from '. static::$table . ' ORDER BY id ' . $desc,get_called_class(),false);
    }
    public function find($params)
    {
        return App::getDB()->prepare('SELECT * from '. static::$table . ' where id=?',$params,get_called_class(),true);
    }

    public function limit($limit = 5) {
        return App::getDB()->query('SELECT * from '. static::$table . ' ORDER BY id DESC limit 0,'. $limit,get_called_class(),false);
    }

    public function count() {
        return App::getDB()->query('SELECT count(*) as count from '. static::$table,get_called_class(),true);
    }

}