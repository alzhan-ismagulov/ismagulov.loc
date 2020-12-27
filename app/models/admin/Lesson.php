<?php

namespace app\models\admin;

class Lesson extends \app\models\AppModel
{
    public $attributes = [
        'title' => '',
        'description' => '',
        'image' => ''
    ];

    public function edit()
    {
        restrictArea();
        restrictUser();
        if (!empty($_POST)) {
            $lesson = new Lesson();
            $data = $_POST;
            $lesson->load($data);
            $lesson_id = $_POST['id'];
            $lesson = \R::findOne('lessons', 'id = ?', [$lesson_id]);
            $lesson->title = $_POST['title'];
            $lesson->description = $_POST['description'];

            $ext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['userfile']['name'])); // расширение
                // картинки
                $types = array("image/gif", "image/png", "image/jpeg", "image/pjpeg", "image/x-png"); // массив допустимых расширений
                if ($_FILES['userfile']['size'] > 10737418) {
                    $_SESSION['error'] = "Ошибка. максимальный размер файла 1Мб!";
                    redirect();
                }
                if ($_FILES['userfile']['error']) {
                    $_SESSION['error'] = "Ошибка. Добавьте фотографию для урока";
                    redirect();
                }
                if (!in_array($_FILES['userfile']['type'], $types)) {
                    $_SESSION['error'] = "Допустимые расширения - .gif, .jpg, .png";
                    redirect();
                }
                $uploaddir = WWW . '/image/';
                $new_name = md5(time()) . ".$ext";
                $uploadfile = $uploaddir . $new_name;
                $lesson->image = $new_name;
                move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);

            if (\R::store($lesson)) {
                $_SESSION['success'] = 'Ваш урок обновлен!';
                redirect(ADMIN . '/lessons');
            } else {
                $_SESSION['error'] = 'Не удалось обновить урок!';
                redirect('');
            }
        }
    }

    public function checkUniqueLessons()
    {
        $lesson = \R::findOne('lessons', 'name = ?', [$this->attributes['name']]);
        if ($lesson) {
            if ($lesson->name == $this->attributes['name']) {
                $this->errors['unique'][] = 'Курс с таким названием уже существует';
            }
            return false;
        }
        return true;
    }

    public function change() //Активный - неактивный
    {
        $lesson_id = $_GET['id'];
        $status = ($_GET['status']);
        $lessons = \R::load('lessons', $lesson_id);
        if (!$lessons){
            throw new \Exception('Страница не найдена', 404);
        }
        $lessons->status = $status;
        \R::store($lessons);
        if($lessons->status == '0') {
            \R::exec("DELETE FROM streams WHERE streams.lessons = ?", [$lesson_id]);
            $_SESSION['success'] = 'Урок удалён из потоков';
        }
        $_SESSION['success'] = 'Изменения сохранены';
        redirect(PATH . '/admin/lessons');
    }

    public function getImg(){
        if(!empty($_SESSION['single'])){
            $this->attributes['image'] = $_SESSION['single'];
            unset($_SESSION['single']);
        }
    }

    public function uploadImg($name, $wmax, $hmax){
        $uploaddir = WWW . '/image/';
        $ext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES[$name]['name'])); // расширение картинки
        $types = array("image/gif", "image/png", "image/jpeg", "image/pjpeg", "image/x-png"); // массив допустимых расширений
        if($_FILES[$name]['size'] > 10737418){
            $res = array("error" => "Ошибка! Максимальный вес файла - 1 Мб!");
            exit(json_encode($res));
        }
        if($_FILES[$name]['error']){
            $res = array("error" => "Ошибка! Возможно, файл слишком большой.");
            exit(json_encode($res));
        }
        if(!in_array($_FILES[$name]['type'], $types)){
            $res = array("error" => "Допустимые расширения - .gif, .jpg, .png");
            exit(json_encode($res));
        }
        $new_name = md5(time()).".$ext";
        $uploadfile = $uploaddir.$new_name;
        if(@move_uploaded_file($_FILES[$name]['tmp_name'], $uploadfile)){
            $_SESSION['single'] = $new_name;
//            self::resize($uploadfile, $uploadfile, $wmax, $hmax, $ext);
            $res = array("file" => $new_name);
            exit(json_encode($res));
        }
    }

    /**
     * @param string $target путь к оригинальному файлу
     * @param string $dest путь сохранения обработанного файла
     * @param string $wmax максимальная ширина
     * @param string $hmax максимальная высота
     * @param string $ext расширение файла
     */
    public static function resize($target, $dest, $wmax, $hmax, $ext){
        list($w_orig, $h_orig) = getimagesize($target);
        $ratio = $w_orig / $h_orig; // =1 - квадрат, <1 - альбомная, >1 - книжная

        if(($wmax / $hmax) > $ratio){
            $wmax = $hmax * $ratio;
        }else{
            $hmax = $wmax / $ratio;
        }

        $img = "";
        // imagecreatefromjpeg | imagecreatefromgif | imagecreatefrompng
        switch($ext){
            case("gif"):
                $img = imagecreatefromgif($target);
                break;
            case("png"):
                $img = imagecreatefrompng($target);
                break;
            default:
                $img = imagecreatefromjpeg($target);
        }
        $newImg = imagecreatetruecolor($wmax, $hmax); // создаем оболочку для новой картинки

        if($ext == "png"){
            imagesavealpha($newImg, true); // сохранение альфа канала
            $transPng = imagecolorallocatealpha($newImg,0,0,0,127); // добавляем прозрачность
            imagefill($newImg, 0, 0, $transPng); // заливка
        }

        imagecopyresampled($newImg, $img, 0, 0, 0, 0, $wmax, $hmax, $w_orig, $h_orig); // копируем и ресайзим изображение
        switch($ext){
            case("gif"):
                imagegif($newImg, $dest);
                break;
            case("png"):
                imagepng($newImg, $dest);
                break;
            default:
                imagejpeg($newImg, $dest);
        }
        imagedestroy($newImg);
    }

    public function upload($name){
        $uploaddir = WWW . '/uploads/';
        //массив допустимых расширений
        $ext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES[$name]['name'])); // расширение картинки
        $types = array("image/gif", "image/png", "image/jpeg", "image/pjpeg", "image/x-png", "video/mpeg", "video/avi", "video/mov", "video/wmv", "image/mp4", "text/docx", "text/xlsx", "text/ptx", "text/pdf");
        if($_FILES[$name]['size'] > 1073741824){
            $res = array("error" => "Ошибка! Максимальный вес файла - 1 Гб!");
            exit(json_encode($res));
        }
        if($_FILES[$name]['error']){
            $res = array("error" => "Ошибка! Возможно, файл слишком большой.");
            exit(json_encode($res));
        }
        if(!in_array($_FILES[$name]['type'], $types)){
            $res = array("error" => "Допустимые расширения - .gif, .jpg, .png, .mp4, .avi, .pdf, .xlsx, docx");
            exit(json_encode($res));
        }
        $new_name = md5(time()).".$ext";
        $uploadfile = $uploaddir.$new_name;
        $uploadfile = $uploaddir;
        if(@move_uploaded_file($_FILES[$name]['tmp_name'], $uploadfile)){
            $_SESSION['upload'] = $_FILES[$name]['tmp_name'];
            $res = array("file" => $_FILES[$name]['tmp_name']);
            exit(json_encode($res));
        }
    }
}