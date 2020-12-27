<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Список курсов</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?=PATH;?>">Главная</a></li>
                <li class="breadcrumb-item"><a href="<?=ADMIN;?>">Панель</a></li>
                <li class="breadcrumb-item active">Список курсов</li>
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
                                <th>Дата</th>
                                <th>Название</th>
<!--                                <th>Статус</th>-->
                                <th>Уроков</th>
                                <th style="width: 40px; text-align: center" colspan="3">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($courses as $course):?>
                            <tr>
                                <td><?=$course['id'];?></td>
                                <td><?=$course['created'];?></td>
                                <td><a href="<?=PATH;?>/admin/courses/view?id=<?=$course['id'];?>"><?=$course['name'];?></a></td>
<!--                                <td>--><?//=$course['status'];?><!--</td>-->
                                <td style="text-align: center"><?php
                                    $course_id = $course['id'];
                                        $count = R::count('streams', 'streams.courses = ?', [$course_id]);
                                        echo $count;
                                    ?></td>
                                <?php if ($course['status'] == 0){?>
                                <td>
                                    <span><a href="<?=PATH;?>/admin/courses/change?id=<?=$course['id'];?>&status=1"
                                             class="btn btn-warning btn-xs"> Неактивный</a></span>
                                </td>
                                <?} else {?>
                                    <td>
                                        <span><a href="<?=PATH;
                                        ?>/admin/courses/change?id=<?=$course['id'];?>&status=0" class="btn
                                        btn-success btn-xs"> Активный</a></span>
                                    </td>
                                <?}?>
                                <td><span><a
                                                href="<?=PATH;?>/admin/courses/edit?id=<?=$course['id'];
                                                ?>" class="btn
                                        btn-warning btn-xs">Редактировать</a></span>
                                </td>
                                <td><span><a href="/admin/courses/delete?id=<?=$course['id'];
                                ?>" class="btn
                                        btn-danger btn-xs">Удалить</a></span></td>
                            </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
<!--                        <ul class="pagination pagination-sm m-0 float-right">-->
<!--                            <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>-->
<!--                            <li class="page-item"><a class="page-link" href="#">1</a></li>-->
<!--                            <li class="page-item"><a class="page-link" href="#">2</a></li>-->
<!--                            <li class="page-item"><a class="page-link" href="#">3</a></li>-->
<!--                            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>-->
<!--                        </ul>-->
                        <?php if ($pagination->countPages > 1):?>
                            <?=$pagination;?>
                        <?php endif;?>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>