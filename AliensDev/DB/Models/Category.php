<?php


namespace app\DB\Models;


use app\App;

class Category extends Model
{
    protected static $table = 'categories';

    public function url($prefix = ""){
        return $prefix . '/categories/' . $this->id;
    }

    public function articles()
    {
        return App::getDB()->prepare("SELECT * from articles where id IN (select article_id from article_category WHERE category_id = ?)", [$this->id], Article::class, false);
    }

    public static function popular()
    {
        return App::getDB()->query("SELECT * from categories WHERE id IN (SELECT category_id from article_category group by (category_id) order by count(category_id) DESC) limit 0,5",Category::class,false);
    }
}