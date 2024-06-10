<?php

namespace controllers;

use core\Controller;
use core\Core;
use core\Template;
use models\Images;
use models\News;
use models\Users;

class UsersController extends Controller
{
    public function actionLogin()
    {
        if (Users::isUserLogged())
            return $this->redirect('/');
        if ($this->isPost) {
            $user = Users::loginVerification($this->post->login, $this->post->password);

            if (!is_string($user)) {
                Users::loginUser($user);
                $this->redirect('/');
                die;
            } else {
                $this->addErrorMessage($user);
                return $this->render();
            }
        }
        return $this->render();
    }



    public function actionEditProfile()
    {
        $user = Core::get()->db->selectById('users', Core::get()->session->get('user')['id']);
        if (!$user) {
            return $this->redirect('/users/login');
        }
        return $this->render();
    }


    public function actionUpdateProfile()
    {
        if ($this->isPost) {
            $user = Users::GetLoggedInUser();
            if (!$user) {
                return $this->redirect('/users/login');
            }

            $login = $this->post->login ?? '';
            $firstname = $this->post->firstname ?? '';
            $lastname = $this->post->lastname ?? '';

            if (empty($login) || empty($firstname) || empty($lastname)) {
                $this->addErrorMessage('All fields are required');
                return $this->render('views/users/editprofile.php');
            }

            $user['login'] = $login;
            $user['firstname'] = $firstname;
            $user['lastname'] = $lastname;

            Users::UpdateUser($user);

            Users::LoginUser($user);

            return $this->redirect('/users/profile');
        }
        return $this->render('views/users/editprofile.php');
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
            if (!$this->isErrorMessagesExists()) {
                Users::RegisterUser($this->post->login, $this->post->password, $this->post->lastname, $this->post->firstname);
                Images::RegisterImage($this->post->picture, $this->post->news_id, 'pfp');
                return $this->redirect('/site/updatesuccess');
            }
        }
        return $this->render();
    }

    public function actionUpdatePassword()
    {
        if ($this->isPost) {
            $user = Users::GetLoggedInUser();
            if (!$user) {
                return $this->redirect('/users/login');
            }

            $currentPassword = $this->post->current_password;
            $newPassword = $this->post->new_password;
            $confirmNewPassword = $this->post->confirm_new_password;

            if (empty($currentPassword) || empty($newPassword) || empty($confirmNewPassword)) {
                $this->addErrorMessage('All fields are required.');
                return $this->render('views/users/editprofile.php');
            }

            if ($newPassword !== $confirmNewPassword) {
                $this->addErrorMessage('New passwords do not match.');
                return $this->render('views/users/editprofile.php');
            }

            if (!password_verify($currentPassword, $user['password'])) {
                $this->addErrorMessage('Current password is incorrect.');
                return $this->render('views/users/editprofile.php');
            }

            $user['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
            Users::UpdateUserPassword($user);

            return $this->redirect('/site/updatesuccess');
        }

        return $this->render('views/users/editprofile.php');
    }

    public function actionProfile()
    {
        if (!Users::IsUserLogged()) {
            return $this->redirect('/users/login');
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
