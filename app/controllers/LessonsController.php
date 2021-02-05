<?php


namespace app\controllers;


use ismagulova\libs\Pagination;

class LessonsController extends AppController
{
    public function viewAction()
    {
        restrictArea();
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

        $this->set(compact('lesson', 'filessons'));
        $this->setMeta('Просмотр урока');
    }
}