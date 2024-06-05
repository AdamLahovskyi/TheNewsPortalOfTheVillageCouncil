<?php

namespace controllers;

use core\Controller;
use core\Core;
use core\Template;
use models\News;

class NewsController extends Controller
{
    public function actionAdd()
    {
        return $this->render();
    }
    public function actionIndex()
    {
        $db = Core::get()->db;
        $news = new News();
        $news->id=3;
        $news->title = '!news';
        $news->text = '!news';
        $news->short_text = '!news';
        $news->date = '2024-05-12 15:00:00';
        $news->save();
        $this->render();
    }
    public function actionView($params)
    {
        return $this->render();
    }
}