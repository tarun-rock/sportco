<?php
if(!empty($_POST) && $_POST['ajax'] == 1)
{
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $msg = trim($_POST['msg']);

    if(($name != null) && ($email != null) && ($subject != null) && ($msg != null))
    {

        $message = "Hi,\n\n";

        $message.= "You have a new contact request on sportco.io : \n\n";

        $message.= "Name : ".$name." \n\n";

        $message.= "Email : ".$email." \n\n";

        $message.= "Subject : ".$subject." \n\n";

        $message.= "Message : ".$msg." \n\n";

        $message.= "Thanks \n\n";

        $senderMail = "info@sportco.io";

        $headers = "From: no-reply@sportco.io" . "\r\n";

        //$senderMail = "business@sportswizz.com";

        $subject = "Contact Request On SportCo";

        mail($senderMail,$subject, $message, $headers);

        echo 1; exit;

    }
    else
    {
        echo 0; exit;
    }

}
if(!empty($_POST) && $_POST['ajax'] == 2)
{
    $sub_email = trim($_POST['sub_email']);

    if($sub_email != null)
    {
        // our email
        $our_message = "Hi,\n\n";

        $our_message.= "You have a new subscriber on sportco.io : \n\n";

        $our_message.= "Email : ".$sub_email." \n\n";

        $our_message.= "Thanks \n\n";

        $senderMail = "info@sportco.io";

        $headers = "From: no-reply@sportco.io" . "\r\n";

        //$senderMail = "business@sportswizz.com";

        $subject = "New Subscriber On SportCo";

        mail($senderMail,$subject, $our_message, $headers);

        //subscriber email

        $sub_msg = "Hi,\n\n";

        $sub_msg.= "Thank you for subscribing to the sportco newsletter \n\n";

        $sub_msg.= "Best Wishes \n\n";

        $sub_msg.= "SPORTCO \n\n";

        $headers = "From: no-reply@sportco.io" . "\r\n";

        //$senderMail = "business@sportswizz.com";

        $subject = "Newsletter Subscription";

        mail($sub_email,$subject, $sub_msg, $headers);

        echo 1; exit;

    }
    else
    {
        echo 0; exit;
    }

}
?> <?php include('header.php');?>
 
 <header class="masthead">
 <div class="col-md-12">
 <div class="row"> 
 <div id="demo" class="carousel slide" data-ride="carousel">
 <ul class="carousel-indicators">
 <li data-target="#demo" data-slide-to="0" class="active"></li>
 <li data-target="#demo" data-slide-to="1"></li>
 <li data-target="#demo" data-slide-to="2"></li>
 </ul>
 <div class="carousel-inner">
 <div class="carousel-item active">
 <img src="img/header_01.jpg" class="img-fluid">
 <div class="carousel-caption">
 <h1 class="text-uppercase centered section-carousel-heading">ПРИСОЕДИНЯЙТЕСЬ к 500-тысячному спортивному сообществу</h1>
 </div>
 </div>
 <div class="carousel-item">
 <img src="img/header_02.jpg" class="img-fluid">
 <div class="carousel-caption">
 <h1 class="text-uppercase centered section-carousel-heading">МЫ ВОЗНАГРАЖДАЕМ ЛЮБОВЬ К СПОРТУ</h1>
 </div>
 </div>
 <div class="carousel-item">
 <img src="img/header_03.jpg" class="img-fluid">
 <div class="carousel-caption">
 <h1 class="text-uppercase centered section-carousel-heading">Оставайтесь на связи со спортивными фанатами со всего мира</h1>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </header>

 
 <section class="bg-light" id="ourtoken">
 <div class="container">
 <div class="row">
 <div class="col-lg-12 text-center">
 <p class="text-center text-uppercase section-small-heading">наши токены</p><br>&nbsp;
          </div>
 </div>
 <div class="row text-center tech_row">
 <div class="col-md-4">
 <img src="img/utility.png" class="img-fluid">
 <h4 class="service-heading text-capitalize">Утилитарный токен</h4>
 <p class="text-muted">Токен, который можно использовать для покупки спортивной атрибутики, сувениров и билетов на нашей торговой онлайн-площадке</p>
 </div>
 <div class="col-md-4">
 <img src="img/sportsglobal.png" class="img-fluid">
 <h4 class="service-heading text-capitalize">Ценностный токен</h4>
 <p class="text-muted">Токен, который может использоваться для приобретения членства в Глобальном клубе SPORTCO</p>
 </div>
 <div class="col-md-4">
 <img src="img/bumper_winner.png" class="img-fluid">
 <h4 class="service-heading text-capitalize">Участие в спортивных турнирах</h4>
 <p class="text-muted">Вы можете использовать этот токен, чтобы принять участие в СПОРТИВНЫХ турнирах и получить шанс выиграть ценные призы</p>
 </div>
 </div>
 <div class="row text-center tech_row">
 <div class="col-md-4">
 <img src="img/payouts.png" class="img-fluid">
 <h4 class="service-heading text-capitalize">Регулярные выплаты</h4>
 <p class="text-muted">Получайте регулярные выплаты на свой кошелек SPORTCO за добавление контента или достижение важного уровня активности</p>
 </div>
 <div class="col-md-4">
 <img src="img/sportsgroup.png" class="img-fluid">
 <h4 class="service-heading text-capitalize">Магазин SPORTCO</h4>
 <p class="text-muted">Используйте токены для торговли с партнерскими спортивными группами и биржами</p>
 </div>
 <div class="col-md-4">
 <img src="img/peer-to-peer.png" class="img-fluid">
 <h4 class="service-heading text-capitalize">Обмен токенами</h4>
 <p class="text-muted">Вы можете обмениваться токенами с другими фанатами спорта на наших спортивных площадках для конкурсов или поставить их на кон в любой из наших спортивных игр.</p>
 </div>
 </div>
 </div>
 </section>

 <section class="video_holder">
 <div id="video_section"></div>
 <div class="videoCover">
 <img src="img/videobanner.png" class="img-fluid video-banner centered">
 <div class="video-btn-holder">
 <img src="img/playBtn.png" class="btn-play centered">
 </div>
 </div>
 </section>

 
 <section id="distribution" class="navy-bg">
 <div class="container">
 <div class="row">
 <div class="col-lg-12 text-center">
 <p class="text-center text-uppercase section-small-heading">РАСПРЕДЕЛЕНИЕ ТОКЕНОВ</p><br>&nbsp;
                </div>
 </div>
 <div class="row">
 <div class="container-fluid">
 <div class="row">
 <div class="col-md-6 col-sm-6 col-xs-12" style="margin: 0px auto;text-align: center;">
 <div class="padding-top-60 padding-left-60">
 <img src="img/logo4x.png" class="img-fluid col-md-9 centered">
 <div class="row clear padding-top-60"></div>
 <a class="btn btn-xl text-uppercase btn-wp" href="assets/whitepaper.pdf" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;WHITEPAPER&nbsp;&nbsp;&nbsp;&nbsp;</a><br>&nbsp;<br>
 <a class="btn btn-warning btn-xl text-uppercase" href="http://eepurl.com/dhQLwD" target="_blank">ЗАРЕЗЕРВИРОВАТЬ</a>
 </div>
 </div>
 <div class="col-md-6 col-sm-6 col-xs-12 light_div">
 <div style="clear: both;content: ' ';display: table"></div>
 <div class="yellow_box">
 <h5>ТОКЕНЫ ДЛЯ ФИНАНСИРОВАНИЯ СООБЩЕСТВА</h5>
 <span class="large_no">250 000 000</span>
 </div>
 <hr>
 <div class="">
 <h5>ЦЕНА ДО ICO</h5>
 <div style="clear: both;content: ' ';display: table"></div>

 <p class="trade_rate">1 ETH = 8 000 токенов SPORTCO</p>
 <div style="clear: both;content: ' ';display: table"></div>
 <p>Покупайте наши токены за криптовалюту</p>
 <div style="clear: both;content: ' ';display: table"></div>
 </div>
 <hr>
 <div class="">
 <h5>ЦЕНА НА ICO</h5>
 <p class="trade_rate">1 ETH = 5 000 токенов SPORTCO</p>
 <p>Покупайте наши токены за ETH</p>
 <div style="clear: both;content: ' ';display: table"></div>
 </div>

 </div>
 </div>
 </div>
 </div>
 </div>
 </section>


 <section id="raised">
 <div class="container">
 <div class="row">
 <div class="col-lg-12 text-center">
 <p class="text-center text-uppercase section-small-heading">ВСЕГО СОБРАНО</p><br>&nbsp;
                </div>
 </div>
 <div class="row">
 <div class="cx-skill col-md-4 offset-md-4">
 <div class="cx-skill-inner">
 
 <div class="cx-single-skill">
 <div class="row">
 <div class="col-md-6">
 <p class="current-coin" data-current="15000000"><strong>150 000</strong> долларов США</p>
 </div>
 <div class="col-md-6">
 <p class="text-right total-coin" data-total="20000000"><strong>20 000 000</strong> долларов США</p>
 </div>
 </div>
 <div class="row">
 <div class="col-md-12">
 <div class="progress progress-big">
 <div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay=".5s" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="visibility: visible; animation-duration: 0.8s; animation-delay: 0.5s; animation-name: fadeInLeft;">
 </div>
 </div>
 </div>
 </div>
 </div>
 
 </div>
 </div>
 </div>
 </div>
 </section>

 
 <section class="bg-light" id="param">
 <div class="container">
 <div class="row">
 <div class="col-lg-12 text-center">
 <p class="text-center text-uppercase section-small-heading">ПАРАМЕТРЫ КРАУДФАНДИНГА И РАСПРЕДЕЛЕНИЕ ТОКЕНОВ</p><br>&nbsp;
          </div>
 </div>
 <div class="row text-center m-b-50">
 <div class="col-md-4">
 <h4 class="service-heading">ДО ICO</h4>
 <p class="text-muted">Токены, не проданные на преварительном этапе (до ICO), будут добавлены в ICO.</p>
 </div>
 <div class="col-md-4">
 <h4 class="service-heading">ICO</h4>
 <p class="text-muted">По окончании ICO неиспользованные токены будут внесены в призовой фонд.</p>
 </div>
 <div class="col-md-4">
 <h4 class="service-heading">SPORTCO</h4>
 <span><strong>Кол-во токенов: </strong>500 000 000</span><br>
 <span><strong>Знаков после запятой: </strong>5</span><br>
 <span><strong>Символ: </strong>SPRT</span><br>
 <span><strong>Блокчейн: </strong>Ethereum</span>
 </div>
 </div>
 <div class="row">
 <div class="container-fluid">
 <img src="img/token-allocation-trans.png" class="img-fluid centered">
 </div>
 </div>
 </section>

 <section>
 <div class="container">
 <div class="row">
 <div class="col-lg-12 text-center">
 <p class="text-center text-uppercase section-small-heading">ОСНОВНЫЕ ЭТАПЫ И ПРОГРЕСС</p><br>&nbsp;
            </div>
 </div>
 <div class="row">
 <div class="cx-skill">
 <div class="cx-skill-inner">
 
 <div class="cx-single-skill">
 <p>РАЗРАБОТКА ТЕХНОЛОГИИ СПОРТИВНЫХ ПРОДУКТОВ&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span class="progress-bold">4 мес.</span></strong></p>
 <div class="row">
 <div class="col-md-12">
 <div class="progress">
 <div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay=".5s" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%; visibility: visible; animation-duration: 0.8s; animation-delay: 0.5s; animation-name: fadeInLeft;">
 </div>
 </div>
 </div>
 </div>
 </div>
 
 
 <div class="cx-single-skill">
 <p>УСКОРЕННОЕ УВЕЛИЧЕНИЕ ЧИСЛА СПОРТИВНЫХ СООБЩЕСТВ&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span class="progress-bold">5 мес.</span></strong></p>
 <div class="row">
 <div class="col-md-12">
 <div class="progress">
 <div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay=".5s" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%; visibility: visible; animation-duration: 0.8s; animation-delay: 0.5s; animation-name: fadeInLeft;">
 </div>
 </div>
 </div>
 </div>
 </div>
 
 
 <div class="cx-single-skill">
 <p>СОЗДАНИЕ ТОРГОВОЙ ОНЛАЙН-ПЛОЩАДКИ SPORTCO&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span class="progress-bold">3 мес.</span></strong></p>
 <div class="row">
 <div class="col-md-12">
 <div class="progress">
 <div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay=".6s" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%; visibility: visible; animation-duration: 0.8s; animation-delay: 0.6s; animation-name: fadeInLeft;">
 </div>
 </div>
 </div>
 </div>
 </div>
 
 
 <div class="cx-single-skill">
 <p>ЗАПУСК ПРОЕКТА &quot;ЗНАКОМСТВО С ЧЕМПИОНАМИ&quot; (DISCOVER THE CHAMPS)&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span class="progress-bold">1 мес.</span></strong></p>
 <div class="row">
 <div class="col-md-12">
 <div class="progress">
 <div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay=".7s" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%; visibility: visible; animation-duration: 0.8s; animation-delay: 0.7s; animation-name: fadeInLeft;">
 </div>
 </div>
 </div>
 </div>
 </div>
 
 
 <div class="cx-single-skill">
 <p>ДОБАВЛЕНИЕ НОВЫХ МИРОВЫХ И РЕГИОНАЛЬНЫХ ВИДОВ СПОРТА&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span class="progress-bold">3 мес.</span></strong></p>
 <div class="row">
 <div class="col-md-12">
 <div class="progress">
 <div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay=".7s" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%; visibility: visible; animation-duration: 0.8s; animation-delay: 0.7s; animation-name: fadeInLeft;">
 </div>
 </div>
 </div>
 </div>
 </div>
 
 
 <div class="cx-single-skill">
 <p>СОЗДАНИЕ СПОРТИВНОЙ СТУДИИ SPORTS STUDIO, В КОТОРОЙ ФАНАТЫ МОГУТ ИСПОЛЬЗОВАТЬ ТЕХНОЛОГИИ ДОПОЛНЕННОЙ РЕАЛЬНОСТИ И SWARM&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span class="progress-bold">2 мес.</span></strong></p>
 <div class="row">
 <div class="col-md-12">
 <div class="progress">
 <div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay=".7s" role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="width: 67%; visibility: visible; animation-duration: 0.8s; animation-delay: 0.7s; animation-name: fadeInLeft;">
 </div>
 </div>
 </div>
 </div>
 </div>
 
 
 <div class="cx-single-skill">
 <p>СПОРТИВНАЯ СТАТИСТИКА И ПРОГНОЗЫ РЕЗУЛЬТАТОВ НА ОСНОВЕ ИСКУССТВЕННОГО ИНТЕЛЛЕКТА&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span class="progress-bold">4 мес.</span></strong></p>
 <div class="row">
 <div class="col-md-12">
 <div class="progress">
 <div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay=".7s" role="progressbar" aria-valuenow="84" aria-valuemin="0" aria-valuemax="100" style="width: 84%; visibility: visible; animation-duration: 0.8s; animation-delay: 0.7s; animation-name: fadeInLeft;">
 </div>
 </div>
 </div>
 </div>
 </div>
 
 
 <div class="cx-single-skill">
 <p>ПРОГРАММА ВОЗНАГРАЖДЕНИЯ АКТИВНОСТИ И РАСПРЕДЕЛЕНИЯ СПОРТИВНОЙ АТРИБУТИКИ НА ОСНОВЕ ТЕХНОЛОГИИ БЛОКЧЕЙНА&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span class="progress-bold">3 мес.</span></strong></p>
 <div class="row">
 <div class="col-md-12">
 <div class="progress">
 <div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay=".7s" role="progressbar" aria-valuenow="71" aria-valuemin="0" aria-valuemax="100" style="width: 71%; visibility: visible; animation-duration: 0.8s; animation-delay: 0.7s; animation-name: fadeInLeft;">
 </div>
 </div>
 </div>
 </div>
 </div>
 
 </div>
 </div>
 </div>
 </section>

 
 <section id="timeline" class="navy-bg">
 <div class="container">
 <div class="row">
 <div class="col-lg-12 text-center">
 <p class="text-center text-uppercase section-small-heading">Хронология событий</p><br>&nbsp;
              </div>
 <div class="col-lg-12">
 <img src="img/timeline.png" class="img-fluid">
 </div>
 <div class="col-lg-12">
 <div class="row">
 <div class="col-lg-2 offset-lg-5 m-t-60">
 <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger centered" href="timeline.php" target="_blank">ПОДРОБНЕЕ</a>
 </div>
 </div>
 </div>
 </div>
 </div>
 </section>

 <section id="team">
 <div class="container">
 <div class="row">
 <div class="col-lg-12 text-center">
 <p class="text-uppercase text-center">команда sportco</p>
 <p class="service-heading">Совокупный опыт работы в бизнесе участников нашей команды превышает 200 лет, а их мотивация и профессиональные качества обеспечат реализацию идеи и успех бизнеса.</p><br>&nbsp;
            </div>
 </div>
 <div class="row">
 <div class="container">

 <div id="teamCarousel" class="carousel slide desk-div" data-ride="carousel">
 <ol class="carousel-indicators">
 <li data-target="#teamCarousel" data-slide-to="0" class="active"></li>
 <li data-target="#teamCarousel" data-slide-to="1"></li>
 <li data-target="#teamCarousel" data-slide-to="2"></li>
 </ol>
 <div class="carousel-inner" role="listbox">
 
 <div class="carousel-item active">
 <div class="col-md-12">
 <div class="row">
 
 <div class="col-md-4">
 <div class="team-box" data-toggle="modal" data-target="#teamModal" data-order="0">
 <div class="box-upper">
 <img src="img/team/01.png" class="img-responsive col-md-8 col-xs-12 centered">
 </div>
 <div class="box-med">
 <h3>Анудж Шарма</h3>
 <p class="text-uppercase">Учредитель и коммерческий руководитель</p>
 <br>
 <p>&nbsp;</p>
 </div>
 <div class="box_lower">
 <div class="col-md-12">
 <div class="row">
 <div class="col-md-6">
 <ul class="team-social-list">
 <li><a href="https://www.linkedin.com/in/anujsharma17/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
 </ul>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 
 
 <div class="col-md-4">
 <div class="team-box" data-toggle="modal" data-target="#teamModal" data-order="1">
 <div class="box-upper">
 <img src="img/team/03.png" class="img-responsive col-md-8 col-xs-12 centered">
 </div>
 <div class="box-med">
 <h3>Профессор Георгис Гиаглис</h3>
 <p class="text-uppercase">Ведущий консультант</p>
 <br>
 <p>&nbsp;</p>
 </div>
 <div class="box_lower">
 <div class="col-md-12">
 <div class="row">
 <div class="col-md-6">
 <ul class="team-social-list">
 <li><a href="https://www.linkedin.com/in/georgegiaglis/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
 </ul>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 
 
 <div class="col-md-4">
 <div class="team-box" data-toggle="modal" data-target="#teamModal" data-order="2">
 <div class="box-upper">
 <img src="img/team/08.png" class="img-responsive col-md-8 col-xs-12 centered">
 </div>
 <div class="box-med">
 <h3>Фирозе Могрелиа</h3>
 <p class="text-uppercase">Старший консультант</p>
 <br>
 <p>&nbsp;</p>
 </div>
 <div class="box_lower">
 <div class="col-md-12">
 <div class="row">
 <div class="col-md-6">
 <ul class="team-social-list">
 <li><a href="https://www.linkedin.com/in/phirozemogrelia/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
 </ul>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 
 </div>
 </div>
 </div>
 
 
 <div class="carousel-item">
 <div class="col-md-12">
 <div class="row">
 
 <div class="col-md-4">
 <div class="team-box" data-toggle="modal" data-target="#teamModal" data-order="3">
 <div class="box-upper">
 <img src="img/team/04.png" class="img-responsive col-md-8 col-xs-12 centered">
 </div>
 <div class="box-med">
 <h3>Малика Дживан</h3>
 <p class="text-uppercase">Корпоративный консультант</p>
 <br>
 <p>&nbsp;</p>
 </div>
 <div class="box_lower">
 <div class="col-md-12">
 <div class="row">
 <div class="col-md-6">
 <ul class="team-social-list">
 <li><a href="https://www.linkedin.com/in/malika-jivan-1740026/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
 </ul>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 
 
 <div class="col-md-4">
 <div class="team-box" data-toggle="modal" data-target="#teamModal" data-order="4">
 <div class="box-upper">
 <img src="img/team/05.png" class="img-responsive col-md-8 col-xs-12 centered">
 </div>
 <div class="box-med">
 <h3>Хуан Карлос Багена</h3>
 <p class="text-uppercase">Спортивный консультант</p>
 <br>
 <p>&nbsp;</p>
 </div>
 <div class="box_lower">
 <div class="col-md-12">
 <div class="row">
 <div class="col-md-6">
 <ul class="team-social-list">
 <li><a href="https://www.linkedin.com/in/juan-carlos-b%C3%A1guena-902406b/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
 </ul>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 
 
 <div class="col-md-4">
 <div class="team-box" data-toggle="modal" data-target="#teamModal" data-order="5">
 <div class="box-upper">
 <img src="img/team/07.png" class="img-responsive col-md-8 col-xs-12 centered">
 </div>
 <div class="box-med">
 <h3>Д-р Риши Шарма</h3>
 <p class="text-uppercase">Консультант по статистике и ИИ</p>
 <br>
 <p>&nbsp;</p>
 </div>
 <div class="box_lower">
 <div class="col-md-12">
 <div class="row">
 <div class="col-md-6">
 <ul class="team-social-list">
 <li><a href="https://www.linkedin.com/in/rishi-sharma-5aa6108" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
 </ul>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 
 </div>
 </div>
 </div>
 
 
 <div class="carousel-item">
 <div class="col-md-12">
 <div class="row">
 
 <div class="col-md-4 offset-md-4">
 <div class="team-box" data-toggle="modal" data-target="#teamModal" data-order="6">
 <div class="box-upper">
 <img src="img/team/06.png" class="img-responsive col-md-8 col-xs-12 centered">
 </div>
 <div class="box-med">
 <h3>Кулдип Лал</h3>
 <p class="text-uppercase">Медиаконсультант</p>
 <br>
 <p>&nbsp;</p>
 </div>
 <div class="box_lower">
 <div class="col-md-12">
 <div class="row">
 <div class="col-md-6">
 <ul class="team-social-list">
 <li><a href="https://mobile.twitter.com/diplal?lang=en" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
 </ul>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 
 </div>
 </div>
 </div>
 
 </div>

 </div>

 <div id="teamMobCarousel" class="carousel slide mob-div col-sm-9 centered" data-ride="carousel">

 <div class="carousel-inner" role="listbox">
 
 <div class="carousel-item active">
 
 <div class="team-box" data-toggle="modal" data-target="#teamModal" data-order="0">
 <div class="box-upper">
 <img src="img/team/01.png" class="img-responsive col-md-8 centered">
 </div>
 <div class="box-med">
 <h3>Анудж Шарма</h3>
 <p class="text-uppercase">Учредитель и коммерческий руководитель</p>
 <br>
 <p>&nbsp;</p>
 </div>
 <div class="box_lower">
 <div class="col-md-12">
 <div class="row">
 <div class="col-md-6">
 <ul class="team-social-list">
 <li><a href="https://www.linkedin.com/in/anujsharma17/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
 </ul>
 </div>
 </div>
 </div>
 </div>
 </div>
 
 </div>
 <div class="carousel-item">
 
 <div class="team-box" data-toggle="modal" data-target="#teamModal" data-order="1">
 <div class="box-upper">
 <img src="img/team/03.png" class="img-responsive col-md-8 centered">
 </div>
 <div class="box-med">
 <h3>Профессор Георгис Гиаглис</h3>
 <p class="text-uppercase">Ведущий консультант</p>
 <br>
 <p>&nbsp;</p>
 </div>
 <div class="box_lower">
 <div class="col-md-12">
 <div class="row">
 <div class="col-md-6">
 <ul class="team-social-list">
 <li><a href="https://www.linkedin.com/in/georgegiaglis/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
 </ul>
 </div>
 </div>
 </div>
 </div>
 </div>
 
 </div>
 <div class="carousel-item">
 
 <div class="team-box" data-toggle="modal" data-target="#teamModal" data-order="2">
 <div class="box-upper">
 <img src="img/team/08.png" class="img-responsive col-md-8 centered">
 </div>
 <div class="box-med">
 <h3>Фирозе Могрелиа</h3>
 <p class="text-uppercase">Старший консультант</p>
 <br>
 <p>&nbsp;</p>
 </div>
 <div class="box_lower">
 <div class="col-md-12">
 <div class="row">
 <div class="col-md-6">
 <ul class="team-social-list">
 <li><a href="https://www.linkedin.com/in/phirozemogrelia/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
 </ul>
 </div>
 </div>
 </div>
 </div>
 </div>
 
 </div>
 <div class="carousel-item">
 
 <div class="team-box" data-toggle="modal" data-target="#teamModal" data-order="3">
 <div class="box-upper">
 <img src="img/team/04.png" class="img-responsive col-md-8 centered">
 </div>
 <div class="box-med">
 <h3>Малика Дживан</h3>
 <p class="text-uppercase">Корпоративный консультант</p>
 <br>
 <p>&nbsp;</p>
 </div>
 <div class="box_lower">
 <div class="col-md-12">
 <div class="row">
 <div class="col-md-6">
 <ul class="team-social-list">
 <li><a href="https://www.linkedin.com/in/malika-jivan-1740026/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
 </ul>
 </div>
 </div>
 </div>
 </div>
 </div>
 
 </div>
 <div class="carousel-item">
 
 <div class="team-box" data-toggle="modal" data-target="#teamModal" data-order="4">
 <div class="box-upper">
 <img src="img/team/05.png" class="img-responsive col-md-8 centered">
 </div>
 <div class="box-med">
 <h3>Хуан Карлос Багена</h3>
 <p class="text-uppercase">Спортивный консультант</p>
 <br>
 <p>&nbsp;</p>
 </div>
 <div class="box_lower">
 <div class="col-md-12">
 <div class="row">
 <div class="col-md-6">
 <ul class="team-social-list">
 <li><a href="https://www.linkedin.com/in/juan-carlos-b%C3%A1guena-902406b/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
 </ul>
 </div>
 </div>
 </div>
 </div>
 </div>
 
 </div>
 <div class="carousel-item">
 
 <div class="team-box" data-toggle="modal" data-target="#teamModal" data-order="5">
 <div class="box-upper">
 <img src="img/team/07.png" class="img-responsive col-md-8 centered">
 </div>
 <div class="box-med">
 <h3>Д-р Риши Шарма</h3>
 <p class="text-uppercase">Консультант по статистике и ИИ</p>
 <br>
 <p>&nbsp;</p>
 </div>
 <div class="box_lower">
 <div class="col-md-12">
 <div class="row">
 <div class="col-md-6">
 <ul class="team-social-list">
 <li><a href="https://www.linkedin.com/in/rishi-sharma-5aa6108" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
 </ul>
 </div>
 </div>
 </div>
 </div>
 </div>
 
 </div>
 <div class="carousel-item">
 
 <div class="team-box" data-toggle="modal" data-target="#teamModal" data-order="6">
 <div class="box-upper">
 <img src="img/team/06.png" class="img-responsive col-md-8 centered">
 </div>
 <div class="box-med">
 <h3>Кулдип Лал</h3>
 <p class="text-uppercase">Медиаконсультант</p>
 <br>
 <p>&nbsp;</p>
 </div>
 <div class="box_lower">
 <div class="col-md-12">
 <div class="row">
 <div class="col-md-6">
 <ul class="team-social-list">
 <li><a href="https://mobile.twitter.com/diplal?lang=en" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
 </ul>
 </div>
 </div>
 </div>
 </div>
 </div>
 
 </div>
 </div>
 </div>

 </div>
 </div>
 </div>
</section>

 <section class="navy-bg" id="news">
 <div class="container">
 <div class="row">
 <div class="col-lg-12 text-center">
 <p class="text-center text-uppercase section-small-heading">О НАС ПИШУТ</p><br>&nbsp;
                </div>
 </div>
 <div class="row text-center tech_row mb-2">
 <div class="col-md-3">
 <a href="http://bunews.com.ua/opinion/item/opinion-will-the-initial-coin-offering-bubble-burst" target="_blank"><img src="img/logo-bunews.png" class="img-fluid centered partners"></a>
 </div>
 <div class="col-md-3">
 <a href="http://lvivtoday.com.ua/lviv-business/5076" target="_blank"><img src="img/logo_lviv.png" class="img-fluid centered partners"></a>
 </div>
 <div class="col-md-3">
 <a href="<?= siteurl();?>news/digital-journal.php" target="_blank"><img src="img/digi-journal-logo.png" class="img-fluid centered partners"></a>
 </div>
 <div class="col-md-3">
 <a href="https://sportuptr.com/spor-sitesi-takipcilerine-kripto-para-dagitacak/" target="_blank"><img src="img/logo_sportup.png" class="img-fluid centered partners"></a>
 </div>
 </div>
 <div class="row text-center tech_row">
 <div class="col-md-4">
 <a href="https://netleaders.news/2018/02/08/blockchain-plays-role-in-community-inspired-sports-project/" target="_blank"><img src="img/logo_netleaders.png" class="img-fluid centered partners"></a>
 </div>
 <div class="col-md-4">
 <a href="https://www.mediapost.com/publications/article/314189/blockchain-enters-sports-world-to-spur-engagement.html" target="_blank"><img src="img/logo_mediapost.png" class="img-fluid centered partners"></a>
 </div>
 <div class="col-md-4">
 <a href="https://www.devicedaily.com/pin/__trashed-80/" target="_blank"><img src="img/devicedaily.png" class="img-fluid centered partners"></a>
 </div>
 </div>
 </div>
 </section>

 <section id="partners" class="bg-light">
 <div class="container">
 <div class="row">
 <div class="col-lg-12 text-center">
 <p class="text-center text-uppercase section-small-heading">НАШИ ПАРТНЕРЫ</p><br>&nbsp;
          </div>
 </div>
 <div class="row m-b-30">
 <div class="col-md-3">
 <h4 class="service-heading"><a href="http://www.fincapadvisers.com/">FInCap</a></h4>
 <hr>
 <p class="text-muted">FInCap — ведущая финансово-юридическая фирма. SportCo в сотрудничестве с FInCap разрабатывает план увеличения капитала.</p>
 </div>
 <div class="col-md-3">
 <h4 class="service-heading"><a href="http://sportswizzleague.com/">SportsWizz League</a></h4>
 <hr>
 <p class="text-muted">Команда разработчиков технологий, продуктов и спортивных материалов, предоставляющая SportCo необходимые нам спортивные продукты и услуги с использованием соответствующих технологий.</p>
 </div>
 <div class="col-md-3">
 <h4 class="service-heading">TechFinancials</h4>
 <hr>
 <p class="text-muted">TechFinancials — ведущая европейская финансово-технологическая компания. SportCo в сотрудничестве с TechFinancials занимается усовершенствованием и интеграцией биржи токенов и торговых платформ.</p>
 </div>
 <div class="col-md-3">
 <h4 class="service-heading"><a href="https://blockchaintechteam.com/">Blockchain Tech Team</a></h4>
 <hr>
 <p class="text-muted">В сотрудничестве с Blockchain Tech Team мы устанавливаем стандарты и создаем платформы для предоставления токенов и доступа к технологии блокчейна.</p>
 </div>
 </div>
 <div class="row">
 <div class="col-md-4 offset-md-2">
 <h4 class="service-heading"><a href="https://tokentarget.com/">Token Target</a></h4>
 <hr>
 <p class="text-muted">Token Target — команда профессионалов с богатым и разносторонним опытом в сфере финансов, финансовых технологий, инвестиционного банкинга и криптовалют. Их цель — помочь компаниям, проводящим ICO и продающим токены, получить желаемый объем финансирования, расширить сферу применения их монеты и повысить ценность токена.</p>
 </div>
 <div class="col-md-4">
 <h4 class="service-heading"><a href="http://pilanimation.com/">Pil Animation</a></h4>
 <hr>
 <p class="text-muted">Компания Pil Animation была основана в 1998 году известным аниматором и режиссером Шароном Газитом, который сегодня является креативным директором и генеральным содиректором компании. Проекты Pil Animation завоевали множество наград во всем мире. Это анимация высшего класса, отвечающая требованиям ведущих компаний, корпораций, рекламных и производственных агентств и стартапов на израильском и мировом рынке.</p>
 </div>
 </div>
 </div>
 </section>

 <section id="techno">
 <div class="container">
 <div class="row">
 <div class="col-lg-12 text-center">
 <p class="text-center text-uppercase section-small-heading">НАШИ ТЕХНОЛОГИИ</p><br>&nbsp;
                </div>
 </div>
 <div class="row text-center tech_row">
 <div class="col-md-4">
 <span class="fa-stack fa-4x wow zoomIn">
 <i class="fa fa-circle fa-stack-2x text-primary"></i>
 <img src="img/networks.png" class="img-fluid img-tech">
 </span>
 <h4 class="service-heading">СЕТЬ НА ОСНОВЕ БЛОКЧЕЙНА</h4>
 <p class="text-muted">SPORTCO будет использовать основную сеть (mainnet) Ethereum для создания программы лояльности и площадок для пирингового распространения контента и обмена играми. Планируется, что сеть объединит несколько миллионов спортивных фанатов со всего мира.</p>
 </div>
 <div class="col-md-4">
 <span class="fa-stack fa-4x wow zoomIn">
 <i class="fa fa-circle fa-stack-2x text-primary"></i>
 <img src="img/sportsdata.png" class="img-fluid img-tech">
 </span>
 <h4 class="service-heading">СПОРТИВНЫЕ ДАННЫЕ НА ОСНОВЕ ИИ</h4>
 <p class="text-muted">SPORTCO внедрит в спортивную индустрию технологии искусственного интеллекта (ИИ) с целью улучшения анализа данных, что позволит облегчить анализ спортивной подготовки и результатов, продажи билетов, мерчандайзинга и статистики.</p>
 </div>
 <div class="col-md-4">
 <span class="fa-stack fa-4x wow zoomIn">
 <i class="fa fa-circle fa-stack-2x text-primary"></i>
 <img src="img/clouddata.png" class="img-fluid img-tech">
 </span>
 <h4 class="service-heading">ОБЛАЧНЫЕ ДАННЫЕ</h4>
 <p class="text-muted">SPORTCO использует службы обработки и передачи данных на основе облачных технологий, что позволяет выполнять обновление данных в массовом масштабе в режиме реального времени в масштабируемой и гибкой среде. Данные в реальном времени поступают по различным каналам, в том числе от систем на основе Интернета вещей. Хранилище данных может предоставить каналы для сбора и анализа данных.</p>
 </div>
 </div>
 <div class="row text-center tech_row">
 <div class="col-md-4 offset-md-2">
 <span class="fa-stack fa-4x wow zoomIn">
 <i class="fa fa-circle fa-stack-2x text-primary"></i>
 <img src="img/backenddevelopment.png" class="img-fluid img-tech">
 </span>
 <h4 class="service-heading">BACKEND-РАЗРАБОТКА</h4>
 <p class="text-muted">SPORTCO занимается разработкой надежных и масштабируемых решений серверных решений для спортивной экосистемы. Наши приложения используют технологию блокчейна с распределенным реестром, интеграция которой позволяет обеспечить безопасное обслуживание клиентов. Наши облачные интерфейсы используют модульную и микросервисную архитектуру для выполнения обновлений с минимальной задержкой.</p>
 </div>
 <div class="col-md-4">
 <span class="fa-stack fa-4x wow zoomIn">
 <i class="fa fa-circle fa-stack-2x text-primary"></i>
 <img src="img/web_apps.png" class="img-fluid img-tech">
 </span>
 <h4 class="service-heading">ИНТЕРФЕЙСЫ</h4>
 <p class="text-muted">SPORTCO использует новейшие технологии для разработки различных веб-, Android- и iOS-интерфейсов для мобильных игр, алгоритмов прогноза, потоковой передачи результатов в реальном времени и социальной платформы. Наши опытные и квалифицированные дизайнеры UI/UX создают решения, обеспечивающие оптимальное удобство и вовлеченность пользователей.</p>
 </div>
 </div>
 </div>
 </section>

 <section id="why"  class="bg-light text-center">
 <div class="container">
 <div class="row">
 <div class="col-lg-12 text-center">
 <p class="text-center text-uppercase section-small-heading">ПОЧЕМУ СТОИТ ВЫБРАТЬ НАС</p>
 <p class="service-heading">У нас есть навыки, знания, технологии и энтузиазм,<br> чтобы превратить SPORTCO в новую спортивную цифровую экосистему.<br>&nbsp;
 </p><br>&nbsp;
          </div>
 </div>
 <div class="row reason_row">
 <div class="col-md-3 col-sm-6">
 <div class="row">
 <div class="col-md-12">
 <img src="img/team.png" class="img-fluid centered m-b-20">
 </div>
 <div class="col-md-12">
 <p>Опытная команда</p>
 </div>
 </div>
 </div>
 <div class="col-md-3 col-sm-6">
 <div class="row">
 <div class="col-md-12">
 <img src="img/producers.png" class="img-fluid centered m-b-20">
 </div>
 <div class="col-md-12">
 <p>Спортивные продюсеры и сервисные платформы</p>
 </div>
 </div>
 </div>
 <div class="col-md-3 col-sm-6">
 <div class="row">
 <div class="col-md-12">
 <img src="img/trade.png" class="img-fluid centered m-b-20">
 </div>
 <div class="col-md-12">
 <p>Торгуйте токенами с практической выгодой</p>
 </div>
 </div>
 </div>
 <div class="col-md-3 col-sm-6">
 <div class="row">
 <div class="col-md-12">
 <img src="img/multiple-sports.png" class="img-fluid centered m-b-20">
 </div>
 <div class="col-md-12">
 <p>Множество видов спорта, регионов и сообществ, объединенных в рамках Глобального клуба SPORTCO</p>
 </div>
 </div>
 </div>
 </div>
 <div class="row reason_row">
 <div class="col-md-3 col-sm-6">
 <div class="row">
 <div class="col-md-12">
 <img src="img/Tournament.png" class="img-fluid centered m-b-20">
 </div>
 <div class="col-md-12">
 <p>Спортивные турниры и конкурсы для пользователей</p>
 </div>
 </div>
 </div>

 <div class="col-md-3 col-sm-6">
 <div class="row">
 <div class="col-md-12">
 <img src="img/blockchain.png" class="img-fluid centered m-b-20">
 </div>
 <div class="col-md-12">
 <p>Использование блокчейна</p>
 </div>
 </div>
 </div>

 <div class="col-md-3 col-sm-6">
 <div class="row">
 <div class="col-md-12">
 <img src="img/communities.png" class="img-fluid centered m-b-20">
 </div>
 <div class="col-md-12">
 <p>Развитые спортивные сообщества</p>
 </div>
 </div>
 </div>

 <div class="col-md-3 col-sm-6">
 <div class="row">
 <div class="col-md-12">
 <img src="img/economy.png" class="img-fluid centered m-b-20">
 </div>
 <div class="col-md-12">
 <p>Спортивный рынок и рыночная экономика</p>
 </div>
 </div>
 </div>
 </div>
 <div class="row reason_row">
 
 <div class="col-md-3 col-sm-6">
 <div class="row">
 <div class="col-md-12">
 <img src="img/rewards.png" class="img-fluid centered m-b-20">
 </div>
 <div class="col-md-12">
 <p>Вознаграждение любви к спорту</p>
 </div>
 </div>
 </div>

 <div class="col-md-3 col-sm-6">
 <div class="row">
 <div class="col-md-12">
 <img src="img/multiple-sports.png" class="img-fluid centered m-b-20">
 </div>
 <div class="col-md-12">
 <p>Множество занятий, игр, сервисов и функций</p>
 </div>
 </div>
 </div>

 
 <div class="col-md-3 col-sm-6">
 <div class="row">
 <div class="col-md-12">
 <img src="img/producers.png" class="img-fluid centered m-b-20">
 </div>
 <div class="col-md-12">
 <p>Технологии ИИ, дополненной реальности и SWARM</p>
 </div>
 </div>
 </div>
 <div class="col-md-3 col-sm-6">
 <div class="row">
 <div class="col-md-12">
 <img src="img/Partners.png" class="img-fluid centered m-b-20">
 </div>
 <div class="col-md-12">
 <p>Сотрудничество с реальными брендами и спортивными организациями</p>
 </div>
 </div>
 </div>
 </div>
 </div>
 </section>

 <section>
 <div class="container">
 <div class="row">
 <div class="col-md-12">
 <p class="text-uppercase text-center section-small-heading">наши спортивные посланники</p><br>&nbsp;
                </div>
 <div class="col-lg-12">
 <div class="bxslider">
 <div>
 <div class="row">
 <div class="col-md-5 mob-div mb-4">
 <img src="img/amb/tim.jpg" class="img-fluid centered bximg">
 </div>
 <div class="col-md-7">
 <h3 class="text-left text-uppercase">тим де лееде</h3>
 <p class="text-left text-uppercase">крикет, kncb, голландия</p>
 <blockquote>
 <p><i><span class="quote left">«</span>Началась новая эпоха для фанатов спорта. Большинство из нас смотрит спортивные события не тогда, когда они происходят, а когда у нас есть время. Используя платформу Sportco и ей подобные, можно делиться своим мнением и читать интересную информацию от любителей спорта со всего мира<span class="quote right">».</span></i></p>
 </blockquote>
 <p>Тим де Лееде — известный голландский игрок в крикет, за плечами которого 11 лет выступлений за сборную Голландии. Правша и универсал, Тим представлял Голландию на Чемпионате мира по крикету 1996-м, 2003-м и 2007-м гг. После ухода из большого спорта в 2007 году Тим начал тренерскую карьеру, а в 2015 году был назначен главным тренером сборной Франции по крикету.</p>
 <p>Тим де Лееде входит в Галерею славы голландской Ассоциации игроков в крикет (KNCB).</p>
 <a class="btn btn-warning text-uppercase" href="<?= siteurl();?>testimonial/tim-de-leede.php" target="_blank">читать дальше</a>
 </div>
 <div class="col-md-5 desk-div">
 <img src="img/amb/tim.jpg" class="img-fluid centered bximg">
 </div>
 </div>
 </div>
 
 <div>
 <div class="row">
 <div class="col-md-5 mob-div mb-4">
 <img src="img/amb/juan.jpg" class="img-fluid centered bximg">
 </div>
 <div class="col-md-7">
 <h3 class="text-left text-uppercase">ХУАН КАРЛОС</h3>
 <p class="text-left text-uppercase">профессиональный теннисист и тренер </p>
 <blockquote>
 <p><i><span class="quote left">«</span>В индустрии спорта все построено на энтузиазме, причем на энтузиазме как спортсменов, так и их фанатов. Платформа Sportco переводит этот энтузиазм на новый уровень. Этот проект был бы невозможен без потрясающей технологии, которая наконец достигла своей зрелости. Мне чрезвычайно импонирует идея построить всю систему вокруг любителей спорта и для них. У этого проекта огромный потенциал, это настоящий прорыв в мире коммуникации и спорта<span class="quote right">».</span></i></p>
 </blockquote>
 <p>Хуан Карлос Багена в прошлом профессионально играл в теннис, а сегодня занимается тренерской работой в Испании. Он играл на высоком профессиональном уровне, получил рейтинг ATP 190 в одиночном разряде и 100 в парном разряде. Он выиграл несколько туров ATP в парном разряде и один тур ATP в одиночном разряде в Мадриде.</p>
 </div>
 <div class="col-md-5 desk-div">
 <img src="img/amb/juan.jpg" class="img-fluid centered bximg">
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </section>

 <section id="platforms" class="navy-bg">
 <div class="container">
 <div class="row">
 <div class="col-md-12">
 <p class="text-uppercase text-center">НАШИ ПЛАТФОРМЫ</p>
 </div>
 <div class="col-md-12">
 <h2 class="service-heading text-center">Приложения и игры SPORTCO для любителей спорта.</h2><br>&nbsp;
          </div>
 <div class="col-md-12">
 <div class="row">
 
 <div class="col-md-6 game_box">
 <div class="row">
 <div class="col-md-2">
 <svg height="50" width="50">
 <circle cx="25" cy="25" r="20" fill="#6270FF" />
 </svg>
 </div>
 <div class="col-md-10">
 <h4>КОНКУРСЫ И ИНТЕРЕСНЫЕ ФАКТЫ SPORTCO</h4>
 <p>Станьте чемпионом вашего клуба, вашей страны или всего мира. Принимайте участие в спортивных конкурсах и викторинах, демонстрируйте свои знания, побеждайте и выиграть титулы. Участвуйте в составлении викторин и конкурсов и получайте призы.</p>
 </div>
 </div>
 </div>
 
 
 <div class="col-md-6 game_box">
 <div class="row">
 <div class="col-md-2">
 <svg height="50" width="50">
 <circle cx="25" cy="25" r="20" fill="#6270FF" />
 </svg>
 </div>
 <div class="col-md-10">
 <h4>СООБЩЕСТВО SWARM SPORTCO</h4>
 <p>Хотите стать мастером угадывания? Попробуйте угадать результаты спортивных матчей, события из жизни команд и игроков (или даже спрогнозировать их образ жизни) и ощутите преимущества коллективного интеллекта спортивных фанатов с помощью технологий Swarm.</p>
 </div>
 </div>
 </div>
 
 </div>

 <div class="row">
 
 <div class="col-md-6 game_box">
 <div class="row">
 <div class="col-md-2">
 <svg height="50" width="50">
 <circle cx="25" cy="25" r="20" fill="#6270FF" />
 </svg>
 </div>
 <div class="col-md-10">
 <h4>ПРОГНОЗИРОВАНИЕ РЕЗУЛЬТАТОВ SPORTCO</h4>
 <p>Станьте чемпионом по прогнозированию результатов спортивных соревнований в ваших фанатских группах, в вашей стране и в целом мире и получите титулы и призы. Составляйте собственные прогнозы и загружайте их на нашу платформу.</p>
 </div>
 </div>
 </div>
 
 
 <div class="col-md-6 game_box">
 <div class="row">
 <div class="col-md-2">
 <svg height="50" width="50">
 <circle cx="25" cy="25" r="20" fill="#6270FF" />
 </svg>
 </div>
 <div class="col-md-10">
 <h4>СПОРТИВНАЯ СТАТИСТИКА И АНАЛИТИКА SPORTCO</h4>
 <p>Спортивная аналитика позволяет вам отслеживать спортивную статистику и другие данные, а также делиться интересной информацией и обсуждать ее последствия.</p>
 </div>
 </div>
 </div>
 
 </div>

 <div class="row">
 
 <div class="col-md-6 game_box">
 <div class="row">
 <div class="col-md-2">
 <svg height="50" width="50">
 <circle cx="25" cy="25" r="20" fill="#6270FF" />
 </svg>
 </div>
 <div class="col-md-10">
 <h4>БЛОГИ SPORTCO</h4>
 <p>В блогах вы можете выразить свою любовь к спорту в словах.</p>
 </div>
 </div>
 </div>
 
 
 <div class="col-md-6 game_box">
 <div class="row">
 <div class="col-md-2">
 <svg height="50" width="50">
 <circle cx="25" cy="25" r="20" fill="#6270FF" />
 </svg>
 </div>
 <div class="col-md-10">
 <h4>ФАНТАЗИЙНЫЙ СПОРТ</h4>
 <p>Играйте в виртуальные фантазийные спортивные игры от лица капитана или игрока.</p>
 </div>
 </div>
 </div>
 
 </div>

 <div class="row">
 
 <div class="col-md-6 game_box">
 <div class="row">
 <div class="col-md-2">
 <svg height="50" width="50">
 <circle cx="25" cy="25" r="20" fill="#6270FF" />
 </svg>
 </div>
 <div class="col-md-10">
 <h4>СПОРТИВНЫЕ ВИДЕО</h4>
 <p>Делитесь с другими участниками спортивными видео, которые вы сняли с любовью и азартом фаната, которых не могут передать профессиональные СМИ</p>
 </div>
 </div>
 </div>
 
 </div>
 </div>
 </div>
 </div>
 </section>

 <section id="fan">
 <div class="container">
 <div class="row">
 <div class="col-lg-12 text-center">
 <p class="text-uppercase section-small-heading">ПРИЗОВОЙ ФОНД СООБЩЕСТВА ЛЮБИТЕЛЕЙ СПОРТА</p>
 <p class="service-heading col-md-8 offset-md-2">Несколько примеров того, как мы вознаграждаем спортивных фанатов за креативный или экспертный вклад и активность в спортивных сообществах на платформе SportCo.
 </p><br>&nbsp;
                </div>
 </div>

 <div class="row reason_row">
 <div class="col-md-12">
 <img src="img/fan_pool.png" class="img-fluid centered">
 </div>
 </div>
 <div class="row reason_row">
 <div class="col-md-12 text-center">
 <p>Публикация любых отправленных участниками материалов и начисление вознаграждения осуществляется только после одобрения редакторами и модераторами из числа пользователей.</p>
 </div>
 </div>
 </div>
 </section>

 <section id="fan"  class="navy-bg">
 <div class="container">
 <div class="row">
 <div class="col-lg-12 text-center">
 <p class="text-uppercase section-small-heading">ПООЩРИТЕЛЬНОЕ ВОЗНАГРАЖДЕНИЕ</p>
 <p class="service-heading col-md-10 offset-md-1">Вы можете одним из первых поддержать бизнес-модель SPORTCO. Расскажите другим участникам спортивного блокчейн-сообщества о SPORTCO, чтобы мы могли наградить как можно больше любителей спорта во всем мире, и получите поощрительные баллы.</p>
 <div class="row">
 <img src="img/hr_img.png" class="img-fluid col-md-10 centered">
 </div>
 </div>
 </div>
 <div class="row reason_row">
 <div class="col-md-10 offset-md-1">
 <div class="row">
 <div class="col-md-4">
 <div class="bounty-box bounty-box1">
 <div class="bounty-upper">
 <h5 class="text-center">Напишите пост в блоге на 400-600 слов о том, почему вашему сообществу стоит принять участив в ICО SportCo, и отправьте ссылку своим подписчикам в социальных сетях.</h5>
 </div>
 <div class="bounty-medium">
 <h4 class="text-center">100 баллов</h4>
 </div>
 <div class="bounty-bottom">
 <h4 class="text-center">&nbsp;</h4>
 </div>
 </div>
 </div>
 <div class="col-md-4">
 <div class="bounty-box bounty-box2">
 <div class="bounty-upper">
 <h5 class="text-center">Если 50 человек по вашей рекомендации дадут ссылку на нашу запись в Twitter о датах ICO SPORTCO.</h5>
 </div>
 <div class="bounty-medium">
 <h4 class="text-center">50 баллов</h4>
 </div>
 <div class="bounty-bottom">
 <h5 class="text-center">Вознаграждение в монетах SPORTCO</h5>
 </div>
 </div>
 </div>
 <div class="col-md-4">
 <div class="bounty-box bounty-box3">
 <div class="bounty-upper">
 <h5 class="text-center">Напишите пост на 100-200 слов на форуме Bitcoin Talk на тему &quot;Почему ICO SPORTCO — главное событие месяца&quot;.</h5>
 </div>
 <div class="bounty-medium">
 <h4 class="text-center">100 баллов</h4>
 </div>
 <div class="bounty-bottom">
 <h4 class="text-center">&nbsp;</h4>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 <div class="row reason_row">
 <div class="col-md-12 text-center">

 <p>Любые публикации и активность будут проверены и одобрены нашими редакторами и модераторами.</p>
 </div>
 </div>
 </div>
 </section>

 <section id="contactSection">
 <div class="container">
 <div class="row">
 <div class="col-md-10 offset-md-1">
 <p class="text-uppercase text-center section-small-heading">ФОРМА ДЛЯ СВЯЗИ</p>
 <p class="service-heading text-center col-md-10 offset-md-1">Свяжитесь с нами</p>
 <div id="back_result"></div>
 <br><br>
 <form class="contact-form">
 <div class="row form-group">
 <div class="col-md-6">
 <input type="name" name="vname" class="form-control" placeholder="Имя">
 </div>
 <div class="col-md-6">
 <input type="email" name="vemail" class="form-control" placeholder="Email">
 </div>
 </div>
 <div class="row form-group">
 <div class="col-md-12">
 <input type="text" name="vsubject" class="form-control" placeholder="Тема">
 </div>
 </div>
 <div class="row form-group">
 <div class="col-md-12">
 <textarea name="vmessage" class="form-control" placeholder="Message" rows="5"></textarea>
 </div>
 </div>
 <div class="row form-group">
 <div class="col-md-3">
 <button class="btn btn-primary text-uppercase btnSubmit" type="button">отправить сообщение</button>
 </div>
 </div>
 </form>
 </div>
 </div>
 </div>
 </section>
<div class="modal fade" id="teamModal">
 <div class="modal-dialog modal-lg modal-dialog-centered">
 <div class="modal-content">

 
 <div class="modal-body">
 <div class="row">
 <div class="col-md-4 mb-2">
 <img src="" class="team-pop-img img-fluid centered">
 </div>
 <div class="col-md-8 mb-2">
 <h3 class="team-pop-name"></h3>
                        <span class="text-uppercase team-pop-desig"></span>
                        <br>&nbsp;<br>
                        <p class="team-pop-detail">lorem ipsum</p>
 <div class="team-pop-list">
 <ul class="team-social-list"></ul>
 </div>
 </div>
 </div>
 </div>

 
 <div class="modal-footer">
 <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
 </div>
 </div>
 </div>
</div>
<script src="js/jquery.bxslider.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  function setHeight(){
    var win_ht = $(window).innerHeight();
    $('header').height(win_ht);
  }
  setHeight();
  $( window ).resize(function() {
    setHeight();
  });

    $('.bxslider').bxSlider({
        mode: 'vertical',
        auto: true,
        speed: 500,
        slideMargin:0,
        infiniteLoop: true,
        pager: true,
        controls: false,
        minSlides: 1,
        moveSlides: 1,
        adaptiveHeight: false
    });

  $(document).on("click",".btnSubmit",function(e){
      e.preventDefault();
      $.ajax({
          type: "POST",
          data: {
              "ajax": 1,
              "name": $("input[name='vname']").val(),
              "email": $("input[name='vemail']").val(),
              "subject": $("input[name='vsubject']").val(),
              "msg": $("textarea[name='vmessage']").val()
          },
          success: function(response){
              if(response == 1){
                  var success = '<div class="alert alert-success alert-dismissable">\n' +
                      '  <button type="button" class="close" data-dismiss="alert">×</button>\n' +
                      '  <strong>Thanks!</strong> We have received your request.\n' +
                      '</div>'
                  $('#back_result').html(success);
                  $('.contact-form').find('input,textarea').val('');
              }
              else{
                  var error = '<div class="alert alert-info alert-dismissable">\n' +
                      '  <button type="button" class="close" data-dismiss="alert">×</button>\n' +
                      '  <strong>Error!</strong> Please check our the fields.\n' +
                      '</div>'
                  $('#back_result').html(error);
                  setTimeout(function() {
                      $('#back_result').html('');
                  },4000);
              }
          }
      })
  });

    $(document).on("click",".btn-subscribe",function(e){
      e.preventDefault();
      $.ajax({
          type: "POST",
          data: {
              "ajax": 2,
              "sub_email": $("input[name='semail']").val()
          },
          success: function(response){
              if(response == 1){
                  var success = '<div class="alert alert-success alert-dismissable">\n' +
                      '  <button type="button" class="close" data-dismiss="alert">×</button>\n' +
                      '  <strong>Thanks!</strong> You have been subscribed.\n' +
                      '</div>'
                  $('#sub_result').html(success);
                  $('.subscribe-form').find('input').val('');
              }
              else{
                  var error = '<div class="alert alert-info alert-dismissable">\n' +
                      '  <button type="button" class="close" data-dismiss="alert">×</button>\n' +
                      '  <strong>Error!</strong> Please check out the field.\n' +
                      '</div>'
                  $('#sub_result').html(error);
                  setTimeout(function() {
                      $('#sub_result').html('');
                  },4000);
              }
          }
      })
  });
    var desc = [
        'Anuj is a business graduate with over 25 years of experience across sports media, financial services and technology industries. As an entrepreneur, he has brought the 3 components together to envision the Sportco eco-system using token economy based on blockchain technology.',
        'Vice Rector of Finance and Development for 5 years; Professor of eBusiness at the Athens University of Economics and Business. A professional researcher and writer on Information Systems Journal, the International Journal of Electronic Commerce, and the International Journal of Information Management.',
        'Global Head Lending & Liquidity Solutions, Products & Solutions, Private Banking Int\'l at ABN AMRO Bank. He has led teams in several countries and believes empowerment is the key to success.',
        'Director of Abacus Seychelles Limited, an Independent Director for the Barclays Bank, an international tax and accounting professional and has over 10 years of experience in legal and financial due diligence, investment advisory, tax planning and company law. She has over 3 years of experience and worked with one of the big 4 global consulting firms. ',
        'National Tennis Instructor (Highest Qualification in Spain). He has over 30 years of experience in the Sports World as he was a professional Tennis player. ',
        'Fishery Officer/Scientist at FAO, over 15 years of experience; is capable of coordinating and managing open water fisheries stock assessment and ecological issues.',
        'A veteran New Delhi-based journalist who retired in 2015 as the chief sports writer in South Asia for Agence France-Presse (AFP), the international news wire service. Over 35 years of experience, has covered major sporting events including six Olympic Games, seven Asian Games and eight cricket WorldCups.'
    ];
  $('.team-box').on('click',function(){
      var img = $(this).children('.box-upper').find('img').attr('src');
      var name = $(this).children('.box-med').find('h3').html();
      var desig = $(this).children('.box-med').find('p.text-uppercase').html();
      var social_list = $(this).children('.box_lower').find('.team-social-list').html();
      var order = $(this).attr('data-order');
      $('.team-pop-img').attr('src',img);
      $('.team-pop-name').html(name);
      $('.team-pop-desig').html(desig);
      $('.team-pop-detail').html(desc[order]);
      $('.team-pop-list').find('ul.team-social-list').html(social_list);
  });
  var current_coin = $('.current-coin').attr('data-current');
  var total_coin = $('.total-coin').attr('data-total');
  var barwidth = (current_coin / total_coin)*100;
  $('.progress-big').find('.progress-bar').width(barwidth);
});//ready function
var tag = document.createElement('script');

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
var player;
function onYouTubeIframeAPIReady() {
    player = new YT.Player('video_section', {
        height: '100%',
        width: '100%',
        videoId: '-r8oD0YGiq8',
        events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
        }
    });
}
function onPlayerReady(event) {}

function customPlay() {
    player.playVideo();
}
var done = false;
function onPlayerStateChange(event) {
    if (event.data == YT.PlayerState.PLAYING && !done) {
        done = true;
    }
}
$('.btn-play').on('click',function(){
    $('.videoCover').fadeOut(2800);
    setTimeout(function(){ $('.videoCover').remove(); }, 3200);
    customPlay();
});
</script>
<?php include('footer.php');?>
<!-- Header -->
<!--              <div class="intro-heading text-uppercase centered">JOIN A 500k strong sport community</div>-->
<!-- Trading token -->
<!-- Product Column -->
<!-- Start single skill -->
<!-- End single skill -->
<!-- Team -->
<!-- Start single skill -->
<!-- End single skill -->
<!-- Start single skill -->
<!-- End single skill -->
<!-- Start single skill -->
<!-- End single skill -->
<!-- Start single skill -->
<!-- End single skill -->
<!-- Start single skill -->
<!-- End single skill -->
<!-- Start single skill -->
<!-- End single skill -->
<!-- Start single skill -->
<!-- End single skill -->
<!-- Start single skill -->
<!-- End single skill -->
<!-- Services -->
<!-- item starts -->
<!-- box starts -->
<!-- box ends -->
<!-- box starts -->
<!-- box ends -->
<!-- box starts -->
<!-- box ends -->
<!-- item ends -->
<!-- item starts -->
<!-- box starts -->
<!-- box ends -->
<!-- box starts -->
<!-- box ends -->
<!-- box starts -->
<!-- box ends -->
<!-- item ends -->
<!-- item starts -->
<!-- box starts -->
<!-- box ends -->
<!-- item ends -->
<!-- item starts -->
<!-- box starts -->
<!-- box ends -->
<!-- box starts -->
<!-- box ends -->
<!-- box starts -->
<!-- box ends -->
<!-- box starts -->
<!-- box ends -->
<!-- box starts -->
<!-- box ends -->
<!-- box starts -->
<!-- box ends -->
<!-- box starts -->
<!-- box ends -->
<!-- game box -->
<!-- game box ends -->
<!-- game box -->
<!-- game box ends -->
<!-- game box -->
<!-- game box ends -->
<!-- game box -->
<!-- game box ends -->
<!-- game box -->
<!-- game box ends -->
<!-- game box -->
<!-- game box ends -->
<!-- game box -->
<!-- game box ends -->
<!-- The Modal -->
<!-- Modal body -->
<!-- Modal footer -->
