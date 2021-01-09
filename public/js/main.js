$(function(){
    $('#form').on('submit', function(){
        var $this = $(this),
            btn = $this.find('button.submit');
        if(btn.hasClass('disabled')){

        }else{
            var data = $('#form').serialize(),
                btn = $('#submit');
            $.ajax({
                url: adminpath + '/messages/add',
                type: 'POST',
                data: data,
                beforeSend: function(){
                    btn.attr('disabled', true);
                },
                success: function(responce){
                        res = JSON.parse(responce);

                        if( res.answer == 'success' ){
                            window.location = adminpath + "/messages/outbox";
                        }else{
                            $('#answer').html(`<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    ${res.error}
                </div>`);
                        }

                        document.getElementById("form").reset();
                        $this.find('div.form-group').removeClass('has-success has-error has-danger');
                        $this.find('span.glyphicon').removeClass('glyphicon-remove glyphicon-ok');
                        $('#accept').prop('checked', false);
                        btn.attr('disabled', false);
                    // });
                },
                error: function(){
                    alert('Ошибка!');
                }
            });
        }
        return false;
    });

    if (document.getElementById('upload')) {
        var myDropzone = new Dropzone("div#upload", {
            addRemoveLinks: true,
            removedfile: function (file) {
                var name = file.name;

                $.ajax({
                    type: 'POST',
                    url: adminpath + '/messages/delete-files',
                    data: {"file": name},
                    success: function (res) {
                        var _ref;
                        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                    }
                })

            },
            paramName: "files",
            url: adminpath + "/messages/upload",
            maxFiles: 4,
            success: function (file, responce) {
                var url = file.dataURL,
                    res = JSON.parse(responce);
                if (res.answer == 'error') {
                    this.defaultOptions.error(file, res.error);
                    this.removeFile(file);
                    $('#answer').html(`<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    ${res.error}
                </div>`);
                } else {
                    this.defaultOptions.success(file);
                }
            },
            init: function () {
                $(this.element).html(this.options.dictDefaultMessage);
            },
            dictDefaultMessage: '<div class="dz-message">Нажмите здесь или перетащите файлы для загрузки. Можно загрузить 4 файла (до 4 Мб) форматов: .jpg, .jpeg, .png, .gif, .pdf</div>',
            dictInvalidFileType: 'Вы не можете загружать файлы данного типа. Разрешены: .jpg, .jpeg, .png, .gif, .pdf',
            dictMaxFilesExceeded: 'Вы  не можете загружать больше файлов',
            dictFileTooBig: 'Максимальный размер файла - 4 Мб',
            acceptedFiles: '.jpg, .jpeg, .png, .gif, .pdf',
            maxFilesize: 4
        });
    }

// Для простого пользователя

    $('#form').on('submit2', function(){
        var $this = $(this),
            btn = $this.find('button.submit');
        if(btn.hasClass('disabled')){

        }else{
            var data = $('#form').serialize(),
                btn = $('#submit');
            $.ajax({
                url: path + '/messages/add',
                type: 'POST',
                data: data,
                beforeSend: function(){
                    btn.attr('disabled', true);
                },
                success: function(responce){
                    res = JSON.parse(responce);

                    if( res.answer == 'success' ){
                        window.location = path + "/messages/outbox";
                    }else{
                        $('#answer').html(`<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    ${res.error}
                </div>`);
                    }

                    document.getElementById("form").reset();
                    $this.find('div.form-group').removeClass('has-success has-error has-danger');
                    $this.find('span.glyphicon').removeClass('glyphicon-remove glyphicon-ok');
                    $('#accept').prop('checked', false);
                    btn.attr('disabled', false);
                    // });
                },
                error: function(){
                    alert('Ошибка!');
                }
            });
        }
        return false;
    });

    if (document.getElementById('uploadfromuser')) {
        var myDropzone = new Dropzone("div#uploadfromuser", {
            addRemoveLinks: true,
            removedfile: function (file) {
                var name = file.name;

                $.ajax({
                    type: 'POST',
                    url: path + '/messages/delete-files',
                    data: {"file": name},
                    success: function (res) {
                        var _ref;
                        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                    }
                })

            },
            paramName: "files",
            url: path + "/messages/upload",
            maxFiles: 4,
            success: function (file, responce) {
                var url = file.dataURL,
                    res = JSON.parse(responce);
                if (res.answer == 'error') {
                    this.defaultOptions.error(file, res.error);
                    this.removeFile(file);
                    $('#answer').html(`<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    ${res.error}
                </div>`);
                } else {
                    this.defaultOptions.success(file);
                }
            },
            init: function () {
                $(this.element).html(this.options.dictDefaultMessage);
            },
            dictDefaultMessage: '<div class="dz-message">Нажмите здесь или перетащите файлы для загрузки. Можно загрузить 4 файла (до 4 Мб) форматов: .jpg, .jpeg, .png, .gif, .pdf</div>',
            dictInvalidFileType: 'Вы не можете загружать файлы данного типа. Разрешены: .jpg, .jpeg, .png, .gif, .pdf',
            dictMaxFilesExceeded: 'Вы  не можете загружать больше файлов',
            dictFileTooBig: 'Максимальный размер файла - 4 Мб',
            acceptedFiles: '.jpg, .jpeg, .png, .gif, .pdf',
            maxFilesize: 4
        });
    }
});