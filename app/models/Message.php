<?php


namespace app\models;


class Message extends AppModel
{
    public $attributes = [
        'sender' => '',
        'reciever' => '',
        'email' => '',
        'text' => '',
        'files' => '',
    ];
}