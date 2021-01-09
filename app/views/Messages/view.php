<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Cообщение</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?=PATH;?>">Главная</a></li>
                <li class="breadcrumb-item"><a href="<?=PATH;?>/user">Личный кабинет</a></li>
                <!--                <li class="breadcrumb-item"><a href="--><?//=ADMIN;?><!--/messages/inbox">Входящие сообщения</a></li>-->
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
                <div class="card">
                    <div class="card-body">
                        <div class="card-subtitle col-md-12 text-muted"><h6>Дата отправления:
                                <?=$message['created'];?></h6></div>
                        <hr>
                        <div class="col-sm-12">
                            <div class="form-group">
                                    <textarea type="text" name="text" id="editor"
                                              class="form-control" disabled="disabled"><?=$message['text'];?></textarea>
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
                        <?php
                        $message_files = R::getAll("SELECT 
                                messagefiles.id,
                                messagefiles.message_id,
                                messagefiles.name,
                                messagefiles.alias,
                                messagefiles.created
                                FROM messagefiles
                                WHERE message_id = ?", [$message['id']]);
                        ?>
                        <?php if (isset($message_files)){
                            echo "<hr><h6><b>Приложенные файлы</b></h6>";
                            foreach($message_files as $message_file):?>
                                <div class="card-text"><p><a href="<?=PATH?>/uploads/<?=$message_file['alias'];?>"><?=
                                            $message_file['name']; ?></a></p></div>
                            <?php endforeach;}?>
                        <hr>
                        <?php
                        $message_id = $_GET['id'];
                        $user = R::findOne("messages","messages.id = ?", [$message_id]);
                        ?>
                        <?php $_SESSION['reciever'] = $user['sender'];?>
                        <a href="<?=PATH;?>/messages/replay?message_id=<?=$message['id'];?>" class="btn
                        btn-success">Ответить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>