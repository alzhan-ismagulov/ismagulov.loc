<?php

namespace app\models;

use ismagulova\App;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class Order extends AppModel
{
    public static function saveOrder($data)
    {
        $order = \R::dispense('order');
        $order->user_id = $data['user_id'];
        $order->note = $data['note'];
//        $order->currency = $_SESSION['cart.currency']['code'];
        $order_id = \R::store($order);
        self::saveOrderCourse($order_id);
        return $order_id;
    }

    public static function saveOrderCourse($order_id){
        $sql_part = '';
        foreach ($_SESSION['cart'] as $course_id => $course){
            $sql_part .= "($order_id, $course_id, {$course['qty']}, '{$course['title']}', {$course['price']}),";
        }
        $sql_part = rtrim($sql_part, ',');
        \R::exec("INSERT INTO order_course (order_id, course_id, qty, title, price) VALUES $sql_part");
    }

    public static function mailOrder($order_id, $user_email, $course_title){
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
        require APP . '/views/Mail/mail_order.php';
        $body_user = ob_get_clean();
        $body_admin = "Зарегистрирован заказ №{$order_id}. Заказчик: {$user_email}";
        //Это тема письма
        $site_name = App::$app->getProperty('site_name');

        $message_user = (new \Swift_Message("Заказ №{$order_id} на сайте {$site_name}"))
            ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('site_name')])
            ->setTo($user_email)
            ->setBody($body_user, 'text/html');

        $message_admin = (new \Swift_Message("Зарегистрирован новый заказ на курс."))
            ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('site_name')])
            ->setTo(App::$app->getProperty('admin_email'))
            ->setBody($body_admin, 'text/html')
        ;
        //Send the message
        $result = $mailer->send($message_user);
        $result = $mailer->send($message_admin);
        unset($_SESSION['cart']);
        unset($_SESSION['cart.qty']);
        unset($_SESSION['cart.sum']);
        unset($_SESSION['course_title']);
        $_SESSION['success'] = 'Спасибо за Ваш заказ. После оплаты Вы можете увидеть свой курс в личном кабинете в разделе "Мои курсы"';
    }
}