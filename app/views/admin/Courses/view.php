<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Просмотр курса</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?=PATH;?>">Главная</a></li>
                <li class="breadcrumb-item"><a href="<?=ADMIN;?>">Панель</a></li>
                <li class="breadcrumb-item"><a href="<?=ADMIN;?>/courses">Курсы</a></li>
                <li class="breadcrumb-item active">Просмотр курса</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Дата создания</th>
                                <th>Название</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?=$course['id'];?></td>
                                <td><?=$course['created'];?></td>
                                <td>
                                    <?=$course['name'];?>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="3">Описание курса</th>
                            </tr>
                            <tr>
                                <td colspan="3"><?=$course['description'];?></td>
                            </tr>
                            <tr>
                                <th colspan="3">Текст курса</th>
                            </tr>
                            <tr>
                                <td colspan="3"><?=$course['text'];?></td>
                            </tr>
                            <tr>
                                <th colspan="3">Цена</th>
                            </tr>
                            <tr>
                                <td colspan="3"><?=$course['price'];?></td>
                            </tr>
                            <tr>
                                <th colspan="3">Автор</th>
                            </tr>
                            <tr>
                                <td colspan="3"><?=$course['author'];?></td>
                            </tr>
                            <tr>
                                <th colspan="3">Статус</th>
                            </tr>

                            <tr>
                                <td colspan="3"><?=$course['status'];?></td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Список уроков</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($lessons as $lesson):?>
                            <tr>
                                <td><?=$lesson['id'];?></td>
                                <td>
                                    <a href="<?=ADMIN;?>/lessons/view?id=<?=$lesson['id'];?>"><?=$lesson['title'];
                                    ?></a>
                                </td>
                            </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>