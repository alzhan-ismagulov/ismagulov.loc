<!--<div class="menu">-->
<!--    <div class="menu-container">-->
<!--                <h1>Восстановить пароль</h1>-->
<!--                    <form method="post" action="user/recover" id="signup" role="form" data-toggle="validator">-->
<!--                        <div class="form-input">-->
<!--                            <label for="email">Введите свой Email для восстановления пароля</label>-->
<!--                            <input type="email" name="email" class="form-control" id="email" placeholder="Email"-->
<!--                                   value="--><?//=isset($_SESSION['form_data']['email']) ? h($_SESSION['form_data']['email']) : '';?><!--" required>-->
<!--                        </div>-->
<!--                        <a href="user/recover" class="recover">Подтвердить пароль</a>-->
<!--                        <div class="form-button">-->
<!--                            <button class="btn-recover"-->
<!--                                    name="submit"-->
<!--                                    type="submit"-->
<!--                                    id="sumbit"-->
<!--                                    value="submit">Восстановить</button>-->
<!--                        </div>-->
<!--                </form>-->
<!--            </div>-->
<!--</div>-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Forgot Password</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="<?=PATH;?>"><b>ISMAGULOVA</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Забыли пароль?</p>

            <form action="recover" method="post">
                <div class="input-group mb-3">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Получить новый пароль</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mt-3 mb-1">
                <a href="signin">Вход</a>
            </p>
            <p class="mb-0">
                <a href="signup" class="text-center">Регистрация</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="adminlte/dist/js/adminlte.min.js"></script>

</body>
</html>
