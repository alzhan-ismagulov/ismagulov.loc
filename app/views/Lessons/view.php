<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?=PATH;?>">Главная</a></li>
                <li class="breadcrumb-item"><a href="<?=ADMIN;?>">Панель</a></li>
                <li class="breadcrumb-item"><a href="<?=ADMIN;?>/lessons">Уроки</a></li>
                <li class="breadcrumb-item active">Просмотр урока</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
<p></p>
<!-- Main content -->
<div class="lesson__container">
    <div class="container">
        <div class="row lesson__row">
            <div class="col-md-12">
                <div class="lesson__title"><?=$lesson['title'];?></div>
                <div class="lesson__date"><?=$lesson['created'];?></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <img class="lesson__img" src="<?=PATH;?>/public/uploads/<?=$lesson['image'];?>" alt="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="lesson__description">
                    <?=$lesson['description'];?>
                </div>
            </div>
        </div>
        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="lesson__files">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Дополнительные материалы для изучения</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($filessons as $filesson):?>
                            <tr>
                                <td>
                                    <a href="<?=PATH;?>/uploads/<?=$filesson['alias'];?>"><?=$filesson['name'];?>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>