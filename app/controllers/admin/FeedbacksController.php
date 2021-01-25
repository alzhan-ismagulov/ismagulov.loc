<?php

namespace app\controllers\admin;

use ismagulova\libs\Pagination;

class FeedbacksController extends AppController
{
    public function createAction()
    {
        restrictArea();
        restrictUser();
        if (!empty($_POST)) {
            $feedback = \R::dispense('feedbacks');
            $feedback->name = $_POST['name'];
            $feedback->text = $_POST['text'];
            if (isset($_SESSION['alias'])){
                $feedback->image = $_SESSION['alias'][0];
            } else {
                $feedback->image = 'user.jpg';
            }
            unset($_SESSION['alias']);
            if (\R::store($feedback)){
                $_SESSION['success'] = 'Отзыв создан';
                redirect(ADMIN.'/feedbacks');
            } else {
                $_SESSION['error'] = 'Отзыв не создан';
                redirect();
            }
        }
        $this->setMeta('Новый урок');
        $this->setMeta('Создайте отзыв');
    }

    public function indexAction()
    {
        restrictArea();
        restrictUser();
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 10;
        $count = \R::count('feedbacks');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();

        $feedbacks = \R::getAll('SELECT feedbacks.* FROM feedbacks');
        $this->set(compact('feedbacks', 'pagination'));
        $this->setMeta('Список отзывов');
    }

    public function viewAction()
    {
        $feedback_id = $this->getRequestID();
        $feedback = \R::getRow("SELECT feedbacks.* FROM feedbacks WHERE feedbacks.id = ? LIMIT 1", [$feedback_id]);

        if (!$feedback){
            throw new \Exception('Отзыв не найден', 404);
        }

        $this->setMeta("Отзыв № {$feedback_id}");
        $this->set(compact('feedback'));
    }

    public function deleteAction()
    {
        $feedback_id = $this->getRequestID();
        $feedback = \R::load('feedbacks', $feedback_id);
        $this->deleteFilesAction();
        if(\R::trash($feedback)){
            $_SESSION['success'] = "Отзыв удалён";
            redirect(ADMIN . '/feedbacks');
        } else {
            $_SESSION['error'] = "Отзыв не удалён";
            redirect();
        }
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

    public function deleteFilesAction()
    {
        $feedback_id = $this->getRequestID();
        $feedback = \R::load('feedbacks', $feedback_id);
        $file = $feedback->image;
        if ($file == 'user.jpg'){
            return false;
        } else {
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
    }
}