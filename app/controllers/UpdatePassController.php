<?php

namespace app\controllers;

use app\models\User;

class UpdatePassController extends AppController
{
    public function indexAction()
    {
        $user = new User();
        $user->update();
    }
}