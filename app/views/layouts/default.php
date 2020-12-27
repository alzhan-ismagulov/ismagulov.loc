<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/all.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
<!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>ismagulova</title>
</head>
<body>
<div class="container__is">
    <div class="signin__body">
        <header id="header" class="header">
            <div class="header__wrap">
                <div class="header__logo"><a href="/">ISMAGULOVA</a></div>
                <div class="header__menu">
                    <nav>
                        <ul>
                            <li><a href="/">ГЛАВНАЯ</a></li>
                            <li><a href="<?=PATH;?>#description">О КУРСЕ</a></li>
                            <li><a href="<?=PATH;?>#program">ПРОГРАММА</a></li>
                            <li><a href="<?=PATH;?>#feedbacks">ОТЗЫВЫ</a></li>
                            <li><a href="<?=PATH;?>#author">ОБ АВТОРЕ</a></li>
                            <li><a href="<?=PATH;?>#rates">ТАРИФЫ</a></li>
                            <li><a href="<?=PATH;?>#contacts">КОНТАКТЫ</a></li>
                        </ul>
                    </nav>
                </div><!--header__menu-->
                <div class="signin">
                            <?php if (isset($_SESSION['user']['name'])){
//                                echo $_SESSION['user']['name'];?>
                    <a href="user/logout"> Выход</a><?php
                            } else {?>
                    <a href="<?=PATH;?>/signin"><span>Вход</span></a>
                            <?php } ?>
                        </div>
            </div><!--header__wrap-->
        </header>
        <div class="" name="alertMessage">
            <div class="row">
                <div class="col-md-12">
                    <?=alertMessage();?>
                </div>
            </div>
        </div>
        <?=$content;?>
    </div>
        <footer class="footer">
            <div class="footer__wrap">
                <div class="footer__logo footer-block">ismagulova</div>
                <div class="footer__menu footer-block">
                    <nav>
                        <ul>
                            <li><a href="<?=PATH;?>#header">ГЛАВНАЯ</a></li>
                            <li><a href="<?=PATH;?>#description">О КУРСЕ</a></li>
                            <li><a href="<?=PATH;?>#program">ПРОГРАММА</a></li>
                            <li><a href="<?=PATH;?>#feedbacks">ОТЗЫВЫ</a></li>
                            <li><a href="<?=PATH;?>#author">ОБ АВТОРЕ</a></li>
                            <li><a href="<?=PATH;?>#rates">ТАРИФЫ</a></li>
                            <li><a href="<?=PATH;?>#contacts">КОНТАКТЫ</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="social footer-block">
                    <a href="https://www.instagram.com/assem_ismagulova/"><picture><source srcset="img/instagram2.svg" type="image/webp"><img src="img/instagram2.svg" alt=""></picture></a>
                </div>
            </div>
        </footer>
</div>
        <script src="/public/js/jquery-3.5.1.min.js"></script>
        <script src="/public/js/validator.min.js"></script>
        <script src="/public/js/popper.min.js"></script>
        <script src="/public/js/bootstrap.min.js"></script>
        <script type="application/javascript">
            var tId;
            $("#messageBox").hide().slideDown();
            clearTimeout(tId);
            tId=setTimeout(function(){
                $("#messageBox").hide();
            }, 3000);
        </script>
        <script type="application/javascript">
            $('#loginModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var recipient = button.data('whatever') // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('Аутентификация ')
                modal.find('.modal-body input').val(recipient)
            })
        </script>
</body>
</html>