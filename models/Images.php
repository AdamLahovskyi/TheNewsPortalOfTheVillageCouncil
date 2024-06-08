<?php

namespace models;

use core\Core;

/**
 * @property int $id Id
 * @property string $picture picture
 * @property int $news_id news_id
 * @property string $type firstname
 */
class Images extends \core\Model
{
    public static $tableName = 'images';
    public static function findPictureByID($id)
    {
        return self::findByID($id);
    }
    public static function RegisterImage($picture, $news_id, $type)
    {
        $image = new Images();
        $image->picture = $picture;
        if(isset($image->news_id)){
            $image->news_id = $news_id;
        }else{
            $image->news_id = 'nnp';
        }
        $image->type = $type;
        $image->save();
    }
}