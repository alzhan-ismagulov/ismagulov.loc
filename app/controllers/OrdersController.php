<?php

namespace app\controllers;

use ismagulova\libs\Pagination;

class OrdersController extends AppController
{
    public function indexAction()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 10;
        $count = \R::count('feedbacks');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();
        $user_id = $_SESSION['user']['id'];
        $orders = \R::getAll('SELECT orders.* FROM orders WHERE orders.user_id = ?', [$user_id]);
        if (!$orders){
            $_SESSION['error'] = 'Ваших курсов не найдено';
        }

        $this->set(compact('orders', 'pagination'));
        $this->setMeta('Список курсов');
    }

    public function viewAction()
    {
        $order_id = $this->getRequestID();
        $user_id = $_SESSION['user']['id'];
        $order = \R::getRow("SELECT 
                                    orders.*,
                                    users.name,
                                    ROUND(SUM(order_course.price), 2) AS sum
                                    FROM orders 
                                    JOIN users
                                    ON orders.user_id = users.id
                                    JOIN order_course
                                    ON orders.id = order_course.order_id
                                    WHERE orders.id = ? AND orders.user_id = ?                                   
                                    GROUP BY orders.id 
                                    ORDER BY orders.id ASC
                                    LIMIT 1", [$order_id, $user_id]);
        if (!$order){
            $_SESSION['error'] = 'Извините, заказ не найден';
            redirect(PATH . '/orders');
//            throw new \Exception('Страница не надена', 404);
        }

        $order_course = \R::findAll('order_course', "order_id = ?", [$order_id]);

        $this->setMeta("Заказ № {$order_id}");
        $this->set(compact('order', 'order_course'));
    }

    public function deleteAction()
    {
        $order_id = $this->getRequestID();
        $order = \R::load('orders', $order_id);
        if ($order->status == '1'){
            $_SESSION['error'] = 'Извините, Вы не можете удалить оплаченный заказ';
            redirect(PATH . '/orders');
        } else {
            if(\R::trash($order)){
                $_SESSION['success'] = "Заказ удалён";
                redirect(PATH . '/orders');
            } else {
                $_SESSION['error'] = "Заказ не удалён";
                redirect();
            }
        }
    }
}