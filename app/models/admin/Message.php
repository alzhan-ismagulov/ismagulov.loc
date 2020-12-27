<?php

namespace app\models\admin;

use ismagulova\libs\Pagination;

class Message extends AppModel
{
    public $attributes = [
        'id' => '',
        'sender' => '',
        'reciever' => '',
        'email' => '',
        'text' => '',
        'reading' => ''
    ];
}