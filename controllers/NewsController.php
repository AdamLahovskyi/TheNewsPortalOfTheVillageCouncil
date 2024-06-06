<?php

namespace controllers;

use core\Controller;
use core\Core;
use core\Template;
use models\News;
use models\Users;

class NewsController extends Controller
{
    public function actionAdd()
    {
        return $this->render();
    }
    public function actionIndex()
    {
        return $this->render();
    }
    public function actionTodaysLatestNews()
    {
        return $this->render();
    }
    public function actionView($params)
    {
        return $this->render();
    }
}