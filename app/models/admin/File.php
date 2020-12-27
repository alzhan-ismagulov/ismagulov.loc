<?php


namespace app\models\admin;
use ismagulova\libs\Pagination;


class File extends AppModel
{
    public $attributes = [
        'name' => ''
    ];

    public function add()
    {
        restrictArea();
        restrictUser();
    }

    public function index()
    {

    }

    public function delete()
    {
        restrictArea();
        restrictUser();
    }

    public function upload()
    {
        restrictArea();
        restrictUser();
    }
}
