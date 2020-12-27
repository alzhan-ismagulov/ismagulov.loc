<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Просмотр сообщения</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?=PATH;?>">Главная</a></li>
                <li class="breadcrumb-item"><a href="<?=PATH;?>/users">Панель</a></li>
                <li class="breadcrumb-item"><a href="<?=PATH;?>/messages">Сообщения</a></li>
                <li class="breadcrumb-item active">Просмотр сообщения</li>
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
<!--                        <div class="card-title col-md-12"><h5>Кому: --><?//=$message['name'];?><!--</h5></div>-->
                        <div class="card-subtitle col-md-12 text-muted"><h6>Дата отправления:
                                <?=$message['created'];?></h6></div>
                        <hr>
                        <div class="card-text"><p><?=$message['text'];?></p></div>
                        <hr>
                        <a href="<?=PATH;?>/messages/add" class="btn btn-success">Ответить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>