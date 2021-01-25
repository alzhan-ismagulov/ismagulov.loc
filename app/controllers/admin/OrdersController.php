<?php


namespace app\controllers\admin;


use ismagulova\libs\Pagination;

class OrdersController extends AppController
{
    public function indexAction()
    {
        restrictArea();
        restrictUser();
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 10;
        $count = \R::count('orders');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();

        $orders = \R::getAll("SELECT 
                                    orders.id,
                                    orders.user_id, 
                                    orders.status, 
                                    orders.created, 
                                    orders.modified,
                                    users.name,
                                    ROUND(SUM(order_course.price), 2) AS sum
                                    FROM orders 
                                    JOIN users
                                    ON orders.user_id = users.id
                                    JOIN order_course
                                    ON orders.id = order_course.order_id
                                    GROUP BY orders.id 
                                    ORDER BY orders.id ASC
                                    LIMIT $start, $perpage");
        $this->set(compact('orders', 'pagination', 'count'));
        $this->setMeta('Список заказов');
    }

    public function viewAction()
    {
        $order_id = $this->getRequestID();
        $order = \R::getRow("SELECT 
                                    orders.*,
                                    users.name,
                                    ROUND(SUM(order_course.price), 2) AS sum
                                    FROM orders 
                                    JOIN users
                                    ON orders.user_id = users.id
                                    JOIN order_course
                                    ON orders.id = order_course.order_id
                                    WHERE orders.id = ?                                    
                                    GROUP BY orders.id 
                                    ORDER BY orders.id ASC
                                    LIMIT 1", [$order_id]);
        if (!$order){
            throw new \Exception('Страница не надена', 404);
        }

        $order_course = \R::findAll('order_course', "order_id = ?", [$order_id]);

        $this->setMeta("Заказ № {$order_id}");
        $this->set(compact('order', 'order_course'));
    }

    public function changeAction()
    {
        $order_id = $this->getRequestID();
        $status = !empty($_GET['status']) ? '1' : '0';
        $order = \R::load('orders', $order_id);
        if (!$order){
            throw new \Exception('Страница не надена', 404);
        }
        $order->status = $status;
        $order->modified = date("Y-m-d H:i:s");
        if(\R::store($order)){
            $_SESSION['success'] = "Изменения сохранены";
            redirect();
        } else {
            $_SESSION['error'] = "Изменения не сохранены";
            redirect();
        }
    }

    public function deleteAction()
    {
        $order_id = $this->getRequestID();
        $order = \R::load('orders', $order_id);
        if(\R::trash($order)){
            $_SESSION['success'] = "Заказ удалён";
            redirect(ADMIN . '/orders');
        } else {
            $_SESSION['error'] = "Заказ не удалён";
            redirect();
        }
    }
}