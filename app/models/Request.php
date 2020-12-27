<?php

namespace app\models;

class Request extends AppModel
{
    public $attributes = [
      'sender' => '',
      'email' => '',
      'text' => '',
    ];
}