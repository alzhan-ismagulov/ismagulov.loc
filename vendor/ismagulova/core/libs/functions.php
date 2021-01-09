<?php
function debug($arr, $die = false){
    echo '<pre>' . print_r($arr, true) . '</pre>';
    if($die) die;
}
//    Дерево в HTML
function comments_to_string($comments){
    foreach ($data as $item){
        $string .= comments_to_template($item);
    }
    return $string;
}

function comments_to_template($comments){
    ob_start();
    include 'comment_template.php';
    return ob_get_clean();
}

function redirect($http = false){
    if($http){
        $redirect = $http;
    }else{
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    }
    header("Location: $redirect");
    exit;
}

function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

function alertMessage()
{
    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
        echo $_SESSION['error'];
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
        echo '<span aria-hidden="true">&times;</span>';
        echo '</button>';
        echo '</div>';
        unset($_SESSION['error']);
    } else {
        if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
            echo $_SESSION['success'];
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
            echo '<span aria-hidden="true">&times;</span>';
            echo '</button>';
            echo '</div>';
            unset($_SESSION['success']);
        }
    }
}

function mapTree($dataset){
    $tree = array();
    foreach ($dataset as $id => &$node){
        if(!$node['parent']){
            $tree[$id] = &$node;
        } else {
            $dataset[$node['parent']]['childs']['id'] = &$node;
        }
    }
    return $tree;
}

function restrictArea(){
    if (!isset($_SESSION['user'])){
        $_SESSION['error'] = 'Вам нужно войти в систему';
        redirect(PATH . '/signin');
    }
}

function restrictUser(){
    if(!isset($_SESSION['user'])){
        redirect('signin');
    }
    if ($_SESSION['user']['role'] == 'user'){
        $_SESSION['error'] = 'Вы не администратор';
        redirect(PATH . '/user');
    }
}

//Функция для загрузки файлов в контроллере MessagesController
function uploadFile($name, $path){
    if(isset($_SESSION['files']) && count($_SESSION['files']) >= 10){
        $res = array("answer" => "error", "error" => "Вы не можете загружать больше файлов");
        exit(json_encode($res));
    }
    $ext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES[$name]['name']));
    $allow_ext = array('jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx');
    if($_FILES[$name]['size'] > 4194304){
        $res = array("error" => "Ошибка! Максимальный вес файла - 4 Мб.");
        exit(json_encode($res));
    }
    if($_FILES[$name]['error']){
        $res = array("answer" => "error", "error" => "Ошибка! Возможно, файл слишком большой.");
        exit(json_encode($res));
    }
    if(!in_array($ext, $allow_ext)){
        $res = array("answer" => "error", "error" => "Разрешены к загрузке - .gif, .jpg, .jpeg, .png, .pdf, doc, docx, xls, xlsx, ppt, pptx");
        exit(json_encode($res));
    }
    $new_name = sha1(uniqid()) . ".$ext";
    $old_name = $_FILES[$name]['name'];
    $uploadfile = $path.$old_name;

    if(@move_uploaded_file($_FILES[$name]['tmp_name'], $path.$new_name)){
        $_SESSION['file'][] = $old_name;
        $_SESSION['alias'][] = $new_name;
        return true;
    }
    return false;
}

function removeFiles($path){
    $files = array_diff(scandir($path, SCANDIR_SORT_DESCENDING), ['..', '.']);
    if($files){
        foreach($files as $file){
            if( (time() - filemtime($path . $file)) >= 86400 ){
                @unlink($path . $file);
            }
        }
    }
}

function load($data){
    foreach ($_POST as $k => $v){
        if (array_key_exists($k, $data)){
            $data[$k] = $v;
        }
    }
    return $data;
}

function save($table, $data){
    $table = R::dispense($table);
    foreach ($data as $k => $v){
        $table->$k = $v;
    }
    return R::store($table);
}