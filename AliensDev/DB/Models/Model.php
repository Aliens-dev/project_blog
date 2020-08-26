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