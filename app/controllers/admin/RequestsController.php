<?php


namespace app\controllers\admin;


use ismagulova\libs\Pagination;

class RequestsController extends \app\controllers\admin\AppController
{
        public function indexAction(){
        restrictUser();
        restrictArea();
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 10;
        $count = \R::count('requests');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();
        $requests = \R::getAll("SELECT
        requests.id, 
        requests.sender,  
        requests.email, 
        requests.text, 
        requests.created, 
        requests.reading
        FROM
        requests
        LIMIT $start, $perpage 
        ");

        $this->set(compact('requests', 'pagination'));
        $this->setMeta('Список запросов');
    }

    public function viewAction()
    {
        restrictArea();
        restrictUser();
        if ($_GET['id']){
            $request_id = $_GET['id'];
            $request = \R::getRow("SELECT
                requests.id,
                requests.sender,
                requests.email,
                requests.text,
                requests.created,
                requests.reading
                FROM requests
                WHERE requests.id = $request_id
                LIMIT 1                
                ");
        } else {
            $_SESSION['error'] = 'Сообщение не выбрано';
            redirect('');
        }

        $messages = \R::getAll("SELECT
        requests.id, 
        requests.sender, 
        requests.email, 
        requests.text, 
        requests.created, 
        requests.reading
        FROM
        requests
        ");
        $this->set(compact('request','requests'));
        $this->setMeta('Просмотр запросов');

        if (isset($_GET['id'])){
            $request_id = $_GET['id'];
            $requests = \R::exec("UPDATE requests SET requests.reading = '1' WHERE requests.id = ?", [$request_id]);
        }
    }

    public function deleteAction()
    {
        restrictArea();
        restrictUser();
        $request_id = $this->getRequestID();
        $request = \R::load('requests', $request_id);
        \R::trash($request);
        $_SESSION['success'] = 'Запрос удалён';
        redirect(ADMIN . '/requests');
    }
}