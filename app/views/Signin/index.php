<!--<div class="signin__menu">-->
<!--    <div class="signup__menu-container">-->
<!--        <div class="signup__menu-left">-->
<!--            <div class="menu__left-wrap">-->
<!--                <h1>Вход</h1>-->
<!--                <form method="post" action="user/login" id="signin" role="form">-->
<!--                    <div class="form__input">-->
<!--                        <input type="text" id="email" name="email" placeholder="Введите email" required>-->
<!--                        <input type="password" id="password" name="password" placeholder="Введите пароль" required>-->
<!--                    </div>-->
<!--                    <button class="form__button" name="submit" type="submit" id="submit">Вход</button>-->
<!--                </form>-->
<!--                <a href="/recover" class="recover">Восстановить пароль</a>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="signin__menu-right">-->
<!--            <h4>Еще нет аккаунта?</h4>-->
<!--            <p>Пора присоединиться к нам</p>-->
<!--            <a href="--><?//=PATH;?><!--/signup" class="form__button-signin">Регистрация</a>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<div class="login-box">
    <div class="login-logo">
        <a href="<?=PATH;?>"><b>ISMAGULOVA</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Войти в личный кабинет</p>

            <form method="post" action="user/login" id="signin" role="form">
                <div class="input-group mb-3">
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" name="submit" id="submit" class="btn btn-primary btn-block">Вход</button>
<!--                        <button class="form__button" name="submit" type="submit" id="submit">Вход</button>-->
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <p></p>
            <p class="mb-1">
                <a href="<?=PATH;?>/recover">Я забыл(а) пароль</a>
            </p>
            <p class="mb-0">
                <a href="<?=PATH;?>/signup" class="text-center">Регистрация</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->