<?php //session_destroy();?>
<?php //debug($_SESSION);?>
<!DOCTYPE html>
<html lang="en">
<head>
<base href="/">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="<?=PATH;?>/public/css/bootstrap.min.css">
<!--    fonawesome-->
    <link rel="stylesheet" href="<?=PATH;?>/public/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600;700;800&display=swap" rel="stylesheet">
    <title>ismagulova</title>
</head>
<body>
<!--<div class="alert-message" name="alertMessage">-->
<!--    <div class="row">-->
<!--        <div class="col-md-12">-->
<!--            --><?//=alertMessage();?>
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<div class="container__is">
    <div id="header" class="header">
        <div class="wrap banner">
            <div class="banner__top">
                <div class="banner__logo"><a href="/">ISMAGULOVA</a></div>
                <div class="banner__menu">
                    <div class="banner__menu-nav">
                        <ul class="banner__menu-ul">
                            <li class="banner__menu-li"><a class="banner__menu-link" href="<?=PATH;?>">ГЛАВНАЯ</a></li>
                            <li class="banner__menu-li"><a class="banner__menu-link" href="#description">О
                                    КУРСЕ</a></li>
                            <li class="banner__menu-li"><a class="banner__menu-link" href="#program">ПРОГРАММА</a></li>
                            <li class="banner__menu-li"><a class="banner__menu-link" href="#feedbacks">ОТЗЫВЫ</a></li>
                            <li class="banner__menu-li"><a class="banner__menu-link" href="#author">ОБ АВТОРЕ</a></li>
                            <li class="banner__menu-li"><a class="banner__menu-link" href="#rates">ТАРИФЫ</a></li>
                            <li class="banner__menu-li"><a class="banner__menu-link" href="<?=PATH;
                            ?>#contacts">КОНТАКТЫ</a></li>
                            <li class="banner__menu-li">
                                <?php if (isset($_SESSION['user']['name'])){?>
                                    <a class="banner__menu-link" href="<?php if ($_SESSION['user']['role'] ==
                                        'admin'){?>admin<?} else
                                        {?>user<?}?>"><?php echo $_SESSION['user']['name'];
                                    ?></a>
                                    <?php
                                } else {?>
                                <a class="banner__menu-link" href="<?=PATH;?>/signin"><span>Вход</span></a>
                                <?}?>
                            </li>
                            <li><a href="cart/show" onclick="getCart(); return false"><i class="fas
                            fa-shopping-cart"></i> </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="banner__info">
                <div class="banner__text">
                    <p class="banner__text-big">Финансовая <span>грамотность</span></p>
                    <p class="banner__text-small">для взрослых</p>
                </div>
                <div class="banner__btn">
                    <a href="#">Узнать больше</a>
                </div>
            </div>
        </div>
    </div>
    <div id="description" class="description">
        <div class="description__wrap">
            <div class="description__left">
                <p class="block__title">ОПИСАНИЕ <span>КУРСА</span></p>
                <p class="description__text">
                    Данный курс разработан с учетом особенностей Республики Казахстан.
                <p></p>
                Курс будет полезен:<br>
                - тем, кто хочет взять финансы под контроль<br>
                - кто хочет, чтобы заработанных денег хватало не только на текущие
                расходы, но и на долгосрочные накопления
                (пенсия, обучение детей)<br>
                - кто хочет изучить какие есть надежные способы увеличения дохода

                <p>На курсе вы научитесь:<br>
                    - анализировать свое финансовое положение<br>
                    - оптимизировать свои расходы<br>
                    - вести личный или семейный бюджет<br>
                    - ставить финансовые цели<br>
                    - разбираться в различных способах увеличения своего дохода</p>

                </p>
            </div>
            <div class="description__right"><picture><source srcset="image/baiterek.webp" type="image/webp"><img
                            src="image/baiterek.jpg" alt=""></picture></div>
        </div>
    </div>
    <div id="program" class="program">
        <div class="wrap">
            <div class="program__wrap">
                <p class="block__title">Программа <span>курса</span></p>
                <div class="element">
                    <div class="program__element">
                        <svg class="program__icon">
                            <use xlink:href="image/sprite.svg#img1"></use>
                            <!--                        <use xlink:href="#img1"></use>-->
                        </svg>
                        <div class="program__title">Личные финансы</div>
                        <div class="program__description">Активы и долговые обязательства</div>
                    </div>
                    <div class="program__element">
                        <svg class="program__icon">
                            <use xlink:href="image/sprite.svg#money"></use>
                            <!--                        <use xlink:href="#money"></use>-->
                        </svg>
                        <div class="program__title">Оптимизация расходов</div>
                        <div class="program__description">Составление личного (семейного бюджета)</div>
                    </div>
                    <div class="program__element">
                        <svg class="program__icon">
                            <use xlink:href="image/sprite.svg#analysis"></use>
                            <!--                        <use xlink:href="#analysis"></use>-->
                        </svg>
                        <div class="program__title">Финансовый план</div>
                        <div class="program__description">Расчёт на<br> 1-5-10 лет</div>
                    </div>
                    <div class="program__element">
                        <svg class="program__icon">
                            <use xlink:href="image/sprite.svg#rising"></use>
                        </svg>
                        <div class="program__title">Увеличение доходов</div>
                        <div class="program__description">Разные способы увеличения доходов</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="author" class="author">
        <div class="wrap">
            <div class="block__title">Об <span>авторе</span></div>
            <div class = "author__info">
                <div class="author__left">
                    <div class="author__photo">
                        <picture><source srcset="image/author.webp" type="image/webp"><img src="image/author.jpg"
                                                                                          alt=""></picture>
                    </div>
                </div>
                <div class="author__right">
                    <p class="author__title">Асемгуль Исмагулова</p>
                    <p class="author__description">Финансовый эксперт.<br> Более 15 лет опыта в финансовой сфере в
                        Казахстане и
                        Европе.</p>
                </div>
            </div>
        </div>
    </div>
    <div id="rates" class="rates">
        <div class="wrap rates__wrap">
            <div class="block__title"><span>Услуги</span></div>
            <div class="rates__block">
                <?php foreach($courses as $course):?>
                <div class="rates__element">
                    <div class="rates__title"><?=$course['name'];?></div>
                    <div class="rates__price ohra-price">
                        <?=$course['price'];?>
                    </div>
                    <ul class="rates__description list">
                        <li class="list__element"><?=$course['description'];?></li>
                    </ul>
                    <a id="courseAdd" data-id="<?=$course['id'];?>" href="cart/add?id=<?=$course['id'];?>"
                       class="rates__btn">Купить</a>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
    <div id="contacts" class="contacts">
        <div class=" wrap contacts__wrap">
            <div class="contacts__title">Связаться <span>со мной</span></div>
            <ul class="contacts__list">
                <li class="contacts__form form">
                    <form action="<?=PATH;?>/requests/add" name="message" method="post">
                        <div class="form__input">
                            <!--                            <label for="form-name">Имя</label>-->
                            <input type="text" id="form-sender" name="sender" placeholder="Введите имя" required>
                        </div>
                        <div class="form__input">
                            <!--                            <label for="form-email">E-mail</label>-->
                            <input type="email" id="form-email" name="email" placeholder="Введите email" required>
                        </div>
                        <div class="form__input">
                            <!--                            <label for="form-message">Сообщение</label>-->
                            <textarea id="form-message" name="text" placeholder="Введите сообщение" required></textarea>
                        </div>
                        <button type="submit" class="form__button" data-toggle="modal"
                                data-target="#myModal">Отправить</button>
                    </form>
                </li>
                <li class="contacts__map">
                    <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A046ec1e55a1c462506e44617c8edc0da8123450dc81d7384c29505a4bcf46147&amp;width=510&amp;height=425&amp;lang=ru_RU&amp;scroll=true"></script>
                </li>
            </ul>
        </div>
    </div>
    <footer class="footer">
        <div class="footer__wrap">
            <div class="footer__logo footer-block">ismagulova</div>
            <div class="footer__menu footer-block">
                <nav class="footer-menu">
                    <ul class="footer-menu__ul">
                        <li class="footer-menu__li"><a href="#header" class="footer-menu__link">ГЛАВНАЯ</a></li>
                        <li class="footer-menu__li"><a href="#description" class="footer-menu__link">О КУРСЕ</a></li>
                        <li class="footer-menu__li"><a href="#program" class="footer-menu__link">ПРОГРАММА</a></li>
                        <li class="footer-menu__li"><a href="#feedbacks" class="footer-menu__link">ОТЗЫВЫ</a></li>
                        <li class="footer-menu__li"><a href="#author" class="footer-menu__link">ОБ АВТОРЕ</a></li>
                        <li class="footer-menu__li"><a href="#rates" class="footer-menu__link">ТАРИФЫ</a></li>
                        <li class="footer-menu__li"><a href="#contacts" class="footer-menu__link">КОНТАКТЫ</a></li>
                    </ul>
                </nav>
            </div>
            <div class="social footer-block">
                <a href="https://www.instagram.com/assem_ismagulova/"><picture><source srcset="image/instagram2.svg"
                                                                                       type="image/webp"><img
                                src="image/instagram2.svg" alt=""></picture></a>
            </div>
        </div>
    </footer>

    <div class="up-arrow">
        <a href="<?=PATH;?>#header">
            <svg>
                <picture><source srcset="image/up-arrow.svg" type="image/webp"><image src="image/up-arrow.svg" alt=""
                                                                                   width="12px" height="12px"></picture>
            </svg>
        </a>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Корзина</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Продолжить покупки</button>
                <a href="cart/view" type="button" class="btn btn-primary">Оформить заказ</a>
                <button type="button" class="btn btn-danger" onclick="clearCart()">Очистить корзину</button>
            </div>
        </div>
    </div>
</div>

</div>
<?php
$logs = \R::getDatabaseAdapter()
    ->getDatabase()
    ->getLogger();
?>
<script src="<?=PATH;?>/public/js/jquery-3.5.1.js"></script>
<script src="<?=PATH;?>/public/js/bootstrap.js"></script>
<script src="<?=PATH;?>/public/js/cart.js"></script>
<!--fontawesome-->
<script src="<?=PATH;?>/public/js/all.js"></script>
<!--<script src="--><?//=PATH;?><!--js/script.min.js"></script>-->
</body>
</html>