<?php


namespace app\controllers\admin;

use app\models\admin\File;
use app\models\admin\Lesson;
use ismagulova\libs\Pagination;
use ismagulova\App;

class LessonsController extends AppController
{
    public function indexAction()
    {
        restrictArea();
        restrictUser();
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 10;
        $count = \R::count('lessons');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();
        $lessons = \R::getAll("SELECT 
                        lessons.id,
                        lessons.title,
                        lessons.description,
                        lessons.image,
                        lessons.created,
                        lessons.modified,
                        lessons.status
                        FROM lessons  
                        LIMIT $start, $perpage");
        $this->setMeta('Список уроков');
        $this->set(compact('lessons', 'pagination', 'count'));
    }

    public function createAction()
    {
        restrictArea();
        restrictUser();
        if (!empty($_POST)) {
            $lesson = \R::dispense('lessons');
            $lesson->title = $_POST['title'];
            $lesson->description = $_POST['text'];
            if (isset($_SESSION['alias'])){
                $lesson->image = $_SESSION['alias'][0];
            } else {
                $lesson->image = NULL;
            }
            unset($_SESSION['alias']);
            if (\R::store($lesson)){
                $_SESSION['success'] = 'Урок создан';
                redirect(ADMIN.'/lessons');
            } else {
                $_SESSION['error'] = 'Урок не создан';
                redirect(ADMIN.'/lessons');
            }
        }
        $this->setMeta('Новый урок');
    }

    public function editAction()
    {
        restrictUser();
        restrictArea();
        $lesson = new Lesson();
        $lesson->edit();
        $lesson_id = $_GET['id'];
        $lesson = \R::getRow('SELECT
                                        `lessons`.`id`,
                                        `lessons`.`title`,
                                        `lessons`.`description`,
                                        `lessons`.`image`,
                                        `lessons`.`created`,
                                        `lessons`.`modified`,
                                        `lessons`.`status`
                                FROM `lessons`
                                WHERE `lessons`.`id` = ?
                                LIMIT 1', [$lesson_id]);
        if (!$lesson){
            $_SESSION['error'] = 'Такого курса нет';
            redirect('/');
        }
        if (!empty($_POST)) {
            $lesson_id = $_SESSION['id'];
            $lesson = \R::findOne('lessons', 'id = ?', [$lesson_id]);
            $lesson->id = $_SESSION['id'];
            $lesson->title = $_POST['title'];
            $lesson->description = $_POST['text'];
            if (isset($_SESSION['alias'])){
                $lesson->image = $_SESSION['alias'][0];
            } else {
                $lesson->image = NULL;
            }
            unset($_SESSION['alias']);
        }

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 10;
        $count = \R::count('files');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();
        $files = \R::getAll("SELECT files.id, files.name, files.alias FROM files LIMIT $start, $perpage");

        $this->setMeta("Редактирование урока");
        $this->set(compact('lesson', 'files', 'pagination'));
    }

//    Удаление файлов
    public function deleteFilesAction()
    {
        if (empty($_POST['file'])) die('file not found');

        session_start();
        $file = $_POST['file'];

        if (file_exists('uploads/' . $file)) {
            @unlink('uploads/' . $file);

            if (!empty($_SESSION['files'])) {
                foreach ($_SESSION['files'] as $k => $v) {
                    if ($file == $v) {
                        unset($_SESSION['files'][$k]);
                    }
                }
            }
        }
    }

//    Удаление файлов из урока
    public function defileAction()
    {
        $lesson_id = $_GET['lesson_id'];
        $file_id = $_GET['file_id'];
        $file = \R::exec("DELETE FROM filesson WHERE filesson.file = ? AND filesson.lesson = ?", [$file_id,
            $lesson_id]);
        $_SESSION['success'] = 'Файл из урока удалён';
        redirect('');
    }

    public function viewAction()
    {
        restrictArea();
        restrictUser();
        $lesson_id = $_GET['id'];
        $lesson = \R::getRow("SELECT 
                        lessons.id,
                        lessons.title,
                        lessons.description,
                        lessons.image,
                        lessons.created,
                        lessons.modified,
                        lessons.status
                        FROM lessons
                        WHERE lessons.id = $lesson_id                        
                                    LIMIT 1");
        if (!$lesson){
            throw new \Exception('Урок не найден', 404);
        }

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 10;
        $count = \R::count('filesson');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();
        $filessons = \R::getAll(
            "SELECT 
                        `filesson`.`lesson`, 
                        `filesson`.`file` = `files`.`name`,
                        `files`.`id`,
                        `files`.`name`,
                        `files`.`alias`
                        FROM `filesson`
                        JOIN `files`
                        ON `filesson`.`file` = `files`.`id`
                        WHERE `filesson`.`lesson` = ?
                        ORDER BY `filesson`.`id` ASC LIMIT $start, $perpage", [$lesson_id]
        );
//        $file_name = $filessons['file'];
//        $alias = \R::getRow("SELECT files.name, files.alias FROM files WHERE files.name = ?", [$file_name]);

        $this->set(compact('lesson', 'filessons', 'alias'));
        $this->setMeta('Просмотр урока');
    }

    public function changeAction()
    {
        restrictArea();
        restrictUser();
        $lesson = new Lesson();
        $lesson->change();
    }

    public function uploadAction()
    {
        if(!empty($_FILES)){
            $path = __DIR__ . '../../../../public/uploads/';
            if(uploadFile('files', $path)){
                $res = ['answer' => 'success', 'file' => $_FILES['files']['name']];
                exit(json_encode($res));
            }else{
                $res = ['answer' => 'error'];
                exit(json_encode($res));
            }
        }
    }

//    Добавление файлов в урок в разделе Редактирование урока
    public function addFileAction()
    {
        $lesson_id = $_GET['lesson_id'];
        $file_id = $_GET['file_id'];
        $files = \R::dispense('filesson');
        $files->file = $file_id;
        $files->lesson = $lesson_id;
//        $files->alias = 0;
        $files = \R::store($files);
        if ($files) {
            $_SESSION['success'] = 'Файл добавлен в урок';
        }
        redirect('');
    }

//    Удаление урока
    public function deleteAction()
    {
        restrictArea();
        restrictUser();
        $lesson_id = $this->getRequestID();
        $lesson = \R::load('lessons', $lesson_id);
        $files = \R::getAll("SELECT lessons.image FROM lessons WHERE lessons.id = $lesson_id");
        foreach ($files as $file) {
            if (file_exists('uploads/' . $file['image'])) {
                @unlink('uploads/' . $file['image']);
            }
        }
        \R::trash($lesson);
        $_SESSION['success'] = 'Урок удален';
        unset($_SESSION['file']);
        redirect(ADMIN . '/lessons');
    }
}