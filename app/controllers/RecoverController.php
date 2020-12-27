<?php

namespace app\controllers;

use app\models\User;

class RecoverController extends AppController
{
    public $layout = 'signin';

    public function indexAction()
    {
        $user = new User();
        $user->recover();
    }
}