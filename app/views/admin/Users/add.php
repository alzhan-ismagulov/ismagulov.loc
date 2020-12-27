<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN;?>/users/add" method="post" data-toggle="validator">
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Имя</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Введите имя">
                            </div>
                            <div class="form-group">
                                <label>email</label>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>password</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>phone</label>
                                <input type="phone" name="phone" id="phone" class="form-control">
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-success">Добавить</button>
                            </div>
                        </div>
                    </div>
                </form>
                <?php if(isset($_SESSION['form_data'])) unset($_SESSION['form_data']); ?>
            </div>
        </div>
    </div>
</section>