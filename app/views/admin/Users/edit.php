<div class="container-fluid">
    <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Редактирование пользователя</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=PATH;?>">Главная</a></li>
                        <li class="breadcrumb-item active">Редактирование пользователя</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body"><form action="<?=ADMIN;?>/users/edit" name="edit" method="post" role="form"
                                            data-toggle="validator">
                        <div class="form-group">
                            <input type="hidden"
                                   id="id"
                                   name="id"
                                   class="form-control"
                                   placeholder= ""
                                   value="<?=$user['id'];?>">
                            <span class="glyphicon form-control-feedback" aria-
                                  hidden="true"></span>
                        </div>
                        <div class="form-group">
                            <label for="title">Имя пользователя</label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   class="form-control"
                                   placeholder= "Измените имя пользователя"
                                   value="<?=$user['name'];?>"
                                   required>
                            <span class="glyphicon form-control-feedback" aria-
                                  hidden="true"></span>
                        </div>
                        <div class="form-group">
                            <label for="title">Email</label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   class="form-control"
                                   placeholder= "Измените имя пользователя"
                                   value="<?=$user['email'];?>"
                                   disabled>
                            <span class="glyphicon form-control-feedback" aria-
                                  hidden="true"></span>
                        </div>
                        <div class="form-group">
                            <label for="title">Пароль</label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   class="form-control"
                                   placeholder= "Измените имя пользователя"
                                   value="<?=$user['password'];?>"
                                   disabled>
                            <span class="glyphicon form-control-feedback" aria-
                                  hidden="true"></span>
                        </div>
                        <div class="form-group">
                            <label for="title">Email</label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   class="form-control"
                                   placeholder= "Измените имя пользователя"
                                   value="<?=$user['email'];?>"
                                   disabled>
                            <span class="glyphicon form-control-feedback" aria-
                                  hidden="true"></span>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary"
                                    name="submit"
                                    type="submit"
                                    id="sumbit"
                                    value="submit">Редактировать урок</button>
                        </div>
                    </form>
            </div>
        </div>
        </div>
</section>
<!-- /.content -->