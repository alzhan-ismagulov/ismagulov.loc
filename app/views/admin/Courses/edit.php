<div class="container-fluid">
    <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Редактирование курса</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=PATH;?>">Главная</a></li>
                        <li class="breadcrumb-item active">Редактирование курса</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <form action="<?=PATH;?>/admin/courses/edit" name="edit" method="post" role="form"
                          data-toggle="validator">
                        <div class="form-group has-feedback">
<!--                            <label for="destination"><h5>№</h5></label>-->
                            <input type="hidden"
                                   id="id"
                                   name="id"
                                   class="form-control"
                                   placeholder= ""
                                   value="<?=$course['id'];?>">
                            <span class="glyphicon form-control-feedback" aria-
                                  hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="name"><h5>Название курса</h5></label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   class="form-control"
                                   placeholder= "Измените название курса?"
                                   value="<?=$course['name'];?>"
                                   required>
                            <span class="glyphicon form-control-feedback" aria-
                                  hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="text"><h5>Введите описание</h5></label>
                            <textarea
                                    rows="10"
                                    id="editor1"
                                    name="description"
                                    class="form-control"
                                    placeholder="Введите описание"><?=($course['description']);?></textarea>
                            <span class="glyphicon form-control-feedback" aria-
                                  hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="price"><h5>Цена курса</h5></label>
                            <input type="text"
                                   id="price"
                                   name="price"
                                   class="form-control"
                                   placeholder= "Измените цену курса"
                                   value="<?=$course['price'];?>"
                                   required>
                            <span class="glyphicon form-control-feedback" aria-
                                  hidden="true"></span>
                        </div>
                        <b class="form-group has-feedback">
                            <label><h5>Автор петиции: </h5></label>
                            <?php echo $_SESSION['user']['name'];?>
                        </b>
<!--                        <div class="col-md-12">-->
<!--                            <table class="table table-bordered">-->
<!--                                <thead>-->
<!--                                <tr>-->
<!--                                    <th>№</th>-->
<!--                                    <th>Выберите урок для курса</th>-->
<!--                                </tr>-->
<!--                                </thead>-->
<!--                                <tbody>-->
<!--                                --><?php //foreach ($lessons as $lesson):?>
<!--                                    <tr>-->
<!--                                        <td style="text-align: center">-->
<!--                                            <input type="checkbox" name="lesson[]" value="--><?//=$lesson['id'];?><!--">-->
<!--                                        </td>-->
<!--                                        <td>--><?//=$lesson['title'];?><!--</td>-->
<!--                                    </tr>-->
<!--                                --><?php //endforeach;?>
<!--                                </tbody>-->
<!--                            </table>-->
<!--                        </div>-->
                        <h3>Добавьте или удалите урок из курса</h3>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 30px; text-align: center">#</th>
                                <th>Наименование урока</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($lessons as $lesson):?>
                            <tr>
                                <td><?=$lesson['id'];?></td>
                                <td><?=$lesson['title'];?></td>
                                <td>
                                    <?php
                                    $course_id = $course['id'];
                                    $lesson_id = $lesson['id'];
                                    $lessoncourse = R::findAll('streams', 'courses = ? AND lessons = ?', [$course_id,
                                    $lesson_id]);
                                    if ($lessoncourse){?>
                                        <a href="<?=ADMIN;
                                        ?>/courses/delesson?lesson_id=<?=$lesson['id'];?>&courses_id=<?=$_GET['id'];
                                        ?>" class="btn btn-danger btn-xs">Удалить</a>
                                    <?} else {?>
                                        <a href="<?=ADMIN;?>/courses/adlesson?lesson_id=<?=$lesson['id'];?>&courses_id=<?=$_GET['id'];
                                        ?>" class="btn btn-success btn-xs">Добавить</a>
                                    <?}?>
                                </td>
                            </tr>
                            <?php endforeach;?>
                            <tr>
                                <td colspan="3" style="font-size: 12px">
                                    <b>Если Вы не видите здесь урока, то значит Вы его не активировали. Пройдите по
                                        <a href="<?=ADMIN;?>/lessons">ссылке</a>, чтобы активировать его</b>.
                                </td>
                            </tr>
                            </tbody>
                        </table>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary"
                            name="submit"
                            type="submit"
                            id="sumbit"
                            value="submit">Редактировать курс</button>
                </div>
                </form>
            </div>
        </div>
        </div>
</section>
<!-- /.content -->