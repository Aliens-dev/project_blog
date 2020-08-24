<?php


namespace app\DB\Models;


use app\App;

class Model
{
    protected static $table;

    public static function query($query,$class,$fetchOne) {
        return App::getDB()->query($query,$class,$fetchOne);
    }
    public static function prepare($query,$params,$class,$fetchOne) {
        return App::getDB()->prepare($query,$params,$class,$fetchOne);
    }
    public static function all()
    {
        return static::query('SELECT * from '. static::$table,get_called_class(),false);
    }
    public static function find($params)
    {
        return static::prepare('SELECT * from '. static::$table . ' where id=?',$params,get_called_class(),true);
    }
}