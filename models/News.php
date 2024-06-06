<?php

namespace models;

use core\Model;
use core\Core;

/**
 * @property string $title News Title
 * @property string $text News Text
 * @property string $short_text Short News Text
 * @property string $date Date
 * @property int $id News ID
 * @property int $category_id Category ID
 */
class News extends Model
{
    public static $tableName = 'news';
}