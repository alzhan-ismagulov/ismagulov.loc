<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Создать сообщение</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?=PATH;?>">Главная</a></li>
                <li class="breadcrumb-item"><a href="<?=ADMIN;?>">Панель</a></li>
                <li class="breadcrumb-item"><a href="<?=ADMIN;?>/messages">Сообщения</a></li>
                <li class="breadcrumb-item active">Создать сообщение</li>
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
                        <form action="<?=PATH;?>/messages/add" name="create" enctype="multipart/form-data"
                              method="post" role="form" data-toggle="validator">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <?php
                                        if (isset($_SESSION['reciever'])){
                                        $reciever = $_SESSION['reciever'];
                                        $reciever = R::findOne('users', 'users.id = ?', [$reciever]);
                                            echo "<input type='text' id='reciever' name = 'reciever' value='{$reciever['id']}' hidden></input>";
                                        } else {
                                            $users = R::getAll("SELECT 
                                        users.id,
                                        users.name,
                                        users.role
                                        FROM users
                                        WHERE users.role = 'admin'
                                        ORDER BY users.name
                                        ASC");
                                            ?>
                                            <select name="reciever" id="reciever">
                                                <?php foreach ($users as $user):?>
                                                    <option value="<?=$user['id'];?>" class="col-md-12"><?=$user['name'];
                                                        ?></option>
                                                <?php endforeach;?>
                                            </select>
                                        <?}?>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="text" id="editor1" cols="30" rows="10"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <div class="box box-danger box-solid file-upload">
                                                <div class="box-header">
                                                </div>
                                                <input type="file" name="userfile">
                                                <small>Просто добавьте файл и нажмите "Отправить сообшение"</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Отправить сообщение</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>