<?php

namespace models;

use core\Model;
use core\Core;

/**
 * @property string $title News Title
 * @property string $text News Text
 * @property string $short_text Short News Text
 * @property string $date Date
 * @property string $posted_by Posted BY who
 * @property int $id News ID
 * @property bool isFeatured Check if News is featured
 * @property int $category_id Category ID
 */
class News extends Model
{
    public static $tableName = 'news';
    public static function AddNews($title, $text, $short_text, $date, $posted_by, $isFeatured): void
    {
        $news = new News();
        $news->title=$title;
        $news->text=$text;
        $news->short_text=$short_text;
        $news->date=$date;
        $news->posted_by=$posted_by;
        $news->isFeatured=$isFeatured;
        $news->save();
    }
}