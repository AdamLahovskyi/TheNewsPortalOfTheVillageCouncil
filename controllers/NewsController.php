<?php

namespace controllers;

use core\Controller;
use core\Core;
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
                    $short_text,
                    date("Y-m-d"),
                    Users::GetLoggedInUser()['login'],
                    $isFeatured);
                return $this->jsonResponse(['success' => true]);
            } else {
                return $this->jsonResponse(['success' => false, 'error_message' => $this->getErrorMessage()]);
            }
        }
        return $this->render();
    }

    private function jsonResponse($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
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
            $this->clearErrorMessage();
            $newsId = $this->post->id;
            if ($newsId === null) {
                $this->addErrorMessage('News ID is missing.');
                return $this->render('news/edit');
            }
            $news = News::findByID($newsId);
            if (!$news) {
                $this->addErrorMessage('News not found.');
                return $this->render('news/view/'.$newsId);
            }
            $title = $news->post->title ?? '';
            $text = $news->post->text ?? '';
            $short_text = $news->post->short_text ?? '';
            $isFeatured = $news->post->isFeatured ?? '0';

            if (empty($title) || empty($text) || empty($short_text)) {
                $this->addErrorMessage('All fields are required');
                return $this->render('news/edit');
            }

            $news['title'] = $title;
            $news['text'] = $text;
            $news['short_text'] = $short_text;
            $news['isFeatured'] = $isFeatured;

            News::updateNews($news);
            return $this->redirect('/news');
        }
        return $this->render();
    }
}
