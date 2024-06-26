<?php

namespace controllers;

use core\Controller;
use core\Template;

class SiteController extends Controller
{
    public function actionIndex()
    {
        return $this->render();
    }
    public function actionPagination()
    {
        return $this->render();
    }
    public function actionSearchresult()
    {
        return $this->render();
    }
    public function actionError($code)
    {
        return $this->render();
    }
    public function actionUpdateSuccess()
    {
       return $this->render();
    }
}