<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Подтвердите регистрацию</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <?php $token = $_SESSION['token'];?>
            <p>Здравствуйте! Вы зарегистрировались на сайте "<?=\ismagulova\App::$app->getProperty('site_name');
            ?>"</a></p>
            <p>Для того, чтобы активировать свой аккаунт, пройдите
                <a href="<?=PATH;?>/user/activation?token=<?=$token;?>" target="_blank">сюда</a></p>
        </div>
    </div>
</div>
</body>
</html>