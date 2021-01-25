<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <!--            <h1 class="m-0 text-dark">Список заказов</h1>-->
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?=PATH;?>">Главная</a></li>
                <li class="breadcrumb-item"><a href="<?=ADMIN;?>">Панель</a></li>
                <li class="breadcrumb-item active">Отзыв №<?=$feedback['id'];?></li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Отзыв № <?=$feedback['id'];?>
                    </div>
                    <div class="col-md-12">
                        <img src="<?=PATH;?>/image/user-graduate-solid.svg" width="50px" alt="..." class="image_user">
                    </div>
                    <div class="col-md-12">
                        <div class="card-body">
                            <p class="card-title"><b><?=$feedback['name'];?></b></p>
                            <p class="card-text"><?=$feedback['text'];?></p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text"><small class="text-muted"><?=$feedback['created'];?></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>