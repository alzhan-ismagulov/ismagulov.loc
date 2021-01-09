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
        <div class="row">
            <div class="col-md-12">
                <div class="card card-warning">
                    <div class="card-body">
                        <form enctype="multipart/form-data" method="post" id="form" role="form" action="<?=ADMIN;
                        ?>/messages/add">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <?php
                                    $users = R::getAll("SELECT
                                    users.id,
                                    users.name
                                    FROM users
                                    ORDER BY users.name
                                    ASC");
                                    ?>
                                    <select name="reciever" id="reciever" class="form-control">
                                        <?php foreach ($users as $user):?>
                                        <option value="<?=$user['id'];?>" class="col-md-12"><?=$user['name'];
                                        ?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <textarea type="text" name="text" id="editor"
                                              class="form-control"></textarea>
                                </div>
                                <script type="application/javascript">
                                    ClassicEditor
                                        .create( document.querySelector( '#editor' ) )
                                        // .then( editor => {
                                        //     console.log( editor );
                                        // } )
                                        .catch( error => {
                                            console.error( error );
                                        } );
                                </script>
                            </div>
                            <div class="col-sm-12">
                                <div id="upload" class="upload"></div>
                            </div>
                            <div class="col-sm-12">
                                <div id="answer"></div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button type="submit" id="submit2" class="btn btn-primary
                                    submit2">Отправить</button>
                                    <img src="<?=PATH;?>/image/ajax-loader.gif" alt="" class="preloader-img">
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</section>