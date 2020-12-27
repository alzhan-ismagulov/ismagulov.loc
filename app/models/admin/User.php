<?php

namespace app\models\admin;

class User extends AppModel
{
    public $attributes = [
        'name' => '',
        'email' => '',
        'password' => '',
        'phone' => '',
        'token' => ''
    ];

    public $rules = [
        'required' => [
            ['name'],
            ['email'],
            ['password'],
            ['phone'],
        ],
        'email' => [
            ['email'],
        ],
        'lengthMin' => [
            ['password', 6],
        ]
    ];

    public function add()
    {
        if(!empty($_POST)){
            $user = new User();
            $data = $_POST;
            $user->load($data);
            if(!$user->validate($data) || !$user->checkUnique()){
                $user->getErrors();
                $_SESSION['form_data'] = $data;
            }else{
                $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
                $ip = $_SERVER['REMOTE_ADDR'];
                $user->attributes['ip'] = $ip;
                if($user->save('users')){
                    $_SESSION['success'] = 'Новый пользователь зарегистрирован';
                    redirect(ADMIN . '/users');
                } else {
                    $_SESSION['error'] = 'Ошибка!';
                    redirect('/');
                }
            }
        }
    }

    public function edit()
    {
        restrictArea();
        restrictUser();
        if (!empty($_POST)) {
            $user = new Lesson();
            $data = $_POST;
            $user->load($data);
            $user_id = $_POST['id'];
            $user = \R::findOne('users', 'id = ?', [$user_id]);
//            $user->course = $_POST['course'];
//            $user->title = $_POST['title'];
//            $user->description = $_POST['description'];
            if (\R::store($user)) {
                $_SESSION['success'] = 'Ваш пользователь обновлен!';
                redirect(ADMIN . '/users');
            } else {
                $_SESSION['error'] = 'Не удалось обновить пользователя!';
                redirect('');
            }
        }
    }

    public function checkUnique()
    {
        $user = \R::findOne('users', 'email = ? OR phone = ? ', [$this->attributes['email'],
            $this->attributes['phone']]);
        if ($user) {
            if ($user->email == $this->attributes['email']) {
                $this->errors['unique'][] = 'Этот email уже занят';
            }
            if ($user->phone == $this->attributes['phone']) {
                $this->errors['unique'][] = 'Этот телефон уже использован';
            }
            return false;
        }
        return true;
    }
}