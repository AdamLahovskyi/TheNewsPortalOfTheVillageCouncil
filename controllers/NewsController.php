<?php

namespace controllers;

use core\Template;

class NewsController
{
    public function actionAdd()
    {
        $template = new Template('views/news/add.php');
        return [
            'Content' => $template->getHTML(),
            'Title' => 'Add News'
        ];
    }
    public function actionIndex()
    {
        $template = new Template('views/news/index.php');
        return [
            'Content' => $template->getHTML(),
            'Title' => 'Index'
        ];
    }
    public function actionView($params)
    {
        return [
            'Content' => 'NewsController News View',
            'Title' => 'News View'
        ];
    }
}