<?php

namespace models;

use core\Core;
use core\Model;
use Exception;
use models\Images;

/**
 * @property int $id Id
 * @property string $login login
 * @property string $password password
 * @property string $firstname firstname
 * @property string $lastname lastname
 * @property string $role role
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
    public static function loginVerification($login, $password)
    {
        $searchCriteria = ['login' => $login];
        $rows = self::findByCondition($searchCriteria);

        if (!empty($rows)) {
            $user = is_object($rows[0]) ? $rows[0] : (object)$rows[0];

            if (isset($user->password) && password_verify($password, $user->password)) {
                return $user;
            } else {
                return 'Wrong Password';
            }
        } else {
            return 'No User Found';
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
    public static function IsUserAdmin()
    {
        $user = Core::get()->session->get('user');
        if (isset($user) && isset($user['role']) && $user['role'] == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    public static function LoginUser($user)
    {
        Core::get()->session->set('user', (array)$user);
    }
    public static function UpdateUserPassword($user)
    {
        $db = Core::get()->db;
        $db->update(self::$tableName, [
            'password' => $user['password']
        ], ['id' => $user['id']]);
    }
    public static function GetAllUsersWithRoleUser()
    {
        $db = Core::get()->db;
        return $db->select(self::$tableName, '*', ['role' => 'user']);
    }

    public static function PromoteUserToAdmin($userId)
    {
        $db = Core::get()->db;
        $db->update(self::$tableName, ['role' => 'admin'], ['id' => $userId]);
    }
    public static function LogoutUser()
    {
        Core::get()->session->remove('user');
    }
    public static function RegisterUser($login, $password, $lastname, $firstname, $role)
    {
        $user = new Users();
        $image = new Images();
        $user->login=$login;
        $user->password=password_hash($password, PASSWORD_DEFAULT);
        $user->lastname=$lastname;
        $user->firstname=$firstname;
        $user->role = 'user';
        $user->save();
    }
    public static function GetLoggedInUser()
    {
        if (!self::IsUserLogged()) {
            return null;
        }
        return Core::get()->db->selectById('users', Core::get()->session->get('user')['id']);
    }

}
