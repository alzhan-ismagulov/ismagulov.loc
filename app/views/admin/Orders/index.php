<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
<!--            <h1 class="m-0 text-dark">Список заказов</h1>-->
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?=PATH;?>">Главная</a></li>
                <li class="breadcrumb-item"><a href="<?=ADMIN;?>">Панель</a></li>
                <li class="breadcrumb-item active">Список заказов</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Список заказов
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th style="text-align: center">ID</th>
                                <th style="text-align: center">Покупатель</th>
                                <th style="text-align: center">Статус</th>
                                <th style="text-align: center">Сумма</th>
                                <th style="text-align: center">Дата создания</th>
                                <th style="text-align: center">Дата изменения</th>
                                <th colspan="2" style="text-align: center">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($orders as $order):?>
                            <tr class="<?php
                            if($order['status'] == '1'){
                                echo 'success';
                            }
                            ?>">
                                <td style="text-align: center"><?=$order['id'];?></td>
                                <td style="text-align: center"><?=$order['name'];?></td>
                                <td style="text-align: center"><?=$order['status'] ? 'Оплачен' : 'Не оплачен';?></td>
                                <td style="text-align: right"><?=$order['sum'];?></td>
                                <td style="text-align: center"><?=$order['created'];?></td>
                                <td style="text-align: center"><?=$order['modified'];?></td>
                                <td style="text-align: center">
                                    <a href="<?=ADMIN;?>/orders/view?id=<?=$order['id'];?>">
                                        <i class="far fa-eye"></i>
                                    </a>
                                </td>
                                <td style="text-align: center">
                                    <a href="<?=ADMIN;?>/orders/delete?id=<?=$order['id'];?>">
                                        <i class="far fa-window-close text-danger delete"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        <?php if ($pagination->countPages > 1):?>
                            <?=$pagination;?>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>