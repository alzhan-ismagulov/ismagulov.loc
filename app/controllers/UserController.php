<?php

namespace app\controllers;

use app\models\User;
use ismagulov\libs\Pagination;

class UserController extends AppController {

    public $layout = 'user';

    public function indexAction()
    {

    }

    public function editAction()
    {
        restrictArea();
        if(!empty($_POST)) {
            $login = $_SESSION['user']['login'];
            $user = \R::findOne('users', 'login = ?', [$login]);
            $user->login = $_SESSION['user']['login'];
            $user->surname = $_POST['surname'];
            $user->name = $_POST['name'];
            $user->phone = $_POST['phone'];
            $user->age = $_POST['age'];
            $user->profession = $_POST['profession'];
            $user->city = $_POST['city'];
            $user->attributes['status'] = $_SESSION['user']['status'];
            $password = h($_POST['password']);
            $user->password = password_hash($password, PASSWORD_DEFAULT);
            $user->modified = date('Y-m-d H:i:s');
            $ip = $_SERVER['REMOTE_ADDR'];
            $user->attributes['ip'] = $ip;
            if (\R::store($user)) {
                $_SESSION['success'] = 'Ваш профиль обновлен!';
                redirect(PATH . 'user/profile');
            } else {
                $_SESSION['error'] = 'Не удалось обновить профиль!';
                redirect('');
            }
        }
        $user_id = $_SESSION['user']['id'];
        $user = \R::getRow('SELECT `users`.`id`,
                                        `users`.`login`,
                                        `users`.`surname`,
                                        `users`.`name`,
                                        `users`.`middle_name`,
                                        `users`.`email`,
                                        `users`.`phone`,
                                        `users`.`gender`,
                                        `users`.`age`,
                                        `users`.`profession`,
                                        `users`.`city`,
                                        `users`.`role`,
                                        `users`.`status`,
                                        `users`.`created`,
                                        `users`.`modified`,
                                        `users`.`ip`
                                FROM `users`
                                WHERE `users`.`id`
                                LIKE ?
                                LIMIT 1', [$user_id]);
        if (!$user){
            throw new \Exception('Страница не найдена', 404);
        }

        $this->setMeta("Редактирование пользователя");
        $this->set(compact('user'));
    }

    public function profileAction()
    {
        restrictArea();
        $user_id = $_SESSION['user']['id'];
        $user = \R::getRow('SELECT `users`.* 
                                FROM `users`
                                WHERE `users`.`id` 
                                LIKE ? 
                                LIMIT 1', [$user_id]);
        if (!$user){
            throw new \Exception('Страница не найдена', 404);
        }

        $this->set(compact('user'));
        $this->setMeta('Профиль пользователя');
    }

    public function signupAction(){
        $user = new User();
        $user->signup();
        $this->setMeta('Регистрация');
    }

    public function loginAction(){
        if(!empty($_POST)){
            $user = new User();
            if($user->login()){
                if(User::isAdmin()){
                    $_SESSION['success'] = 'Вы успешно авторизованы';
//                    redirect(ADMIN);
                    redirect(ADMIN);
                } else {
                    $_SESSION['success'] = 'Вы успешно авторизованы';
//                    redirect(PATH . '/privat');
                    redirect(PATH . '/user');
                }
            }else{
                $_SESSION['error'] = 'Логин/пароль введены неверно';
                redirect('/');
            }
        }
        $this->setMeta('Вход');
    }

    public function logoutAction(){
//        if(isset($_SESSION['user'])) unset($_SESSION['user']);
        if(isset($_SESSION['user'])) unset($_SESSION['user']); unset($_SESSION['reciever']);
        redirect('/');
    }

    public function activationAction()
    {
        $user = new User();
        $user->activation();
    }

    public function recoverAction()
    {
        $user = new User();
        $user->recover();
        $this->setMeta('Восстановление пароля');
    }

    public function updateAction()
    {
        $user = new User();
        $user->update();
        $this->setMeta('Обновление пароля');
    }
}