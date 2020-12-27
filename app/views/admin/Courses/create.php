<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Создать курс</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?=PATH;?>">Главная</a></li>
                <li class="breadcrumb-item"><a href="<?=ADMIN;?>">Панель</a></li>
                <li class="breadcrumb-item"><a href="<?=ADMIN;?>/courses">Курсы</a></li>
                <li class="breadcrumb-item active">Создать курс</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->

    <!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements disabled -->
                <div class="card card-warning">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="#" name="create" enctype="multipart/form-data"
                              method="post" role="form" data-toggle="validator">
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Название курса</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                               placeholder="Название">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-outline card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">Описание курса</h3>
                                            </div>
                                            <div class="card-body pad">
                                                <div class="mb-3">
                                                    <textarea name="description" id="editor1" class="textarea"
                                                              rows="10">
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Цена курса</label>
                                        <input type="text" name="price" id="price" class="form-control"
                                               placeholder="Введите цену">
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Создать курс</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>