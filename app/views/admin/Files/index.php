<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Список файлов</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?=PATH;?>">Главная</a></li>
                <li class="breadcrumb-item"><a href="<?=ADMIN;?>">Панель</a></li>
                <li class="breadcrumb-item active">Список файлов</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
<!--            ********************************-->
            <form enctype="multipart/form-data" method="post" id="form3" role="form"
                  action="<?=ADMIN;?>/files/add">
                <div class="col-sm-12">
                    <div id="upload3" class="upload"></div>
                </div>
                <div class="col-sm-12">
                    <div id="answer"></div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <button type="submit" id="submit" class="btn btn-primary submit">Отправить</button>
<!--                        <img src="css/ajax-loader.gif " alt="" class="preloader-img">-->
                    </div>
                </div>

            </form>
<!--            ********************************-->

<!--            <form action="--><?//=ADMIN;?><!--/files/upload" enctype="multipart/form-data" method="post">-->
<!--                <input type="file" name="file[]" multiple>-->
<!--                <input type="submit" value="Отправить">-->
<!--            <small>Можете выбрать несколько файлов за один раз</small>-->
<!--            </form>-->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td style="width: 30px">#</td>
                                    <td>Наименование</td>
                                    <td style="width: 180px">Добавлен</td>
                                    <td style="width: 60px">Действия</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($files as $file):?>
                            <tr>
                                <td><?=$file['id'];?></td>
                                <td><a href="<?=PATH;?>/uploads/<?=$file['alias'];?>"><?=$file['name'];?></a></td>
                                <td><?=$file['created'];?></td>
                                <td><a href="<?=ADMIN;?>/files/delete?id=<?=$file['id'];?>" class="btn
                                        btn-danger btn-xs">Удалить</a></td>
                            </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
                <div class="card-footer clearfix">
                    <?php if ($pagination->countPages > 1):?>
                        <?=$pagination;?>
                    <?php endif;?>
                </div>
</section>