<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN;?>/lessons/create" method="post" data-toggle="validator">
                    <div class="box-body">
                        <div class="col-sm-12">
<!--                            <div class="form-group">-->
<!--                                <label>Выберите название курса, к которому относится урок</label>-->
<!--                                <select name="course" id="course" class="form-control" style="width: 100%">-->
<!--                                    <option value="#">Выберите курс</option>-->
<!--                                    --><?php
//                                    $courses = \R::getAll("SELECT
//                                        `courses`.`id`,
//                                        `courses`.`name`
//                                        FROM `courses`
//                                        ");
//                                    ?>
<!--                                    --><?php //foreach ($courses as $course):?>
<!--                                        <option value="--><?//=$course['id'];?><!--">--><?//=$course['name'];?><!--</option>-->
<!--                                    --><?php //endforeach;?>
<!--                                </select>-->
<!--                            </div>-->
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label>Название урока</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Название">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="card-header">
                                    <label>Описание урока</label>
                                </div>
                                <textarea name="description" id="editor1" rows="10" style="width: 100%"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <div class="box box-danger box-solid file-upload">
                                    <div class="box-header">
                                        <h3 class="box-title">Базовое изображение</h3>
                                    </div>
                                    <div class="box-body">
                                        <div id="single"
                                             class="btn btn-success"
                                             data-url="/lessons/add-image"
                                             data-name="single">
                                            Выбрать файл
                                        </div>
                                        <p></p>
                                        <div class="single"></div>
                                    </div>
                                    <div class="overlay">
                                        <i class="fa fa-refresh fa-spin"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <p>Чтобы добавить дополнительные материалы в урок пройдите в <a href="<?=ADMIN;
                        ?>/lessons">Редактирование урока</a></p>
                    <div class="box-footer">
                        <button type="submit" id="button" class="btn btn-success">Добавить</button>
                    </div>
                </form>
                <?php if(isset($_SESSION['form_data'])) unset($_SESSION['form_data']); ?>
            </div>
        </div>
    </div>
</section>