<?php


namespace app\controllers;


use app\models\Request;
use ismagulova\libs\Pagination;

class RequestsController extends AppController
{
    public function addAction()
    {
        if (!empty($_POST)) {
            $requests = \R::dispense('requests');
            $requests->sender = $_POST['sender'];
            $requests->email = $_POST['email'];
            $requests->text = $_POST['text'];
            if ($requests = \R::store($requests)) {
                $_SESSION['success'] = 'Сообщение добавлено';
            } else {
                $_SESSION['error'] = 'Сообщение не доставлено';
            }
                redirect('');
        } else {
            $_SESSION['error'] = 'Никаких сообщений не передано';
        }
    }
}