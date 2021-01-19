<?php

namespace app\models;

use ismagulova\App;

class Cart extends AppModel
{
    public function addToCart($course, $qty = 1)
    {
        //Для выбора валют
//        if (!isset($_SESSION['cart.currency'])){
//            $_SESSION['cart.currency'] = App::$app->getProperty('currency');
//        }
        $id = $course->id;
        $title = $course->name;
        $price = $course->price;
        
        if (isset($_SESSION['cart'][$id])){
            $_SESSION['cart'][$id]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$id] = [
                'qty' => $qty,
                'title' => $title,
                'price' => $price,
            ];
        }
        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;

        if (!isset($_SESSION['cart.sum'])) {
            $_SESSION['cart.sum'] = $price;
        } else {
            $_SESSION['cart.sum'] += $price;
        }
    }
}