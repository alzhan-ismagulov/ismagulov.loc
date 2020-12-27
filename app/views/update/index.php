<?php $_SESSION['token'] = $_GET['token'];?>
<!---->
<!--<div class="container">-->
<!--    <div class="row justify-content-center">-->
<!--        <div class="user-form col-md-8">-->
<!--            <div class="">-->
<!--                <h2 class="h6"><b>Обновление пароля</b></h2>-->
<!--            </div>-->
<!--            <div class="updatepass-content">-->
<!--                <form method="post" action="user/update" id="signup" role="form">-->
<!--                    <div class="form-group has-feedback">-->
<!--                        <label for="password">Введите новый пароль</label>-->
<!--                        <input type="password" name="password" id="password"-->
<!--                               placeholder="Новый пароль"  value="--><?//=isset($_SESSION['form_data']['password']) ? h($_SESSION['form_data']['password']) : '';?><!--" required>-->
<!--                    </div>-->
<!--                    <div class="form-group has-feedback">-->
<!--                        <label for="repeat_password">Повторите новый пароль</label>-->
<!--                        <input type="password" name="repeat_password" id="repeat_password"-->
<!--                               placeholder="Повторите пароль"  value="--><?//=isset($_SESSION['form_data']['repeat_password'])
//                            ? h($_SESSION['form_data']['repeat_password']) : '';?><!--" required>-->
<!--                    </div>-->
<!--            </div>-->
<!--            <div class="card-footer">-->
<!--                <button type="submit" class="btn btn-primary">Обновить пароль</button>-->
<!--            </div>-->
<!--            </form>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<div class="login-box">
    <div class="login-logo">
        <a href="<?=PATH;?>">ISMAGULOVA</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Укажите новый пароль</p>

            <form action="user/update" method="post">
                <div class="input-group mb-3">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="repeat_password" id="repeat_password" class="form-control" placeholder="Confirm Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Сменить пароль</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mt-3 mb-1">
                <a href="signin">Вход</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->