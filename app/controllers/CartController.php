<?php


namespace app\controllers;


use app\models\Cart;
use app\models\Order;
use app\models\Request;
use app\models\User;
use ismagulova\App;

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

//        Данные для оплаты
        if (!empty($_POST['pay'])){
            self::setPaymentData($order_id);
        }
        Order::mailOrder($order_id, $user_email, $course_title);
        if (!empty($_POST['pay'])){
            redirect(PATH.'/payment/form.php');
        }
        redirect();
    }

    public static function setPaymentData($order_id){
        if (isset($_SESSION['payment'])) unset($_SESSION['payment']);
        $_SESSION['payment']['id'] = $order_id;
        //Для валюты
//        $_SESSION['payment']['curr'] = $_SESSION['cart.currency']['code'];
        $_SESSION['payment']['sum'] = $_SESSION['cart.sum'];
    }

    public function paymentAction()
    {
        if (empty($_POST)){
            die;
        }

        $dataSet = $_POST;

        unset($dataSet['ik_sign']);
        ksort($dataSet, SORT_STRING);
        array_push($dataSet, App::$app->getProperty('ik_key'));//ПОменять ключ на реальный в файле params.php
        $signString = implode(':', $dataSet);
        $sign = base64_encode(md5($signString, true));

        $order = \R::load('orders', (int)$dataSet['ik_pm_no']);
        if (!$order) die;
        if ($dataSet['ik_ko_id'] != App::$app->getProperty('ik_id') ||
            $dataSet['ik_inv_st'] != 'success' ||
            $dataSet['ik_am'] != $order->sum ||
            $sign != $_POST['ik_sign']){
            die;
        }
        $order->status = '1';
        \R::store($order);
        die;
    }
}