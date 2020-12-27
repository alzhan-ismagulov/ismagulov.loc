<!--<div class="signup">-->
<!--    <div class="signup__container">-->
<!--        <h1>Регистрация</h1>-->
<!--        <form method="post" action="user/signup" id="signup" role="form">-->
<!--            <div class="form__input">-->
<!--                <input type="text" id="name" name="name" placeholder="Введите имя" required>-->
<!--                <input type="text" id="email" name="email" placeholder="Введите email" required>-->
<!--                <input type="password" id="form-password" name="password" placeholder="Введите пароль" required>-->
<!--                <input type="text" id="phone" name="phone" placeholder="Введите телефон" required>-->
<!--            </div>-->
<!--            <button class="form__button" name="submit" type="submit" id="submit">Регистрация</button>-->
<!--        </form>-->
<!--    </div>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--container-->

<div class="register-box">
    <div class="register-logo">
        <a href="../../index2.html"><b>ISMAGULOVA</a>
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Регистрация нового пользователя</p>

            <form method="post" action="user/signup" id="signup" role="form">
                <div class="input-group mb-3">
                    <input type="text" id="name" name="name" class="form-control" placeholder="Name">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" id="form-password" name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Введите телефон" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-phone"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Регистрация</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <p></p>
            <a href="/signin" class="text-center">Я уже зарегистрирован(а)</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->