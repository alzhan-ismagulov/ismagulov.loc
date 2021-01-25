<?php

namespace app\controllers;

use app\models\admin\Course;
use ismagulova\Cache;

class MainController extends AppController
{
    public $layout = 'main';
//    public $layout = 'uikit';

    public function indexAction()
    {
        $courses = new Course();
        $courses = \R::getAll("SELECT courses.id, courses.name, courses.description, courses.price from courses WHERE courses.status = '1'");

        $this->set(compact("courses"));
        $this->setMeta('Главная страница', 'Курсы по финансовой грамотности', '');
    }
}