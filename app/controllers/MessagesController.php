<?php

namespace app\controllers;

use ismagulova\libs\Pagination;

class MessagesController extends AppController
{
    public $layout = 'user';

    public function addAction()
    {
        restrictArea();

        if (!empty($_POST)) {
            $messages = \R::dispense('messages');
            $messages->sender = $_SESSION['user']['id'];
            $messages->reciever = $_POST['reciever'];
            $messages->email = $_SESSION['user']['email'];
            $messages->text = $_POST['text'];
            if (!$_FILES['userfile']['name']){
                $messages->files = NULL;
                if ($messages = \R::store($messages)){
                    $_SESSION['success'] = 'Сообщение добавлено';
                    unset($_SESSION['reciever']);
                    unset($_SESSION['sender']);
                    redirect(PATH . '/messages/outbox');
                }
            } else {
//                $ext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['userfile']['name']));
                $types = array(
                    "image/gif",
                    "image/png",
                    "image/jpeg",
                    "image/pjpeg",
                    "image/x-png",
                    "text/plain",
                    "application/pdf",
                    "application/msword",
                    "application/vnd.ms-excel",
                    "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                    "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                    "application/vnd.openxmlformats-officedocument.presentationml.presentation"
                );
                if ($_FILES
                    ['userfile']['size'] > 10737418) {
                    $_SESSION['error'] = "Ошибка. максимальный размер файла 1Мб!";
                    redirect();
                }
                if ($_FILES['userfile']['error']) {
                    $_SESSION['error'] = "Ошибка. Добавьте файл";
                    redirect();
                }
                if (!in_array($_FILES['userfile']['type'], $types)) {
                    $_SESSION['error'] = "Допустимые расширения - .gif, .jpg, .png, .pdf, .doc, .docx, .xls, .xlsx, .pptx, .txt";
                    redirect();
                }
                $uploaddir = WWW . '/uploads/';
                $new_name = $_FILES['userfile']['name'];
                $uploadfile = $uploaddir . $new_name;
                $messages->files = $new_name;
            }
            move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
            if ($messages = \R::store($messages)){
                $_SESSION['success'] = 'Сообщение добавлено';
                unset($_SESSION['reciever']);
                unset($_SESSION['sender']);
                redirect(PATH . '/messages/outbox');
            }
        }
    }

    public function indexAction()
    {
        
    }

    public function inboxAction()
    {
        restrictArea();
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
        FROM
        messages
        JOIN users
        ON messages.sender = users.id
        WHERE messages.reciever = $user_id
        LIMIT $start, $perpage 
        ");

        $this->set(compact('messages', 'pagination'));
        $this->setMeta('Список сообщений');
    }

    public function outboxAction()
    {
        restrictArea();
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
        $this->setMeta('Список сообщений');
    }

    public function viewAction()
    {
        restrictArea();
        if ($_GET['id']){
            $message_id = $_GET['id'];
            $message = \R::getRow("SELECT
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
        $this->setMeta('Просмотр сообщения');
    }

    public function deleteAction()
    {
        restrictArea();
        $message_id = $this->getRequestID();
        $message = \R::load('messages', $message_id);
        \R::trash($message);
        $_SESSION['success'] = 'Сообщение удалено';
        redirect('');
    }

    public static function upload()
    {
        if (0 < $_FILES['file']['error']) {
            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        } else {
            move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']);
        }
    }
}