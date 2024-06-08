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
        if ($this->isPost) {
            $this->clearErrorMessage();
            $title = $this->post->title ?? '';
            $text = $this->post->text ?? '';
            $short_text = $this->post->short_text ?? '';
            $isFeatured = $this->post->isFeatured ?? '0';
            if (empty($title)) {
                $this->addErrorMessage('Title Can`t Be Empty');
            }
            if (empty($text)) {
                $this->addErrorMessage('Description Can`t Be Empty');
            }
            if (empty($short_text)) {
                $this->addErrorMessage('Short Description Can`t Be Empty');
            }
            if (!$this->isErrorMessagesExists()) {
                News::AddNews(
                    $title,
                    $text,
                    $this->post->short_text,
                    date("Y-m-d"),
                    Users::GetLoggedInUser()['login'],
                    $isFeatured);
                return $this->redirect('/news/addsuccess');
            }
        }
        return $this->render();
    }
    public function buildUserFullName()
    {
        return Users::GetLoggedInUser()['firstname'].' '.Users::GetLoggedInUser()['lastname'];
    }
    public function actionIndex()
    {
        return $this->render();
    }
    public function actionTodaysLatestNews()
    {
        return $this->render();
    }
    public function actionAddsuccess()
    {
        return $this->render();
    }
    public function actionView()
    {
        return $this->render();
    }
    public function actionSearchresult()
    {
        return $this->render();
    }
    public function actionEditNews()
    {
        return $this->render();
    }
    public function actionUpdateNews()
    {
        if ($this->isPost) {
            $news = News::findByID($this->post->id);
            $title = $this->post->title ?? '';
            $text = $this->post->text ?? '';
            $short_text = $this->post->short_text ?? '';
            $isFeatured = $this->post->isFeatured ?? '';
            if (empty($title) || empty($text) || empty($short_text)) {
                $this->addErrorMessage('All fields are required');
                return $this->render('news/');
            }
            var_dump($news);
            $news['id'] = $_POST['id'];
            $news['title'] = $title;
            $news['text'] = $text;
            $news['short_text'] = $short_text;
            $news['isFeatured'] = $isFeatured;

            News::updateNews($news);
        }
        return $this->render('views/users/editnews.php');
    }
}