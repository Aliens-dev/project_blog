<?php


namespace app\DB\Models;


class Article extends Model
{
    protected static $table = 'articles';


    public function excerpt($len = 100)
    {
        $excerpt = substr($this->excerpt, 0,$len) . ' ...';
        return $excerpt;
    }
}