<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Просмотр пользователя</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?=PATH;?>">Главная</a></li>
                <li class="breadcrumb-item"><a href="<?=ADMIN;?>">Панель</a></li>
                <li class="breadcrumb-item"><a href="<?=ADMIN;?>/users/">Пользователи</a></li>
                <li class="breadcrumb-item active">Просмотр пользователя</li>
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
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?=$user['id'];?></td>
                                <td><?=$user['created'];?></td>
                            </tr>
                            <tr>
                                <th colspan="3">Имя</th>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <?=$user['name'];?>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="3">Email</th>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <?=$user['email'];?>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="3">Пароль</th>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <?=$user['password'];?>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="3">Телефон</th>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <?=$user['phone'];?>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="3">Токен</th>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <?=$user['token'];?>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="3">IP</th>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <?=$user['ip'];?>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="3">Роль</th>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <?=$user['role'];?>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="3">Статус</th>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <?=$user['status'];?>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="3">Время восстановления</th>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <?=$user['recovery_time'];?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>