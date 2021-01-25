<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <!--            <h1 class="m-0 text-dark">Список заказов</h1>-->
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?=PATH;?>">Главная</a></li>
                <li class="breadcrumb-item"><a href="<?=ADMIN;?>">Панель</a></li>
                <li class="breadcrumb-item active">Заказ №<?=$order['id'];?></li>
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
                            <b>Заказ №<?=$order['id'];?></b>
                        </div>
                    </div>
                    <div class="card-header">
                        <div class="card-title"><b>Детали заказа</b>
                        <?php if (!$order['status']):?>
                            <a href="<?=ADMIN;?>/orders/change?id=<?=$order['id'];?>&status=1" class="btn
                                btn-success btn-xs"> Сделать оплаченым</a>
                        <?php else: ?>
                            <a href="<?=ADMIN;?>/orders/change?id=<?=$order['id'];?>&status=0" class="btn
                                btn-default btn-xs"> Сделать не оплаченым</a>
                        <?php endif;?>
                            <a href="<?=ADMIN;?>/orders/delete?id=<?=$order['id'];?>" class="btn btn-danger btn-xs delete">Удалить</a>
                            </div>
                    </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Наименование</th>
                                    <th>Количество</th>
                                    <th>Цена</th>
                                    <th>Всего</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $sum = 0; $qty = 0; foreach($order_course as $course): ?>
                                <tr>
                                    <td><?=$course['id'];?></td>
                                    <td><a href="<?=ADMIN;?>/courses/view?id=<?=$course['course_id'];?>"><?=$course['title'];
                                    ?></a></td>
                                    <td style="text-align: right"><?=$course['qty']; $qty +=$course['qty'];?></td>
                                    <td style="text-align: right"><?=$course['price'];?> тенге</td>
                                    <td style="text-align: right"><?=$course['price']*$course['qty'];?>
                                        тенге</td>
                                    <?php $sum +=$course['price']*$course['qty']; ?>
                                </tr>
                                <?php endforeach;?>
                                <tr class="active">
                                    <td colspan="2">
                                        <b>Итого:</b>
                                    </td>
                                    <td colspan="2" style="text-align: right">
                                        <b><?=$sum; ?> тенге</b>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <tbody>
                            <?php $class = $order['status'] ? 'success' : '';?>
                            <tr>
                                <td>Номер заказа: </td>
                                <td style="text-align: right"><?=$order['id'];?></td>
                            </tr>
                            <tr>
                                <td>Дата заказа: </td>
                                <td style="text-align: right"><?=$order['created'];?></td>
                            </tr>
                            <tr>
                                <td>Дата изменения: </td>
                                <td style="text-align: right"><?=$order['modified'];?></td>
                            </tr>
                            <tr>
                                <td>Количество позиций в заказе </td>
                                <td style="text-align: right"><?=$qty;?></td>
                            </tr>
                            <tr>
                                <td>Сумма заказа</td>
                                <td style="text-align: right"><?=$sum;?> тенге</td>
                            </tr>
                            <tr>
                                <td>Имя заказчика</td>
                                <td style="text-align: right"><?=$order['name'];?></td>
                            </tr>
                            <tr>
                                <td>Статус заказа: </td>
                                <td style="text-align: right"><?=$order['status'] ? 'Оплачен' : 'Не оплачен';?></td>
                            </tr>
                            <tr>
                                <td>Комментарий: </td>
                                <td><?=$order['note'];?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>