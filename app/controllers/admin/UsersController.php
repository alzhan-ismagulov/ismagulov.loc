<?php


namespace app\controllers\admin;

use app\models\admin\User;
use ismagulova\libs\Pagination;

class UsersController extends AppController
{
    public function indexAction()
    {
        restrictArea();
        restrictUser();
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 10;
        $count = \R::count('lessons');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();
        $users = \R::getAll("SELECT 
                        users.id,
                        users.name,
                        users.email,
                        users.password,
                        users.phone,
                        users.token,
                        users.ip,
                        users.created,
                        users.role,
                        users.status,
                        users.recovery_time
                        FROM users
                        ORDER  BY id ASC 
                        LIMIT $start, $perpage");
        $this->setMeta('Список пользователей');
        $this->set(compact('users', 'pagination', 'count'));
    }

    public function addAction(){
        restrictArea();
        restrictUser();
        $user = new User();
        $user->add();
        $this->setMeta('Регистрация');
    }

    public function viewAction()
    {
        restrictArea();
        restrictUser();
        $user_id = $_GET['id'];
        $user = \R::getRow("SELECT 
                                    users.id,
                                    users.name,
                                    users.email,
                                    users.password,
                                    users.phone,
                                    users.token,
                                    users.ip,
                                    users.created,
                                    users.role,
                                    users.status,
                                    users.recovery_time
                                    FROM users 
                                    WHERE `users`.`id` = $user_id
                                    LIMIT 1");
        if (!$user){
            throw new \Exception('Пользователь не найден', 404);
        }
        $this->set(compact('user'));
        $this->setMeta('Просмотр пользователя');
    }

//    public function editAction()
//    {
//        restrictArea();
//        restrictUser();
//        $user = new User();
//        $user->edit();
//        $user_id = $_GET['id'];
//        $user = \R::getRow("SELECT
//                        users.id,
//                        users.name,
//                        users.email,
//                        users.password,
//                        users.phone,
//                        users.token,
//                        users.ip,
//                        users.created,
//                        users.role,
//                        users.status,
//                        users.recovery_time
//                        FROM users
//                        WHERE users.id = $user_id");
//        if (!$user) {
//            $_SESSION['error'] = 'Такого пользователя нет';
//            redirect(ADMIN . '/users/');
//        }
//
//        $this->setMeta("Редактирование пользователя");
//        $this->set(compact('user'));
//    }

    public function deleteAction()
    {
        restrictArea();
        restrictUser();
        $user_id = $this->getRequestID();
        $user = \R::load('users', $user_id);
        \R::trash($user);
        $_SESSION['success'] = 'Пользователь удален';
        redirect(ADMIN . '/users');
    }

    public function statusAction()
    {
        $user_id = $this->getRequestID();
        $status = ($_GET['status']);
        $users = \R::load('users', $user_id);
        if (!$users){
            throw new \Exception('Страница не найдена', 404);
        }
        $users->status = $status;
        \R::store($users);
        $_SESSION['success'] = 'Изменения сохранены';
        redirect(ADMIN . '/users');
    }

    public function roleAction()
    {
        $user_id = $this->getRequestID();
        $role = ($_GET['role']);

        $users = \R::load('users', $user_id);
        if (!$users){
            throw new \Exception('Страница не найдена', 404);
        }
        $users->role = $role;
        \R::store($users);
        $_SESSION['success'] = 'Изменения сохранены';
        redirect(ADMIN . '/users');
    }
}