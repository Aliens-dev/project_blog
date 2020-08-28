<?php


namespace app\DB\Models;


use app\App;

class Model
{
    protected static $table;

    public function url($prefix = '') {
        $model = strtolower(str_replace(__NAMESPACE__. '\\','',get_called_class())) . 's';
        return $prefix . '/'. $model. '/' . $this->id;
    }

    public static function query($query,$class,$fetchOne) {
        return App::getDB()->query($query,$class,$fetchOne);
    }
    public static function prepare($query,$params,$class,$fetchOne) {
        return App::getDB()->prepare($query,$params,$class,$fetchOne);
    }

    public static function insert($keys,$values) {
        $from = join(',', $keys);
        $count = count($values);
        $str = static::getCommas($count);
        $query = "INSERT INTO ". static::$table . "(". $from .") VALUES (" . $str . ")";
        return static::prepare($query, $values,static::class,null);
    }

    public static function update($keys, $values)
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
        return static::prepare($query, $values,static::class,null);
    }

    public static function getCommas($count)
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

    public static function delete($id)
    {
        return App::getDB()->delete(static::$table, [$id]);
    }

    public static function all($desc = 'DESC')
    {
        return static::query('SELECT * from '. static::$table . ' ORDER BY id ' . $desc,get_called_class(),false);
    }
    public static function find($params)
    {
        return static::prepare('SELECT * from '. static::$table . ' where id=?',$params,get_called_class(),true);
    }

    public static function limit($limit = 5) {
        return static::query('SELECT * from '. static::$table . ' ORDER BY id DESC limit 0,'. $limit,get_called_class(),false);
    }

    public static function count() {
        return static::query('SELECT count(*) as count from '. static::$table,get_called_class(),true);
    }

}