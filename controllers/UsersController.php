<?php

namespace controllers;

use core\Controller;
use core\Core;
use core\Template;
use models\News;
use models\Users;

class UsersController extends Controller
{
    public function actionLogin()
    {
        if (Users::IsUserLogged()) {
            return $this->redirect('/');
        }
        if ($this->isPost) {
            $user = Users::FindByLoginAndPassword($this->post->login, $this->post->password);
            if (!empty($user)) {
                Users::LoginUser($user);
                return $this->redirect('/');
            } else {
                $this->addErrorMessage('Wrong Login or Password');
            }
        }
        return $this->render();
    }

    public function actionRegister()
    {
        if ($this->isPost) {
            $this->clearErrorMessage();

            $login = $this->post->login ?? '';
            $password = $this->post->password ?? '';
            $password2 = $this->post->password2 ?? '';
            $firstname = $this->post->firstname ?? '';
            $lastname = $this->post->lastname ?? '';

            if (empty($login)) {
                $this->addErrorMessage('Login Can`t Be Empty');
            } else {
                $user = Users::FindByLogin($login);
                if (!empty($user)) {
                    $this->addErrorMessage('User Already Exists!');
                }
            }

            if (empty($password)) {
                $this->addErrorMessage('Password Can`t Be Empty');
            }

            if (empty($password2)) {
                $this->addErrorMessage('Repeat Password Can`t Be Empty');
            }

            if ($password !== $password2) {
                $this->addErrorMessage('Passwords Don\'t Match!');
            }

            if (empty($firstname)) {
                $this->addErrorMessage('Firstname Can`t Be Empty');
            }

            if (empty($lastname)) {
                $this->addErrorMessage('Lastname Can`t Be Empty');
            }
            if(!$this->isErrorMessagesExists()){
                Users::RegisterUser($this->post->login, $this->post->password, $this->post->lastname, $this->post->firstname);
                return $this->redirect('/users/registersuccess');
            }
        }
        return $this->render();
    }

    public function actionRegistersuccess()
    {
        return $this->render();
    }
    public function actionLogout()
    {
        Users::LogoutUser();
        return $this->redirect('/users/login');
    }
}