<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ответить</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?=PATH;?>">Главная</a></li>
                <li class="breadcrumb-item"><a href="<?=PATH;?>/user">Личный кабинет</a></li>
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
                        <form enctype="multipart/form-data"
                              method="post"
                              id="form1"
                              name="form1"
                              role="form"
                              action="<?=PATH;?>/messages/add">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <!--                                    <input type="text" name="parent" id="parent" value="--><?//=$_GET['message_id'];?><!--" hidden>-->
                                    <?php if (isset($_GET['message_id'])){
                                        $_SESSION['message_id'] = $_GET['message_id'];
                                    } ?>
                                    <input type="text" name="reciever" id="reciever" class="form-control"
                                           value="<?=$parent_message['sender'];?>" hidden>
                                </div>
                            </div>
                            <div class="col-sm-12"><input type="text" class="form-control" id="subject"
                                                          name="subject" placeholder="Тема"></div>
                            <p></p>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <textarea type="text" name="text" id="editor"
                                              class="form-control" placeholder="Предыдущее сообщение:">
                                        <br />
                                        <u>Предыдущее сообщение:</u>
                                        <span><?=$parent_message['text'];?></span>
                                        </textarea>
                                    <script>
                                        ClassicEditor
                                            .create( document.querySelector( '#editor' ) )
                                            .catch( error => {
                                                console.error( error );
                                            } );
                                    </script>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div id="uploadfromuser" class="upload"></div>
                            </div>
                            <div class="col-sm-12">
                                <div id="answer"></div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button type="submit" id="submit" class="btn btn-primary submit">Ответить</button>
                                    <img src="<?=PATH;?>/image/ajax-loader.gif" alt="" class="preloader-img">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>