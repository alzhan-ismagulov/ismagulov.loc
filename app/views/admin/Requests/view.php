<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Запрос №<?=$request['id'];?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?=PATH;?>">Главная</a></li>
                <li class="breadcrumb-item"><a href="<?=ADMIN;?>">Панель</a></li>
                <li class="breadcrumb-item"><a href="<?=ADMIN;?>/requests">Запросы</a></li>
                <li class="breadcrumb-item active">Просмотр запросов</li>
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
                        <table class="table table-bordered">
                            <tr><div class="card-title col-md-12"><h6>Отправитель: <?=$request['sender'];?></h6></div></tr>
                            <tr><div class="card-title col-md-12"><h6>Email: <a href="mailto:<?= $request['email']; ?>"><?= $request['email']; ?></h6></a></div></tr>
                            <tr><div class="card-title col-md-12"><h6>Дата отправления: <?=$request['created'];?></h6></div>
                            </tr>
                        </table>
                        <hr>
                        <div class="card-text"><p><?=$request['text'];?></p></div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>