<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN;?>/lessons/create" method="post" data-toggle="validator">
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Название урока</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Название">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Описание урока</label>
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
                            <label for="uploadimageforlesson">Добавьте изображение для обложки урока</label>
                            <div id="uploadimageforlesson" class="upload"></div>
                        </div>
                        <div class="col-sm-12">
                            <div id="answer"></div>
                        </div>
                    </div>
                    <br>
                    <p>Чтобы добавить дополнительные материалы (видео, документы) в урок пройдите в <a href="<?=ADMIN;
                        ?>/lessons">Редактирование урока</a></p>
                    <div class="box-footer">
                        <button type="submit" id="button" class="btn btn-success">Добавить</button>
                    </div>
                </form>
                <?php if(isset($_SESSION['form_data'])) unset($_SESSION['form_data']); ?>
            </div>
        </div>
    </div>
</section>