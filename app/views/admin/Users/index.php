<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Список пользователей</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?=PATH;?>">Главная</a></li>
                <li class="breadcrumb-item"><a href="<?=ADMIN;?>">Панель</a></li>
                <li class="breadcrumb-item active">Список пользователей</li>
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
                                <th>Имя</th>
                                <th>Email</th>
                                <th>IP</th>
                                <th>Роль</th>
                                <th>Статус</th>
                                <th style="width: 40px; text-align: center" colspan="3">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($users as $user):?>
                            <tr>
                                <td><?=$user['id'];?></td>
                                <td><?=$user['created'];?></td>
                                <td><a href="<?=ADMIN;?>/users/view?id=<?=$user['id'];?>"><?=$user['name'];?></a></td>
                                <td><?=$user['email'];?></td>
                                <td><?=$user['ip'];?></td>
                                <td>
                                    <?php if($user['role']=='admin'){?>
                                    <a href="<?=ADMIN;
                                    ?>/users/role?id=<?=$user['id'];?>&role=user" class="btn
                                btn-success btn-xs">Администратор</a><?} else {?><a href="<?=ADMIN;
                                    ?>/users/role?id=<?=$user['id'];?>&role=admin" class="btn
                                btn-warning btn-xs">Пользователь</a><?}?></td>

                                <td><?php if($user['status'] == '1'){?><a href="<?=ADMIN;
                                ?>/users/status?id=<?=$user['id'];?>&status=0" class="btn
                                btn-success btn-xs">Деактивировать</a><?} else {?><a href="<?=ADMIN;
                                ?>/users/status?id=<?=$user['id'];?>&status=1" class="btn
                                btn-warning btn-xs">Активировать</a><?}?></td>

<!--                                <td>-->
<!--                                    --><?php //if($user['status']==1){?>
<!--                                        <a href="--><?//=ADMIN;?><!--/users/changeStatus?id=--><?//=$user['id'];?><!--&status=0"-->
<!--                                           class="btn btn-warning btn-xs"> Сделать неактивным</a>-->
<!--                                    --><?php //} else { ?>
<!--                                        <a href="--><?//=ADMIN;?><!--/users/changeStatus?id=--><?//=$user['id'];?><!--&status=1"-->
<!--                                           class="btn btn-success btn-xs"> Сделать активным</a>-->
<!--                                    --><?php //} ?>
<!--                                </td>-->
<!---->
<!--                                <td>-->
<!--                                    --><?php //if($user['role']=='user'){?>
<!--                                        <a href="--><?//=PATH;?><!--/users/changeRole?id=--><?//=$user['id'];?><!--&role=admin"-->
<!--                                           class="btn btn-success btn-xs"> Сделать администратором</a>-->
<!--                                    --><?php //} else { ?>
<!--                                        <a href="--><?//=PATH;?><!--/users/changeRole?id=--><?//=$user['id'];?><!--&role=user"-->
<!--                                           class="btn btn-warning btn-xs"> Сделать пользователем</a>-->
<!--                                    --><?php //} ?>
<!--                                </td>-->

                                <td><span><a href="<?=ADMIN;?>/users/delete?id=<?=$user['id'];
                                ?>" class="btn btn-danger btn-xs">Удалить</a></span></td>
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