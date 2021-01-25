<?php

namespace app\controllers;

class CoursesController extends AppController
{
    public function viewAction()
    {
        $user_id = $_SESSION['user']['id'];
            $course_id = $_GET['id'];
            $course = \R::getRow("SELECT
                                            `courses`.`id`,
                                            `courses`.`name`,
                                            `courses`.`description`,
                                            `courses`.`text`,
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
    }