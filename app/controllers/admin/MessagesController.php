<?php


namespace app\controllers\admin;

use app\models\admin\Message;
use ismagulova\libs\Pagination;

class MessagesController extends AppController
{
    public function addAction()
    {
        restrictArea();
        restrictUser();
        if (!empty($_POST)) {
            $messages = \R::dispense('messages');
            $messages->sender = h($_SESSION['user']['id']);
            $messages->reciever = h($_POST['reciever']);
            $messages->email = h($_SESSION['user']['email']);
            $messages->text = h($_POST['text']);
            if(\R::store($messages)) {
                foreach ($_SESSION['file'] as $file){
//                    $id = \R::exec("SELECT messages.id FROM messages ORDER BY messages.id DESC LIMIT 1");
                    $message_id = $messages->id;
                    $messagefiles = \R::dispense('messagefiles');
                    $messagefiles->message_id = $message_id;
                    $messagefiles->name = $file;
                    \R::store($messagefiles);
                }
                    unset($_SESSION['file']);
                $_SESSION['success'] = 'Сообщение отправлено';
                $res = ['answer' => 'success', 'message' => 'Message upload'];
            } else {
                $_SESSION['error'] = 'Сообщение не отправлено';
                $res = ['answer' => 'error'];
            }
            exit(json_encode($res));
        }
    }

    public function inboxAction()
    {
        restrictArea();
        restrictUser();
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 10;
        $count = \R::count('messages');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();
        $user_id = $_SESSION['user']['id'];
        $messages = \R::getAll("SELECT
        messages.id, 
        messages.sender = users.name, 
        messages.reciever, 
        messages.email, 
        messages.text, 
        messages.created, 
        messages.reading,
        users.name
        FROM messages JOIN users
        ON messages.sender = users.id
        WHERE messages.reciever = $user_id
        LIMIT $start, $perpage 
        ");

        $this->set(compact('messages', 'pagination'));
        $this->setMeta('Входящие сообщения');
    }
    public function outboxAction()
    {
        restrictArea();
        restrictUser();
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 10;
        $count = \R::count('messages');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();
        $user_id = $_SESSION['user']['id'];
        $messages = \R::getAll("SELECT
        messages.id, 
        messages.sender, 
        messages.reciever = users.name, 
        messages.email, 
        messages.text, 
        messages.created, 
        messages.reading,
        users.name
        FROM messages JOIN users
        ON messages.reciever = users.id
        WHERE messages.sender = $user_id
        LIMIT $start, $perpage 
        ");

        $this->set(compact('messages', 'pagination'));
        $this->setMeta('Отправленные сообщения');
    }
    public function viewAction()
    {
        restrictArea();
        restrictUser();
        if ($_GET['id']){
            $message_id = $_GET['id'];
            $message = \R::getRow("SELECT
                messages.id,
                messages.sender = users.name,
                messages.reciever,
                messages.email,
                messages.text,
                messages.created,
                messages.reading,
                users.name
                FROM messages JOIN users
                ON messages.sender = users.id 
                WHERE messages.id = $message_id
                LIMIT 1                
                ");
        } else {
            $_SESSION['error'] = 'Сообщение не выбрано';
            redirect('');
        }

        $messages = \R::getAll("SELECT
        messages.id, 
        messages.sender, 
        messages.reciever, 
        messages.email, 
        messages.text, 
        messages.created, 
        messages.reading
        FROM
        messages
        ");

        if (isset($_GET['id'])){
            $message_id = $_GET['id'];
            $messages = \R::exec("UPDATE messages SET messages.reading = '1' WHERE messages.id = ?", [$message_id]);
        }
        $this->set(compact('message','messages'));
        $this->setMeta('Cообщение');
    }
    public function deleteAction()
    {
        restrictArea();
        restrictUser();
        $message_id = $this->getRequestID();
        $message = \R::load('messages', $message_id);
        \R::trash($message);
        $files = \R::getAll("SELECT messagefiles.name FROM messagefiles WHERE messagefiles.message_id = $message_id");
        foreach ($files as $file) {
            if (file_exists('uploads/' . $file['name'])) {
                @unlink('uploads/' . $file['name']);
            }
        }
        \R::exec("DELETE FROM messagefiles WHERE message_id = $message_id");
        $_SESSION['success'] = 'Сообщение удалено';
        unset($_SESSION['file']);
        redirect('');
    }
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
    public function replayAction()
    {
        $this->setMeta('Ответить');
    }
}
