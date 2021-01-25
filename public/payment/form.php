<?php session_start();?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<p>Через несколько секунд Вы будете перенаправлены на страницу оплаты. Нажмите на кнопку, если не хотите ждать...</p>

    <?php if (!empty($_SESSION['payment'])): ?>
        <form action="https://sci.interkassa.com/" id="payment" name="payment" method="post" enctype="utf-8">
            <input type="hidden" name="ik_co_id" value="#" />
            <input type="hidden" name="ik_pm_no" value="<?=$_SESSION['payment']['id'];?>" />
            <input type="hidden" name="ik_am" value="<?=$_SESSION['payment']['sum'];?>" />
<!--            <input type="hidden" name="ik_cur" value="RUB" />-->
            <input type="hidden" name="ik_desc" value="Платеж за продукт на сайте" />
            <input type="submit" value="Оплатить" />
        </form>
    <?php endif;?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    setTimeout(function () {
        $('form').submit();
    }, 20000);
</script>

</body>
</html>