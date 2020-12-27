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

    public function addImageAction()
    {
        restrictArea();
        restrictUser();
        if (isset($_GET['upload'])) {
            if ($_POST['name'] == 'single') {
                $wmax = App::$app->getProperty('img_width');
                $hmax = App::$app->getProperty('img_height');
            }
            $name = $_POST['name'];
            $lesson = new Lesson();
            $lesson->uploadImg($name, $wmax, $hmax);
        }
    }

    public function createAction()
    {
        restrictArea();
        restrictUser();
        if (!empty($_POST)) {
            $lesson = new Lesson();
            $data = $_POST;
            $lesson->created = date("Y-m-d H:i:s");
            $lesson->modified = date("Y-m-d H:i:s");
            $lesson->load($data);
            $lesson->getImg();

            if (!$lesson->validate($data)) {
                $lesson->getErrors();
                $_SESSION['form_data'] = $data;
                redirect();
            }

            if ($id = $lesson->save('lessons')) {
                $p = \R::load('lessons', $id);
                \R::store($p);
                $_SESSION['success'] = 'Урок добавлен';
            }
            redirect(ADMIN . '/lessons/');
        }

        $this->setMeta('Новый урок');
    }

    public function editAction()
    {
        restrictArea();
        restrictUser();
        $lesson = new Lesson();
        $lesson->getImg();
        $lesson->edit();
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
        if (!$lesson) {
            $_SESSION['error'] = 'Такого урока нет нет';
            redirect(ADMIN . '/lessons/');
        }

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 10;
        $count = \R::count('files');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();
        $files = \R::getAll("SELECT files.id, files.name FROM files LIMIT $start, $perpage");

        $this->setMeta("Редактирование урока");
        $this->set(compact('lesson', 'files', 'pagination'));
    }

    public function defileAction()
    {
        $lesson_id = $_GET['lesson_id'];
        $file_id = $_GET['file_id'];
        $file = \R::exec("DELETE FROM filesson WHERE filesson.file = ? AND filesson.lesson = ?", [$file_id,
            $lesson_id]);
        $_SESSION['success'] = 'Файл из урока удалён';
        redirect('');
    }

    public function deleteAction()
    {
        restrictArea();
        restrictUser();
        $lesson_id = $this->getRequestID();
        $lesson = \R::load('lessons', $lesson_id);
        \R::trash($lesson);
        $_SESSION['success'] = 'Урок удален';
        redirect(ADMIN . '/lessons');
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
                        `files`.`name`
                        FROM `filesson`
                        JOIN `files`
                        ON `filesson`.`file` = `files`.`id`
                        WHERE `filesson`.`lesson` = ?
                        ORDER BY `filesson`.`id` ASC LIMIT $start, $perpage", [$lesson_id]
        );

        $this->set(compact('lesson', 'filessons'));
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
        restrictArea();
        restrictUser();
            $name = $_POST['name'];
            $lesson = new Lesson();
            $lesson->upload($name);
    }

    public function addFileAction()
    {
        $lesson_id = $_GET['lesson_id'];
        $file_id = $_GET['file_id'];
        $files = \R::dispense('filesson');
        $files->file = $file_id;
        $files->lesson = $lesson_id;
        $files = \R::store($files);
        if ($files) {
            $_SESSION['success'] = 'Файл добавлен в урок';
        }
        redirect('');
    }
}