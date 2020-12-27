<?php


namespace app\controllers\admin;

use app\models\admin\AddLesson;
use app\models\admin\Course;
use app\models\admin\Lesson;
use app\models\admin\Stream;
use ismagulova\libs\Pagination;
use ismagulova\App;

class CoursesController extends AppController
{
    public $layout = 'dashboard';

    public function indexAction()
    {
        restrictArea();
        restrictUser();
        $course = new Course();
        $page = isset($_GET['page']) ? (int)$_GET['page'] :1;
        $perpage = 10;
        $count = \R::count('courses');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();
        $courses = \R::getAll("SELECT 
                                        `courses`.`id`, 
                                        `courses`.`name`,  
                                        `courses`.`description`, 
                                        `courses`.`price`,
                                        `courses`.`author`,
                                        `courses`.`created`, 
                                        `courses`.`begin`,
                                        `courses`.`status` 
                                        FROM `courses`
                                        ORDER BY `courses`.`id`
                                        ASC 
                                        LIMIT $start, $perpage");
        $this->setMeta('Список курсов');
        $this->set(compact('courses', 'pagination', 'count'));
    }

    public function createAction()
    {
        restrictArea();
        restrictUser();
        $courses = new Course();
        $courses->create();
        $this->setMeta('Создать курс');

        $lessons = \R::getAll("SELECT 
                        lessons.id,
                        lessons.title,
                        lessons.description,
                        lessons.image,
                        lessons.created,
                        lessons.modified,
                        lessons.status
                        FROM lessons
                        WHERE lessons.status = '1'");
        $this->set(compact('lessons'));
    }

    public function editAction()
    {
        restrictUser();
        restrictArea();
        $course = new Course();
        $user = $_SESSION['user']['id'];
        $course->edit();
        $course_id = $_GET['id'];
        $course = \R::getRow('SELECT
                                        `courses`.`id`,
                                        `courses`.`name`,
                                        `courses`.`description`,
                                        `courses`.`price`,
                                        `courses`.`author`,
                                        `courses`.`created`,
                                        `courses`.`begin`,
                                        `courses`.`status`
                                FROM `courses`
                                WHERE `courses`.`id` = ?
                                LIMIT 1', [$course_id]);
        if (!$course){
            $_SESSION['error'] = 'Такого курса нет';
            redirect('/');
        }

        $lessons = \R::getAll("SELECT
                        lessons.id,
                        lessons.title,
                        lessons.description,
                        lessons.image,
                        lessons.created,
                        lessons.modified,
                        lessons.status
                        FROM lessons
                        WHERE lessons.status = '1'");

        $this->setMeta("Редактирование курса");
        $this->set(compact('course', 'lessons'));
    }

    public function deleteAction()
    {
        restrictArea();
        restrictUser();
        $course_id = $this->getRequestID();
        $course = \R::load('courses', $course_id);
        $streams = \R::exec("DELETE FROM streams WHERE streams.courses = ?", [$course_id]);
        \R::trash($course);
        $_SESSION['success'] = 'Курс удален';
        redirect(ADMIN . '/courses');
    }
    
    public function delessonAction()
    {
        $lesson_id = $_GET['lesson_id'];
        $courses_id = $_GET['courses_id'];
        $lesson = \R::exec("DELETE FROM streams WHERE streams.lessons = ? AND streams.courses = ?", [$lesson_id, $courses_id]);
        $_SESSION['success'] = 'Урок из курса удалён';
        redirect('');
    }

    public function adlessonAction()
    {
        $lesson_id = $_GET['lesson_id'];
        $courses_id = $_GET['courses_id'];
        $streams = \R::dispense('streams');
        $streams->courses = $courses_id;
        $streams->lessons = $lesson_id;
        $stream = \R::store($streams);
        if ($stream) {
            $_SESSION['success'] = 'Урок добавлен';
        }
        redirect('');
    }

    public function viewAction()
    {
        restrictArea();
        restrictUser();
        $course_id = $_GET['id'];
        $course = \R::getRow("SELECT 
                                        `courses`.`id`,
                                        `courses`.`name`,
                                        `courses`.`description`,
                                        `courses`.`price`,
                                        `courses`.`created`,
                                        `courses`.`begin`,
                                        `courses`.`author`,
                                        `courses`.`status`
                                    FROM `courses` 
                                    WHERE `courses`.`id` = $course_id
                                    LIMIT 1");
        if (!$course){
            throw new \Exception('Курс не найден', 404);
        }
        $lessons = \R::getAll(
            "SELECT 
                        `streams`.`courses`, 
                        `streams`.`lessons` = `lessons`.`title`,
                        `lessons`.`id`,
                        `lessons`.`title`
                        FROM `streams`
                        JOIN `lessons`
                        ON `streams`.`lessons` = `lessons`.`id` 
                        WHERE `streams`.`courses` = ?
                        ORDER BY `streams`.`id` ASC", [$course_id]
        );

        $this->set(compact('course', 'lessons'));
        $this->setMeta('Просмотр курса');
    }

    public function changeAction()
    {
        $course = new Course();
        $course->change();
    }
}