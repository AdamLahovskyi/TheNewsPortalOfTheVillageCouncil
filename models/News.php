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
 */
class News extends Model
{
    public static $tableName = 'news';
}