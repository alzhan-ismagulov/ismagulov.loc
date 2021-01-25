<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN;?>/feedbacks/create" method="post" data-toggle="validator">
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Имя</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Имя">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Отзыв</label>
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
                            <label for="uploadimageforfeedback">Добавьте фото для отзыва</label>
                            <div id="uploadimageforfeedback" class="upload"></div>
                        </div>
                        <div class="col-sm-12">
                            <div id="answer"></div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" id="button" class="btn btn-success">Добавить</button>
                    </div>
                </form>
                <?php if(isset($_SESSION['form_data'])) unset($_SESSION['form_data']); ?>
            </div>
        </div>
    </div>
</section>