<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Входящие сообщения</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?=PATH;?>">Главная</a></li>
                <li class="breadcrumb-item"><a href="<?=ADMIN;?>">Панель</a></li>
                <li class="breadcrumb-item active">Входящие сообщения</li>
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
                                <th style="width: 200px">Дата</th>
                                <th>От кого:</th>
                                <th style="width: 40px">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($messages as $message):?>
                                <tr>
                                    <td><?=$message['id'];?></td>
                                    <td><?=$message['created'];?></td>
                                    <td>
<!--                                        Проверка на прочтено ли сообщение или нет?-->
                                        <?php if ($message['reading'] == 0){?>
                                        <b><a href="<?=ADMIN;?>/messages/view?id=<?=$message['id'];
                                        ?>"><?=$message['name'];?></a></b>
                                        <?} else {?>
                                            <a href="<?=ADMIN;?>/messages/view?id=<?=$message['id'];
                                            ?>"><?=$message['name'];?></a>
                                        <?}?>
<!--                                        Конец проверки-->
                                    </td>
                                    <td><a href="<?=ADMIN;?>/messages/delete?id=<?=$message['id'];?>" class="btn
                                        btn-danger btn-xs">Удалить</a></td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
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