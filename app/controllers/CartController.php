<?php


namespace app\controllers;


use app\models\Cart;

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
}