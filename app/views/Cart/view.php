<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Оформление заказа</h3>
                </div>
                <div class="card-body">
                    <div class="card-text">
                        <?php if (!empty($_SESSION['cart'])):?>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th>Наименование</th>
                                        <th>Кол-во</th>
                                        <th>Цена</th>
                                        <th>Удалить</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($_SESSION['cart'] as $id => $item):?>
                                        <tr>
                                            <td><a href="courses/view?id=<?=$item['id'];?>"><?=$item['title'];?></a></td>
                                            <?php $_SESSION['course_title'] = $item['title'];?>
                                            <td><?=$item['qty'];?></td>
                                            <td><?=$item['price'];?></td>
                                            <td><a href="<?=PATH;?>/cart/delete?id=<?=$item['id'];?>">
                                                    <i class="far fa-times-circle del-item" style="color: red"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td>Итого:</td>
                                        <td colspan="4" class="text-right cart-qty"><?=$_SESSION['cart.qty'];?></td>
                                    </tr>
                                    <tr>
                                        <td>На сумму</td>
                                        <td colspan="4" class="text-right cart-sum"><?=$_SESSION['cart.sum'];?> тенге</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <form action="<?=PATH;?>/cart/checkout" method="post" role="form" data-toggle="validator">
                                <div class="form-group">
                                    <label for="address">Дополнение</label>
                                    <textarea name="note" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="pay">
                                        <input type="checkbox" id="pay" name="pay"> Оплатить онлайн
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-default">Оформить</button>
                            </form>
                    </div>
                </div>
                    <div class="card-footer">
                        <?php else: ?>
                            <h6>Корзина пуста</h6>
                        <?php endif; ?>
                    </div>
            </div>
        </div>
    </div>
</div>