<div class="container-fluid">
    <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Редактирование урока</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=PATH;?>">Главная</a></li>
                        <li class="breadcrumb-item"><a href="<?=ADMIN;?>">Панель</a></li>
                        <li class="breadcrumb-item"><a href="<?=ADMIN;?>/lessons">Список уроков</a></li>
                        <li class="breadcrumb-item active">Редактирование урока</li>
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
                <div class="box-body"><form action="<?=ADMIN;?>/lessons/edit" name="edit" method="post" role="form" enctype="multipart/form-data"
                                            data-toggle="validator">
                        <div class="form-group">
                            <input type="hidden"
                                   id="id"
                                   name="id"
                                   class="form-control"
                                   placeholder= ""
                                   value="<?=$lesson['id'];?>">
                            <span class="glyphicon form-control-feedback" aria-
                                  hidden="true"></span>
                        </div>
                        <div class="form-group">
                            <label for="title">Название урока</label>
                            <input type="text"
                                   id="title"
                                   name="title"
                                   class="form-control"
                                   placeholder= "Измените название урока"
                                   value="<?=$lesson['title'];?>"
                                   required>
                            <span class="glyphicon form-control-feedback" aria-
                                  hidden="true"></span>
                        </div>
                        <div class="form-group">
                            <label for="text">Введите описание</label>
                            <textarea
                                    rows="10"
                                    id="editor"
                                    name="text"
                                    class="form-control"
                                    placeholder="Введите описание"><?=$lesson['description'];?></textarea>
                            <script type="application/javascript">
                                ClassicEditor
                                    .create( document.querySelector( '#editor' ) )
                                    // .then( editor => {
                                    //     console.log( editor );
                                    // } )
                                    .catch( error => {
                                        console.error( error );
                                    } );
                            </script>
                            <span class="glyphicon form-control-feedback" aria-
                                  hidden="true"></span>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="uploadimageforeditlesson">Добавьте изображение для обложки урока</label>
                                <div id="uploadimageforeditlesson" class="upload"></div>
                            </div>
                            <div class="col-sm-12">
                                <div id="answer"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary"
                                    name="submit"
                                    type="submit"
                                    id="sumbit"
                                    value="submit">Редактировать урок</button>
                        </div>
                    </form>

                    <h3>Добавьте или удалите файлы</h3>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 30px; text-align: center">#</th>
                            <th>Наименование файла</th>
                            <th width="100px">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($files as $file):?>
                            <tr>
                                <td><?=$file['id'];?></td>
                                <td><a href="<?=PATH;?>/uploads/<?=$file['name'];?>"><?=$file['name'];?></a></td>
                                <td>
                                    <?php
                                    $lesson_id = $lesson['id'];
                                    $file_id = $file['id'];
                                    $filesson = R::findAll('filesson', 'lesson = ? AND file = ?', [$lesson_id,
                                        $file_id]);
                                    if ($filesson){?>
                                        <a href="<?=ADMIN;
                                        ?>/lessons/defile?lesson_id=<?=$_GET['id'];?>&file_id=<?=$file['id'];
                                        ?>" class="btn btn-danger btn-xs">Удалить</a>
                                    <?} else {?>
                                        <a href="<?=ADMIN;?>/lessons/add-file?file_id=<?=$file['id'];
                                        ?>&lesson_id=<?=$_GET['id'];
                                        ?>" class="btn btn-success btn-xs">Добавить</a>
                                    <?}?>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                    <div class="card-footer clearfix">
                            <?php if ($pagination->countPages > 1):?>
                                <?=$pagination;?>
                            <?php endif;?>
                    </div>
            </div>
        </div>
</section>
<!-- /.content -->