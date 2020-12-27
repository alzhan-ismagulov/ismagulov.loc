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
            $requests->sender = h($_POST['sender']);
            $requests->email = h($_POST['email']);
            $requests->text = h($_POST['text']);
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