<?php

namespace app\models\admin;


class Stream extends AppModel
{
    public $attributes = [
        'courses' => '',
        'lessons' => '',
    ];

    public static function add()
    {
        \R::dispense('stream');
        $stream = new Stream();
        $stream->courses = $_POST['name'];
        $stream->lessons = $_POST['lessons'];
        \R::store('stream');
    }
}