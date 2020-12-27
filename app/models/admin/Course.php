<?php


namespace app\models\admin;
use app\models\admin\Stream;

class Course extends \app\models\AppModel
{
    public $attributes = [
        'name' => '',
        'description' => '',
        'price' => '',
        'author' => '',
        'created' => '',
        'begin' => ''
    ];

    public $rules = [
        'required' => [
            ['name'],
            ['description'],
            ['price'],
        ],
        'integer' => [
            ['price'],
        ],
    ];

    public function create()
    {
        restrictArea();
        restrictUser();
        if (!empty($_POST)) {
            $course = new Course();
            $data = $_POST;
            $course->load($data);
            if (!$course->checkUniqueCourses()) {
                $_SESSION['error'] = 'Курс с таким названием уже существует';
                redirect();
            } else {
                $course = \R::dispense('courses');
                $course->name = h($_POST['name']);
                $course->description = h($_POST['description']);
                $course->price = h($_POST['price']);
                $course->author = $_SESSION['user']['name'];
                if(\R::store($course)){
                    $_SESSION['success'] = "Запись в таблицу курсов сделана успешно";
                } else {
                    $_SESSION['error'] = "\"Запись в таблицу курсов не удалась";
                }
//                $lessons = ($_POST['lesson']);
//                for ($i=0; $i<sizeof ($lessons);$i++) {
//                $stream = \R::dispense('streams');
//                $id = \R::getAll("SELECT courses.id FROM courses ORDER BY courses.id DESC LIMIT 1");
//                $data = implode(",", $id[0]);
//                $stream->courses = $data;
//                    $stream->lessons = $lessons[$i];
//                    if(\R::store($stream)){
//                        $_SESSION['success'] = "Запись в таблицу уроков сделана успешно";
//                    } else {
//                        $_SESSION['error'] = "Запись в таблицу уроков сделана не успешно";
//                    }
//                }
                    redirect(ADMIN.'/courses');
            }
        }
    }

    public function edit()
    {
        restrictArea();
        restrictUser();
        if (!empty($_POST)) {
            $course = new Course();
            $data = $_POST;
            $course->load($data);
            $course_id = $_POST['id'];
            $course = \R::findOne('courses', 'id = ?', [$course_id]);
            $course->name = $_POST['name'];
            $course->description = $_POST['description'];
            $course->price = $_POST['price'];
            if (\R::store($course)) {
                $_SESSION['success'] = 'Ваш курс обновлен!';
            } else {
                $_SESSION['error'] = 'Не удалось обновить курс!';
            }
//            $lessons = ($_POST['lesson']);
//            for ($i=0; $i<sizeof ($lessons);$i++) {
//                $stream = \R::dispense('streams');
//                $stream->courses = $course_id;
//                $stream->lessons = $lessons[$i];
//                if(\R::store($stream)){
//                    $_SESSION['success'] = "Запись в таблицу уроков сделана успешно";
//                } else {
//                    $_SESSION['error'] = "Запись в таблицу уроков сделана не успешно";
//                }
//            }
                    redirect(ADMIN . '/courses');
        }
    }
    public function delete()
    {
        restrictArea();
        restrictUser();
    }
    public function view()
    {

    }
    public function checkUniqueCourses()
    {
        $course = \R::findOne('courses', 'name = ?', [$this->attributes['name']]);
        if ($course) {
            if ($course->name == $this->attributes['name']) {
                $this->errors['unique'][] = 'Курс с таким названием уже существует';
            }
            return false;
        }
        return true;
    }
    public function change()
    {
        $course_id = $_GET['id'];
        $status = ($_GET['status']);
        $courses = \R::load('courses', $course_id);
        if (!$courses){
            throw new \Exception('Страница не найдена', 404);
        }
        $courses->status = $status;
        \R::store($courses);
        $_SESSION['success'] = 'Изменения сохранены';
        redirect(PATH . '/admin/courses');
    }
}