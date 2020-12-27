<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Восстановление пароля</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <?php
//            $token = $_SESSION['user']['token'];
            $token = $user->token; ?>
            <p>Здравствуйте! Кто-то запросил восстановление пароля на сайте "<?=\ismagulova\App::$app->getProperty
                ('site_name');?>"</a></p>
            <p>Для того, чтобы восстановить пароль, пройдите
                <a href="<?=PATH;?>\update?token=<?=$token;?>" target="_blank">сюда</a></p>
        </div>
    </div>
</div>
</body>
</html>