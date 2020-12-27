<?php

namespace app\controllers;

use app\models\User;

class SignUpController extends AppController
{
    public $layout = 'signin';

    public function indexAction()
    {
        $user = new User();
        $user->signup();
    }
}