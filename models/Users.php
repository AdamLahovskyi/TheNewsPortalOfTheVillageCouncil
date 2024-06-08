<?php

namespace models;

use core\Core;
use core\Model;
use models\Images;

/**
 * @property int $id Id
 * @property string $login login
 * @property string $password password
 * @property string $firstname firstname
 * @property string $lastname lastname
 */
class Users extends \core\Model
{
    public static $tableName = 'users';

    public static function FindByLoginAndPassword($login, $password)
    {
        $rows = self::findByCondition(['login' => $login, 'password' => $password]);
        if (!empty($rows)) {
            return $rows[0];
        } else {
            return null;
        }
    }
    public static function FindByLogin($login)
    {
        $rows = self::findByCondition(['login' => $login]);
        if (!empty($rows)) {
            return $rows[0];
        } else {
            return null;
        }
    }
    public static function UpdateUser($user)
    {
        $db = Core::get()->db;
        $db->update(self::$tableName, [
            'login' => $user['login'],
            'firstname' => $user['firstname'],
            'lastname' => $user['lastname']
        ], ['id' => $user['id']]);
    }

    public static function IsUserLogged()
    {
        return !empty(Core::get()->session->get('user'));
    }
    public static function LoginUser($user)
    {
        Core::get()->session->set('user', $user);
    }
    public static function LogoutUser()
    {
        Core::get()->session->remove('user');
    }
    public static function RegisterUser($login, $password, $lastname, $firstname)
    {
        $user = new Users();
        $image = new Images();
        $user->login=$login;
        $user->password=$password;
        $user->lastname=$lastname;
        $user->firstname=$firstname;
        $user->save();
    }
    public static function GetLoggedInUser()
    {
        if (!self::IsUserLogged()) {
            return null;
        }

        return Core::get()->session->get('user');
    }

}