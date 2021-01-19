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
                <td><?=$item['qty'];?></td>
                <td><?=$item['price'];?></td>
                <td><a href="cart/delete?id=<?=$item['id'];?>">
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
<?php else: ?>
    <h3>Корзина пуста</h3>
<?php endif; ?>
