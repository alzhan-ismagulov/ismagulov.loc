<?php

namespace app\controllers\admin;
use ismagulova\libs\Pagination;

use app\models\admin\File;

class FilesController extends AppController
{
    public function indexAction()
    {
        restrictArea();
        restrictUser();
        $files = new File();
        $files = $files->index();
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 10;
        $count = \R::count('files');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();
        $files = \R::getAll("SELECT 
                        files.id,
                        files.name,
                        files.alias,
                        files.created
                        FROM files
                        ORDER  BY id ASC 
                        LIMIT $start, $perpage");
        $this->set(compact('files', 'pagination', 'count'));

        $this->setMeta('Список файлов');
    }

    public function addAction()
    {
        restrictArea();
        restrictUser();
        if (isset($_SESSION['file'])) {
            $files = $_SESSION['file'];
            $alias = $_SESSION['alias'];
            for ($index = 0; $index < count($files); $index++) {
                $file = \R::dispense('files');
                $file->name = $files[$index];
                $file->alias = $alias[$index];
                \R::store($file);
                unset($_SESSION['file']);
                unset($_SESSION['alias']);
            }
            $_SESSION['success'] = 'Файлы загружены';
            redirect(ADMIN.'/files');
        } else {
            $_SESSION['error'] = 'Файлы не загружены';
            redirect(ADMIN.'/files');
        }
    }

    public function uploadAction(){
        if(!empty($_FILES)){
            $path = __DIR__ . '../../../../public/uploads/';
            if(uploadFile('files', $path)){
                $res = ['answer' => 'success', 'file' => $_FILES['files']['name']];
                exit(json_encode($res));
            }else{
                $res = ['answer' => 'error', 'message' => 'Files not upload'];
                exit(json_encode($res));
            }
        }
    }

    public function deleteAction()
    {
        restrictArea();
        restrictUser();
        $file = $this->getRequestID();
        $file = \R::load('files', $file);
        $file_name = $file['alias'];
        $filepath = 'uploads/' . $file_name;
        unlink($filepath);
        \R::trash($file);
        $_SESSION['success'] = 'Файл удален';
        redirect(ADMIN . '/files');
    }
}





