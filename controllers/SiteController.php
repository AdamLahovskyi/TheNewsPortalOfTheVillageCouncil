<?php

namespace controllers;

class SiteController
{
 public function actionIndex()
 {
    echo 'MainPage';
 }
 public function actionError($code)
 {
    echo $code;
 }
}