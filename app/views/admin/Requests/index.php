<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Список запросов</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?=PATH;?>">Главная</a></li>
                <li class="breadcrumb-item"><a href="<?=ADMIN;?>">Панель</a></li>
                <li class="breadcrumb-item active">Список запросов</li>
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
                                <th>Имя</th>
                                <th style="width: 40px">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($requests as $request):?>
                                <tr>
                                    <td><?=$request['id'];?></td>
                                    <td><?=$request['created'];?></td>
                                    <td><a href="<?=ADMIN;?>/requests/view?id=<?=$request['id'];?>">
                                            <?php if ($request['reading'] == '0'){?>
                                                <b><?=$request['sender'];?></b>
                                            <?} else {?>
                                                <?=$request['sender'];?>
                                            <?}?>
                                        </a>
                                    </td>
                                    <td><a href="<?=ADMIN;?>/requests/delete?id=<?=$request['id'];?>" class="btn
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