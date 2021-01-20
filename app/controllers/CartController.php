<?php


namespace app\controllers;


use app\models\Cart;
use app\models\Order;
use app\models\User;

class CartController extends AppController
{
    public function addAction()
    {
        $id = !empty($_GET['id']) ? (int)$_GET['id'] : null;
        $qty = !empty($_GET['qty']) ? (int)$_GET['qty'] : null;
        if ($id){
            $course = \R::findOne('courses', 'id = ?', [$id]);
            if (!$course){
                return false;
            }
        }
        $cart = new Cart();
        $cart->addToCart($course, $qty);
        if ($this->isAjax()){
            $this->loadView('cart_modal');
        }
        redirect();
    }

    public function showAction()
    {
        $this->loadView('cart_modal');
    }

    public function deleteAction()
    {
        $id = !empty($_GET['id']) ? $_GET['id'] : null;
        if (isset($_SESSION['cart'][$id])){
            $cart = new Cart();
            $cart->deleteItem($id);
        }
        if ($this->isAjax()){
            $this->loadView('cart_modal');
        }
        redirect();
    }

    public function clearAction()
    {
        unset($_SESSION['cart']);
        unset($_SESSION['cart.qty']);
        unset($_SESSION['cart.sum']);
        $this->loadView('cart_modal');
    }

    public function viewAction()
    {
        if (!isset($_SESSION['user'])){
            redirect(PATH . '/signin');
        }
        $this->setMeta('Корзина');
    }

    public function checkoutAction()
    {
//            сохранение заказа
        $data['user_id'] = isset($user_id) ? $user_id : $_SESSION['user']['id'];
        $data['note'] = !empty($_POST['note']) ? $_POST['note'] : '';
        $user_email = isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : $_POST['email'];
        $course_title = $_SESSION['course_title'];
        $order_id = Order::saveOrder($data);
        Order::mailOrder($order_id, $user_email, $course_title);
        redirect();
    }
}