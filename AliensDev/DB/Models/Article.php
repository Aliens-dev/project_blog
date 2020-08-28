<?php


namespace app\DB\Models;


use app\App;

class Article extends Model
{
    protected static $table = 'articles';


    public function excerpt($len = 100)
    {
        $excerpt = substr($this->excerpt, 0,$len) . ' ...';
        return $excerpt;
    }

    public function categories()
    {
        return App::getDB()->prepare("SELECT * from categories WHERE id IN (select category_id from articles LEFT JOIN article_category on articles.id = article_category.article_id WHERE articles.id = ?)", [$this->id],Category::class, false);
    }

    public function clearCategories() {
        return App::getDB()->prepare("DELETE from article_category WHERE article_id = ?", [$this->id],null, null);
    }

    public function addCategory($category)
    {
        return App::getDB()->prepare("INSERT into article_category(category_id,article_id) VALUES(?,?)",[$category->id,$this->id],ArticleCategory::class,null);
    }

}