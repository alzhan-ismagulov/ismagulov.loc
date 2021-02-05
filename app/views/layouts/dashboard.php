<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?=$this->getMeta();?>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?=PATH;?>/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=PATH;?>/public/css/upload.css">
    <link rel="stylesheet" href="<?=PATH;?>/public/css/style.css">
    <link rel="stylesheet" href="<?=PATH;?>/public/content-styles.css" type="text/css">
    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
<!--    <script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>-->
    <link rel="stylesheet" href="<?=PATH;?>/public/css/dropzone.css">
    <link rel="stylesheet" href="<?=PATH;?>/public/css/lesson.css">
    <link rel="stylesheet" href="<?=PATH;?>/adminlte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?=PATH;?>/adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?=PATH;?>/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?=PATH;?>/adminlte/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?=PATH;?>/adminlte/plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"><link rel="stylesheet" href="<?=PATH;?>/adminlte/plugins/jqvmap/jqvmap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!--favicon-->
    <link type="image/x-icon" rel="icon" href="<?=PATH;?>/favicon.ico"/>
    <link type="image/x-icon" rel="shortcut icon" href="<?=PATH;?>/favicon.ico"/>
    <!--/favicon-->
    <script async charset="utf-8" src="//cdn.embedly.com/widgets/platform.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/" class="nav-link">Главная</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?=PATH;?>/#description" class="nav-link">О курсе</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?=PATH;?>/#program" class="nav-link">Программа</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?=PATH;?>/#feedbacks" class="nav-link">Отзывы</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?=PATH;?>/#author" class="nav-link">Об авторе</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?=PATH;?>/#rates" class="nav-link">Курсы</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?=PATH;?>/#contacts" class="nav-link">Контакты</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?=PATH;?>/user/logout" class="nav-link">Выход</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-comments"></i>
<!--                    Показ непрочитанных сообщений в бэйдже-->
                        <?php
                            $user_id = $_SESSION['user']['id'];
//                            $unread_messages = R::count("messages", "messages.reading = '0'");
                            $unread_messages = R::count("messages", "messages.reciever = $user_id AND messages.reading = '0'");
                            if ($unread_messages){?>
                    <span class="badge badge-danger navbar-badge">
                            <?=$unread_messages;?>
                    </span>
                        <?}?>
                </a>
<!--                Показ количества непрочитанных сообщений в выпадающем меню-->
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <?php $unread_messages = R::getAll("SELECT 
                                                                    messages.id, 
                                                                    messages.sender = users.name, 
                                                                    messages.created,
                                                                    users.name 
                                                                    FROM messages
                                                                    JOIN users
                                                                    ON messages.sender = users.id 
                                                                    WHERE messages.reading = '0' 
                                                                    AND messages.reciever = $user_id");
                        foreach ($unread_messages as $unread_message):?>
                            <a href="<?=ADMIN;?>/messages/view?id=<?=$unread_message['id'];?>" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="<?=PATH;?>/adminlte/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
<!--                                    Имя отправителя-->
                                    <?=$unread_message['name'];?>
                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> <?=$unread_message['created'];
                                ?></p>
                            </div>
                        </div>
                            </a>
                        <!-- Message End -->
                        <?php endforeach;?>
                    <div class="dropdown-divider"></div>
                    <a href="<?=ADMIN;?>/messages" class="dropdown-item dropdown-footer">Просмотр всех сообщений</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
<!--                    Вывод непрочитанных запросов-->
                        <?php
                        $unread_requests = R::count("requests", "requests.reading = '0'");
                        if ($unread_requests){?>
                            <span class="badge badge-warning navbar-badge">
                            <?=$unread_requests;?>
                    </span>
                        <?}?>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">
                        <?php $requests = R::count("requests"); echo $requests?> запросов</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> <?=$unread_requests;?> Новых запросов
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="<?=ADMIN;?>/requests" class="dropdown-item dropdown-footer">Смотреть все запросы</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="<?=PATH;?>/admin" class="brand-link">
            <img src="<?=PATH;?>/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Панель управления</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?=PATH;?>/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?=$_SESSION['user']['name'];?></a>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Заказы
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=PATH;?>/admin/orders" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Список заказов</p>
                                </a>
                            </li>
                        </ul>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Курсы
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=PATH;?>/admin/courses" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Список курсов</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=PATH;?>/admin/courses/create" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Создать курс</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Файлы
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=PATH;?>/admin/files" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Добавить файлы</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Уроки
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=PATH;?>/admin/lessons" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Список уроков</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=PATH;?>/admin/lessons/create" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Создать урок</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Пользователи
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=ADMIN?>/users" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Список пользователей</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=ADMIN;?>/users/add" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Создать пользователя</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Сообщения
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=ADMIN;?>/messages/inbox" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Inbox</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=ADMIN;?>/messages/outbox" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Outbox</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=ADMIN;?>/messages/add" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Создать сообщение</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Запросы
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=ADMIN;?>/requests" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Все запросы</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Отзывы
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=ADMIN;?>/feedbacks" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Посмотреть отзывы</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- /.sidebar -->
    </aside>
    <p></p>
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <!-- /.content-header -->
                <div class="" name="alertMessage">
                    <div class="row">
                        <div class="col-md-12">
                            <?=alertMessage();?>
                        </div>
                    </div>
                </div>
                <?=$content;?>
            </div>
        </div>
    </div>
    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.0.4
        </div>
    </footer>
</div>
<script>
    var path = '<?=PATH;?>',
        adminpath = '<?=ADMIN;?>';
</script>

<script src="<?=PATH;?>/public/js/jquery-3.5.1.js"></script>
<script src="<?=PATH;?>/adminlte/dist/js/adminlte.js"></script>
<script src="<?=PATH;?>/public/js/dropzone.js"></script>
<script src="<?=PATH;?>/public/js/main.js"></script>
<!--<script src="/public/js/ajaxupload.js"></script>-->
<script src="<?=PATH;?>/public/js/my.js"></script>
<script src="<?=PATH;?>/public/js/bootstrap.js"></script>
<script src="<?=PATH;?>/public/js/core.js"></script>
<script src="<?=PATH;?>/public/js/upload.js"></script>

<script type="application/javascript">
    $().alert('close');
</script>

<!--CKEditor Media Embed-->
<script>
    document.querySelectorAll( 'oembed[url]' ).forEach( element => {
        const anchor = document.createElement( 'a' );
        anchor.setAttribute( 'href', element.getAttribute( 'url' ) );
        anchor.className = 'embedly-card';
        element.appendChild( anchor );
    } );
</script>
</body>
</html>