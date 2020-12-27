<?php
namespace app\models;

use ismagulova\App;
use Swift_Mailer;
use Swift_SmtpTransport;

class User extends AppModel
{
    public $attributes = [
        'name' => '',
        'email' => '',
        'password' => '',
        'phone' => '',
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

    public function signup()
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
                $user->attributes['token'] = md5(time());
                $ip = $_SERVER['REMOTE_ADDR'];
                $user->attributes['ip'] = $ip;
                if($user->save('users')){
                    $user_email = isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : $_POST['email'];
                    $_SESSION['token'] = $user->attributes['token'];
                    User::sendActivationCode($user_email);
                    $_SESSION['success'] = 'Письмо с кодом активации отправлено на Вашу почту. Вам необходимо зайти в свою почту и активировать свой аккаунт';
                    unset($_SESSION['token']);
                    redirect('/privat');
                } else {
                    $_SESSION['error'] = 'Ошибка!';
                    unset($_SESSION['token']);
                    redirect('/');
                }
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

    public function login($isAdmin = false)
    {
        $email = !empty(trim($_POST['email'])) ? trim($_POST['email']) : null;
        $password = !empty(trim($_POST['password'])) ? trim($_POST['password']) : null;
        if ($email && $password) {
            if ($isAdmin) {
                $user = \R::findOne('users', "email = ? AND role = 'admin'", [$email]);
            } else {
                $user = \R::findOne('users', "email = ?", [$email]);
            }
            if ($user['status'] == 0){
                $_SESSION['error'] = "Вам нужно активировать свой аккаунт после регистрации. Либо Вы заблокированы администратором портала";
                redirect('/');
            }
            if ($user) {
                if (password_verify($password, $user->password)) {
                    foreach ($user as $k => $v) {
                        if ($k != 'password') $_SESSION['user'][$k] = $v;
                        if ($k != 'password') $_SESSION['email'][$k] = $v;
                    }
                    return true;
                }
            }
        }
        return false;
    }

    public function activation()
    {
        if (isset($_GET['token'])) {
            $token = h($_GET['token']);
            $user = \R::findOne('users', "token = ?", [$token]);
            if (!$user) {
                $_SESSION['error'] = "Ваш аккаунт уже активирован или Вы не зарегистрированы";
                redirect('/');
            } else {
                if ($user['status'] == '1') {
                    $user->token = '';
                    \R::store($user);
                    $_SESSION['error'] = "Ваш аккаунт уже активирован";
                    redirect('/');
                } else {
                    $user->status = '1';
                    $user->token = '';
                    \R::store($user);
                    $_SESSION['success'] = "Уважаемый, {$user['name']}. Ваш аккаунт активирован.";
                    $_SESSION['user'] = $user;
                }
                redirect(PATH.'/');
            }
        }
    }

    public static function sendActivationCode($user_email)
    {
        //Create Transport
        $transport = (new Swift_SmtpTransport(
            App::$app->getProperty('smtp_host'),
            App::$app->getProperty('smtp_port'),
            App::$app->getProperty('smtp_protocol')
        ))
            ->setUsername(App::$app->getProperty('smtp_login'))
            ->setPassword(App::$app->getProperty('smtp_password'));

        //Create new Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        //Create a message
        ob_start();
        require APP . '/views/Mail/mail.php';
        $body = ob_get_clean();
        $body_admin = "Зарегистрирован новый пользователь";
        //Это тема письма
        $site_name = App::$app->getProperty('site_name');
        $message_user = (new \Swift_Message('Успешная регистрация на сайте "' . $site_name . '"'))
            ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('site_name')])
            ->setTo($user_email)
            ->setBody($body, 'text/html');
        $message_admin = (new \Swift_Message("Зарегистрирован новый пользователь"))
            ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('site_name')])
            ->setTo(App::$app->getProperty('admin_email'))
            ->setBody($body_admin, 'text/html')
        ;
        //Send the message
        $result = $mailer->send($message_user);
        $result = $mailer->send($message_admin);
        unset($_SESSION['token']);
    }

    public function recover()
    {
        if (!empty($_POST)) {
            $user_email = $_POST['email'];
            $user = \R::findOne('users', "email = ?", [$user_email]);
            if ($user) {
                $user->token = md5(time());
                $user->recovery_time = time();
                \R::store($user);
                User::sendRecoveryMail($user);
                $_SESSION['success'] = 'Вам отправлено письмо для восстановления пароля';
                redirect('/');
            } else {
                $_SESSION['error'] = 'Пользователь не найден';
                redirect('/');
            }
        }
    }

    public function sendRecoveryMail($user)
    {
        //Create Transport
        $transport = (new Swift_SmtpTransport(
            App::$app->getProperty('smtp_host'),
            App::$app->getProperty('smtp_port'),
            App::$app->getProperty('smtp_protocol')
        ))
            ->setUsername(App::$app->getProperty('smtp_login'))
            ->setPassword(App::$app->getProperty('smtp_password'));

        //Create new Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        //Create a message
        ob_start();
        require APP . '/views/Mail/recovery_mail.php';
        $body = ob_get_clean();
        //Это тема письма
        $site_name = App::$app->getProperty('site_name');
        $message_user = (new \Swift_Message('Восстановление пароля на сайте "' . $site_name . '"'))
            ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('site_name')])
            ->setTo($user->email)
            ->setBody($body, 'text/html');

        //Send the message
        $result = $mailer->send($message_user);
        unset($_SESSION['token']);
    }

    public function update()
    {
//        if(isset($_POST)){
//            debug($_SESSION['token']);
//            debug($_POST);
//        }
        if(isset($_POST['password'])) {
            $password = h($_POST['password']);
            $repeat_password = h($_POST['repeat_password']);
            if ($password !== $repeat_password) {
                $_SESSION['error'] = 'Пароли не совпадают';
                redirect();
            } else {
                $token = $_SESSION['token'];
                $user = \R::findOne('users', 'token=?', [$token]);
                $user->password = password_hash($password, PASSWORD_DEFAULT);
                $user->token = '';
                $user->status = '1';
//                $user->modified = date('Y-m-d H:i:s');
                $user->recovery_time = time();
                if (\R::store($user)) {
                    $_SESSION['success'] = 'Ваш пароль обновлен!';
                    unset($_SESSION['token']);
                    redirect('/');
                } else {
                    $_SESSION['error'] = 'Не удалось обновить пароль!';
                    unset($_SESSION['token']);
                    redirect('/');
                }
            }
        }
//        if (isset($_GET['token'])) {
//            $token = $_GET['token'];
//                debug($token);
//            $user = \R::findOne('users', 'token = ?', [$token]);
//                debug($user);
//            if (!$user) {
//                $_SESSION['error'] = 'Такого пользователя не существует. Либо Вы не сделали восстановление пароля';
//                unset($_SESSION['token']);
//                redirect('/');
//            } else {
//                $user_token = $user->token;
//                if (!$user_token) {
//                    $_SESSION['error'] = 'Вы не выполнили процедуру восстановления пароля. Токен пользователя отсутствует в базе';
//                    redirect('/');
//                } else {
//                    $_SESSION['token'] = $token;
//                    $recovery_time = $user->recovery_time;
//                    $time_wait = 1200;
//                    $current_time = time();
//                    $result = $current_time - $recovery_time - $time_wait;
//                    if($current_time>$recovery_time+$time_wait){
//                        $_SESSION['error'] = 'Время для восстановления пароля вышло. Повторите процедуру';
//                        unset($_SESSION['token']);
//                        redirect('/');
//                    }
//                }
//            }
//        } else {
//            $_SESSION['error'] = 'Не выполнена процедура восстановления пароля';
//            redirect('/');
        }
//    }

    public static function checkAuth()
    {
        return isset($_SESSION['user']);
    }

    public static function isAdmin()
    {
        return (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin');
    }
}
