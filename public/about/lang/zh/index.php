<?php
if (!empty($_POST) && $_POST['ajax'] == 1) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $msg = trim($_POST['msg']);

    if (($name != null) && ($email != null) && ($subject != null) && ($msg != null)) {

        $message = "Hi,\n\n";

        $message .= "You have a new contact request on sportco.io : \n\n";

        $message .= "Name : " . $name . " \n\n";

        $message .= "Email : " . $email . " \n\n";

        $message .= "Subject : " . $subject . " \n\n";

        $message .= "Message : " . $msg . " \n\n";

        $message .= "Thanks \n\n";

        $senderMail = "info@sportco.io";

        $headers = "From: no-reply@sportco.io" . "\r\n";

        //$senderMail = "business@sportswizz.com";

        $subject = "Contact Request On SportCo";

        mail($senderMail, $subject, $message, $headers);

        echo 1;
        exit;

    } else {
        echo 0;
        exit;
    }

}
if (!empty($_POST) && $_POST['ajax'] == 2) {
    $sub_email = trim($_POST['sub_email']);

    if ($sub_email != null) {
        // our email
        $our_message = "Hi,\n\n";

        $our_message .= "You have a new subscriber on sportco.io : \n\n";

        $our_message .= "Email : " . $sub_email . " \n\n";

        $our_message .= "Thanks \n\n";

        $senderMail = "info@sportco.io";

        $headers = "From: no-reply@sportco.io" . "\r\n";

        //$senderMail = "business@sportswizz.com";

        $subject = "New Subscriber On SportCo";

        mail($senderMail, $subject, $our_message, $headers);

        //subscriber email

        $sub_msg = "Hi,\n\n";

        $sub_msg .= "Thank you for subscribing to the sportco newsletter \n\n";

        $sub_msg .= "Best Wishes \n\n";

        $sub_msg .= "SPORTCO \n\n";

        $headers = "From: no-reply@sportco.io" . "\r\n";

        //$senderMail = "business@sportswizz.com";

        $subject = "Newsletter Subscription";

        mail($sub_email, $subject, $sub_msg, $headers);

        echo 1;
        exit;

    } else {
        echo 0;
        exit;
    }

}
?> <?php include('header.php'); ?>

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
                            <h1 class="text-uppercase centered section-carousel-heading">加入超過 50 萬人的運動社群</h1>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/header_02.jpg" class="img-fluid">
                        <div class="carousel-caption">
                            <h1 class="text-uppercase centered section-carousel-heading">獎勵對運動的熱情</h1>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/header_03.jpg" class="img-fluid">
                        <div class="carousel-caption">
                            <h1 class="text-uppercase centered section-carousel-heading">跟全世界的運動迷保持連結</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>




<div class="front-bottom col-md-2 col-sm-6 col-xs-10" style="background-color: #fff">
    <h3 class=h3_font style="color: #000; padding-top: 5px; "> Pre - Sale Is Live!</h3>
    <span class="intro-lead-in" style="color: #000;">ICO STARTS IN</span>
    <div class="pt-3" style="text-align: center;">
        <div class="countdown wow fadeInUpSlightly animated" data-wow-delay="0.9s" dir="ltr"
             style="visibility: visible; animation-delay: 0.9s;">
            <div class="header-style float-right countdown__item">
                <div class="header-style countdown__number">
                    <div class="count_day" style="color: #CEAB6F">00</div>
                </div>
                <span class="countdown__label">DAYS</span>
            </div>
            <div class="header-style countdown__item">
                <div class="header-style countdown__number">
                    <div class="count_hour" style="color: #CEAB6F">00</div>
                </div>
                <span class="countdown__label">HOURS</span>
            </div>
            <div class="header-style countdown__item">
                <div class="header-style countdown__number">
                    <div class="count_min" style="color: #CEAB6F">00</div>
                </div>
                <span class="countdown__label">MINUTES</span>
            </div>
            <div class="header-style countdown__item">
                <div class="header-style countdown__number">
                    <div class="count_sec" style="color: #CEAB6F">00</div>
                </div>
                <span class="countdown__label">SECONDS</span>
            </div>
        </div>
    </div>


    <!--amount raised start
    <div class="container amount_raised">
        <div class="row pt-3">
            <div class="text-left" style="color: #000000;">
                <p class="text-center text-uppercase section-small-heading">AMOUNT RAISED</p><br>&nbsp;
            </div>
        </div>
        <div style="margin-top: -35px;">
            <div class="cx-skill-inner">

                <div class="" style="color: #0E3240">
                    <div class="row">
                        <div class="col-md-5 col-sm-4 text-left">
                            <p class="current-coin" data-current="15000000"><strong>150,000</strong> USD</p>
                        </div>
                        <div class="col-md-7 col-sm-9">
                            <p class="text-right total-coin current-coin" data-total="24000000"><strong>24,000,000</strong>
                                USD</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="progress progress-big">
                                <div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s"
                                     data-wow-delay=".5s" role="progressbar" aria-valuenow="60"
                                     aria-valuemin="0" aria-valuemax="100"
                                     style="visibility: visible; animation-duration: 0.8s; animation-delay: 0.5s; animation-name: fadeInLeft;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--amount raised end-->

    <div class="">
        <div class="row pt-4">

            <div class="col-sm-4 text-left ico_price_1" style="color:#000;"><span"><b> PRE-ICO
                    PRICE</b></span>
            </div>
            <div class="col-sm-8 ico_price_2" style="color: #000; text-align:right;">1 Sportco coin = 0.04 USD</div>

            <div class="pt-3 col-md-12">
                <a href="#" style="text-decoration:none">
                    <center>
                        <a href="https://tokensale.sportco.io/#!/register?pk_campaign=hk&pk_source=hk_sportco_io" style="background-color:#E9AB60; text-decoration: none; color: black !important;"
                           class="btn btn-block reserve_now">JOIN TOKEN SALE
                        </a>
                </a></center>
            </div>
        </div>
    </div>
    <div class="icon_live">
        <div class="pt-4">
            <div class="row bank">
                <!--<div class="col-md-2 ">

                </div>-->
                <div class="col-md-12 text-left" style="color: #0E3240">
                    <span><img src="img/live/bank.png" class="img-fluid centered_1"></span> <span
                            class="bank">BTC, ETH, USD</span>
                </div>
            </div>
            <div class="row text-center live_icons_1" style="display: flex">
                <center>
                    <div class="col-md-12 live_icons">
                        <a href="http://t.me/SPORTCO_token"><img src="img/live/telegram.png" class="img-fluid centered_1 pr-2"></a>
                        <!--<a href="http://t.me/SPORTCO_token"><img src="img/live/bitcoin.png" class="img-fluid centered_1 pr-2"></a>-->
                        <!--<a href="http://t.me/SPORTCO_token"><img src="img/live/github.png" class="img-fluid centered_1 pr-2"></a>-->
                        <a href="https://www.facebook.com/SportCo.io/"><img src="img/live/facebook.png" class="img-fluid centered_1 pr-2"></a>
                        <a href="https://www.linkedin.com/company/sportco-io/"><img src="img/live/linkedin.png" class="img-fluid centered_1 pr-2"></a>
                        <a href="https://twitter.com/Sportcoio"><img src="img/live/twitter.png" class="img-fluid centered_1 pr-2"></a>
                    </div>
                </center>
            </div>
        </div>
    </div>

</div>



<section class="video_holder">
    <div id="video_section"></div>
    <div class="videoCover">
        <img src="img/videobanner.png" class="img-fluid video-banner centered">
        <div class="video-btn-holder">
            <img src="img/playBtn.png" class="btn-play centered">
        </div>
    </div>
</section>


<section class="bg-light" id="ourtoken">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="text-center text-uppercase section-small-heading">我們的代幣</p><br>&nbsp;
            </div>
        </div>
        <div class="row text-center tech_row">
            <div class="col-md-4">
                <img src="img/utility.png" class="img-fluid">
                <h4 class="service-heading text-capitalize">實用代幣</h4>
                <p class="text-muted">這個代幣可以在我們的線上市集中，以特價購買運動商品、紀念品以及門票。</p>
            </div>
            <div class="col-md-4">
                <img src="img/sportsglobal.png" class="img-fluid">
                <h4 class="service-heading text-capitalize">極具價值的代幣</h4>
                <p class="text-muted">這個極具價值的代幣能夠讓您成為 SPORTCO 全球俱樂部的會員。</p>
            </div>
            <div class="col-md-4">
                <img src="img/bumper_winner.png" class="img-fluid">
                <h4 class="service-heading text-capitalize">進入運動聯賽</h4>
                <p class="text-muted">您可以使用代幣來進入我們的 SPORTS Skill Tournaments 聯賽，並且有機會贏得 Bumper Rewards 獎項</p>
            </div>
        </div>
        <div class="row text-center tech_row">
            <div class="col-md-4">
                <img src="img/payouts.png" class="img-fluid">
                <h4 class="service-heading text-capitalize">定期付款</h4>
                <p class="text-muted">您可以在 SPORTCO Wallet 中，定期收到對貢獻內容或達到表現里程碑所支付的款項。</p>
            </div>
            <div class="col-md-4">
                <img src="img/sportsgroup.png" class="img-fluid">
                <h4 class="service-heading text-capitalize">SPORTCO 商店</h4>
                <p class="text-muted">使用代幣跟關聯運動群組交易與進行交換。</p>
            </div>
            <div class="col-md-4">
                <img src="img/peer-to-peer.png" class="img-fluid">
                <h4 class="service-heading text-capitalize">點對點</h4>
                <p class="text-muted">您可以在我們的運動平台上跟其他的運動迷交換代幣，用於競賽或挑戰我們任何的運動遊戲。</p>
            </div>
        </div>
    </div>
</section>


<section id="distribution" class="navy-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="text-center text-uppercase section-small-heading">代幣分配</p><br>&nbsp;
            </div>
        </div>
        <div class="row">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12" style="margin: 0px auto;text-align: center;">
                        <div class="padding-top-60 padding-left-60">
                            <img src="img/logo4x.png" class="img-fluid col-md-9 centered">
                            <div class="row clear padding-top-60"></div>
                            <a class="btn btn-xl text-uppercase btn-wp" href="assets/whitepaper.pdf" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;白皮書&nbsp;&nbsp;&nbsp;&nbsp;</a><br>&nbsp;<br>
                            <a class="btn btn-warning btn-xl text-uppercase" href="https://tokensale.sportco.io/#!/register?pk_campaign=hk&pk_source=hk_sportco_io"
                               target="_blank">立即預訂</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 light_div">
                        <div style="clear: both;content: ' ';display: table"></div>
                        <div class="yellow_box">
                            <h5>可用於社群資金的代幣</h5>
                            <span class="large_no">500,000,000</span>
                        </div>
                        <hr>
                        <div class="">
                            <h5>ICO 前的價格</h5>
                            <div style="clear: both;content: ' ';display: table"></div>

                            <p class="trade_rate">1 SPORTCO Coin = 0.04 USD</p>
                            <div style="clear: both;content: ' ';display: table"></div>
                            <p>透過加密貨幣加入我們</p>
                            <div style="clear: both;content: ' ';display: table"></div>
                        </div>
                        <hr>
                        <div class="">
                            <h5>ICO 價格</h5>
                            <p class="trade_rate">1 SPORTCO Coin = 0.05 USD</p>
                            <p>透過 ETH 參與</p>
                            <div style="clear: both;content: ' ';display: table"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!--<section id="raised">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="text-center text-uppercase section-small-heading">已募集資金</p><br>&nbsp;
            </div>
        </div>
        <div class="row">
            <div class="cx-skill col-md-4 offset-md-4">
                <div class="cx-skill-inner">

                    <div class="cx-single-skill">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="current-coin" data-current="15000000"><strong>1,50,000</strong> 美元</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-right total-coin" data-total="20000000"><strong>2,00,00,000</strong> 美元
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="progress progress-big">
                                    <div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s"
                                         data-wow-delay=".5s" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                                         aria-valuemax="100"
                                         style="visibility: visible; animation-duration: 0.8s; animation-delay: 0.5s; animation-name: fadeInLeft;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>-->


<section class="bg-light" id="param">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="text-center text-uppercase section-small-heading">群眾募資數據與代幣分配</p><br>&nbsp;
            </div>
        </div>
        <div class="row text-center m-b-50">
            <div class="col-md-4">
                <h4 class="service-heading">ICO 前</h4>
                <p class="text-muted">ICO 前尚未賣出的代幣將會加到 ICO 當中。</p>
            </div>
            <div class="col-md-4">
                <h4 class="service-heading">ICO</h4>
                <p class="text-muted">在 ICO 過程的尾聲，未使用的代幣將會放進「隨機分配的獎勵池」。</p>
            </div>
            <div class="col-md-4">
                <h4 class="service-heading">SPORTCO</h4>
                <span><strong>供應量：</strong>500,000,000</span><br>
                <span><strong>小數點位數：</strong>18</span><br>
                <span><strong>符號：</strong>SPRT</span><br>
                <span><strong>區塊鏈：</strong>Ethereum</span>
            </div>
        </div>
        <div class="row">
            <div class="container-fluid">
                <img src="https://sportco.io/img/token-allocation-trans2.png" class="img-fluid centered">
            </div>
        </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="text-center text-uppercase section-small-heading">里程碑與進度</p><br>&nbsp;
            </div>
        </div>
        <div class="row">
            <div class="cx-skill">
                <div class="cx-skill-inner">

                    <div class="cx-single-skill">
                        <p>運動產品技術開發&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span class="progress-bold">4M</span></strong></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="progress">
                                    <div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s"
                                         data-wow-delay=".5s" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                                         aria-valuemax="100"
                                         style="width: 60%; visibility: visible; animation-duration: 0.8s; animation-delay: 0.5s; animation-name: fadeInLeft;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="cx-single-skill">
                        <p>加速獲得粉絲社群&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span class="progress-bold">5M</span></strong></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="progress">
                                    <div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s"
                                         data-wow-delay=".5s" role="progressbar" aria-valuenow="90" aria-valuemin="0"
                                         aria-valuemax="100"
                                         style="width: 90%; visibility: visible; animation-duration: 0.8s; animation-delay: 0.5s; animation-name: fadeInLeft;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="cx-single-skill">
                        <p>建立 SPORTCO 線上市集&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span
                                        class="progress-bold">3M</span></strong></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="progress">
                                    <div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s"
                                         data-wow-delay=".6s" role="progressbar" aria-valuenow="70" aria-valuemin="0"
                                         aria-valuemax="100"
                                         style="width: 70%; visibility: visible; animation-duration: 0.8s; animation-delay: 0.6s; animation-name: fadeInLeft;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="cx-single-skill">
                        <p>發現冠軍推出&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span class="progress-bold">1M</span></strong></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="progress">
                                    <div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s"
                                         data-wow-delay=".7s" role="progressbar" aria-valuenow="45" aria-valuemin="0"
                                         aria-valuemax="100"
                                         style="width: 45%; visibility: visible; animation-duration: 0.8s; animation-delay: 0.7s; animation-name: fadeInLeft;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="cx-single-skill">
                        <p>拓展至全球運動界並加入區域性運動&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span
                                        class="progress-bold">3M</span></strong></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="progress">
                                    <div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s"
                                         data-wow-delay=".7s" role="progressbar" aria-valuenow="77" aria-valuemin="0"
                                         aria-valuemax="100"
                                         style="width: 77%; visibility: visible; animation-duration: 0.8s; animation-delay: 0.7s; animation-name: fadeInLeft;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="cx-single-skill">
                        <p>建立運動工作室，讓運動迷能夠使用擴增實境與 SWARM&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span
                                        class="progress-bold">2M</span></strong></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="progress">
                                    <div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s"
                                         data-wow-delay=".7s" role="progressbar" aria-valuenow="67" aria-valuemin="0"
                                         aria-valuemax="100"
                                         style="width: 67%; visibility: visible; animation-duration: 0.8s; animation-delay: 0.7s; animation-name: fadeInLeft;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="cx-single-skill">
                        <p>AI 驅動的數據及運動預測&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span class="progress-bold">4M</span></strong>
                        </p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="progress">
                                    <div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s"
                                         data-wow-delay=".7s" role="progressbar" aria-valuenow="84" aria-valuemin="0"
                                         aria-valuemax="100"
                                         style="width: 84%; visibility: visible; animation-duration: 0.8s; animation-delay: 0.7s; animation-name: fadeInLeft;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="cx-single-skill">
                        <p>區塊鍊驅動的社群獎勵計畫與重要記事管理&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span
                                        class="progress-bold">3M</span></strong></p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="progress">
                                    <div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s"
                                         data-wow-delay=".7s" role="progressbar" aria-valuenow="71" aria-valuemin="0"
                                         aria-valuemax="100"
                                         style="width: 71%; visibility: visible; animation-duration: 0.8s; animation-delay: 0.7s; animation-name: fadeInLeft;">
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
                <p class="text-center text-uppercase section-small-heading">我們的時間軸</p><br>&nbsp;
            </div>
            <div class="col-lg-12">
                <img src="../../img/timeline.png" class="img-fluid">
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-2 offset-lg-5 m-t-60">
                        <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger centered" href="timeline.php"
                           target="_blank">檢視詳細資訊</a>
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
                <p class="text-uppercase text-center">sportco team</p>
                <p class="service-heading">Having a collective business experience of over 200 years, our team has the drive, experience and what it takes to bring an idea to life and make a business successful.</p><br>&nbsp;
            </div>
        </div>
        <div class="row">
            <!-- box starts -->
            <div class="col-md-4">
                <div class="team-box">
                    <div class="box-upper">
                        <img src="img/team/01.png" class="img-responsive col-md-8 col-xs-12 centered">
                    </div>
                    <div class="box-med text-center">
                        <h3>Anuj Sharma</h3>
                        <p class="text-gold mb-1">Founder and Business Leader</p>
                        <p>Anuj is a business graduate with over 25 years of experience across sports media, financial services and technology industries. As an entrepreneur, he has brought the 3 components together to envision the Sportco eco-system using token economy based on blockchain technology.</p>
                        <span class="text-muted"><a href="https://www.linkedin.com/in/anujsharma17/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></span>
                    </div>
                </div>
            </div>
            <!-- box ends -->
            <!-- box starts -->
            <div class="col-md-4">
                <div class="team-box">
                    <div class="box-upper">
                        <img src="img/team/03.png" class="img-responsive col-md-8 col-xs-12 centered">
                    </div>
                    <div class="box-med text-center">
                        <h3>Prof George Giaglis</h3>
                        <p class="text-gold mb-1">Lead Advisor</p>
                        <p>Vice Rector of Finance and Development for 5 years; Professor of eBusiness at the Athens University of Economics and Business. A professional researcher and writer on Information Systems Journal, the International Journal of Electronic Commerce, and the International Journal of Information Management.</p>
                        <span class="text-muted"><a href="https://www.linkedin.com/in/georgegiaglis/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></span>
                    </div>
                </div>
            </div>
            <!-- box ends -->
            <!-- box starts -->
            <div class="col-md-4">
                <div class="team-box">
                    <div class="box-upper">
                        <img src="img/team/08.png" class="img-responsive col-md-8 col-xs-12 centered">
                    </div>
                    <div class="box-med text-center">
                        <h3>Phiroze Mogrelia</h3>
                        <p class="text-gold mb-1">Senior Advisor</p>
                        <p>Global Head Lending & Liquidity Solutions, Products & Solutions, Private Banking Int\'l at ABN AMRO Bank. He has led teams in several countries and believes empowerment is the key to success.</p>
                        <span class="text-muted"><a href="https://www.linkedin.com/in/phirozemogrelia/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></span>
                    </div>
                </div>
            </div>
            <!-- box ends -->
        </div>
        <div class="row">
            <!-- box starts -->
            <div class="col-md-4">
                <div class="team-box">
                    <div class="box-upper">
                        <img src="img/team/04.png" class="img-responsive col-md-8 col-xs-12 centered">
                    </div>
                    <div class="box-med text-center">
                        <h3>Malika Jivan</h3>
                        <p class="text-gold mb-1">Corporate Advisor</p>
                        <p>Director of Abacus Seychelles Limited, an Independent Director for the Barclays Bank, an international tax and accounting professional and has over 10 years of experience in legal and financial due diligence, investment advisory, tax planning and company law. She has over 3 years of experience and worked with one of the big 4 global consulting firms.</p>
                        <span class="text-muted"><a href="https://www.linkedin.com/in/malika-jivan-1740026/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></span>
                    </div>
                </div>
            </div>
            <!-- box ends -->
            <!-- box starts -->
            <div class="col-md-4">
                <div class="team-box">
                    <div class="box-upper">
                        <img src="img/team/05.png" class="img-responsive col-md-8 col-xs-12 centered">
                    </div>
                    <div class="box-med text-center">
                        <h3>Juan Carlos Báguena</h3>
                        <p class="text-gold mb-1">Sports Advisor</p>
                        <p>National Tennis Instructor (Highest Qualification in Spain). He has over 30 years of experience in the Sports World as he was a professional Tennis player.</p>
                        <span class="text-muted"><a href="https://www.linkedin.com/in/juan-carlos-b%C3%A1guena-902406b/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></span>
                    </div>
                </div>
            </div>
            <!-- box ends -->
            <!-- box starts -->
            <div class="col-md-4">
                <div class="team-box">
                    <div class="box-upper">
                        <img src="img/team/07.png" class="img-responsive col-md-8 col-xs-12 centered">
                    </div>
                    <div class="box-med text-center">
                        <h3>Dr. Rishi Sharma</h3>
                        <p class="text-gold mb-1">Statistics and AI Advisor</p>
                        <p>Fishery Officer/Scientist at FAO, over 15 years of experience; is capable of coordinating and managing open water fisheries stock assessment and ecological issues.</p>
                        <span class="text-muted"><a href="https://www.linkedin.com/in/rishi-sharma-5aa6108" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></span>
                    </div>
                </div>
            </div>
            <!-- box ends -->

        </div><div class="row">
            <!-- box starts & if needed remove style from col-md-4 div-->
            <div class="col-md-4" style="float: none; margin: 0 auto;">
                <div class="team-box">
                    <div class="box-upper">
                        <img src="img/team/11.png" class="img-responsive col-md-8 col-xs-12 centered">
                    </div>
                    <div class="box-med text-center">
                        <h3>Mr. Theodosis Mourouzis</h3>
                        <p class="text-gold mb-1">Advisor</p>
                        <p>
                            Dr Theodosis (Theo) Mourouzis is a Research Fellow at the UCL Centre for Blockchain
                            Technologies (UCL CBT) and Programme Director of the MSc in Business Intelligence and
                            Data Analytics at the Cyprus International Institute of Management (CIIM).
                        </p>
                        <span class="text-muted"><a href="https://www.linkedin.com/in/theodosis-mourouzis-phd-58556a15/"
                                                    target="_blank"><i class="fa fa-linkedin"
                                                                       aria-hidden="true"></i></a></span>
                    </div>
                </div>
            </div>
            <!-- box ends -->
            <!-- box starts & if needed remove style from col-md-4 div-->
            <div class="col-md-4" style="float: none; margin: 0 auto;">
                <div class="team-box">
                    <div class="box-upper">
                        <img src="https://sportco.io/img/team/12.png" class="img-responsive col-md-8 col-xs-12 centered">
                    </div>
                    <div class="box-med text-center">
                        <h3>Ben Acheson</h3>
                        <p class="text-gold mb-1">Investment Advisor</p>
                        <p>
                            Ben has 20 years of business experience, with deep expertise in digital marketing, investment and technology. His strong track record of investment in and promotion of successful businesses is matched only by his international reputation for helping startups to grow.

                        </p>
                        <!--<span class="text-muted"><a href="https://www.linkedin.com/in/theodosis-mourouzis-phd-58556a15/"
                                                    target="_blank"><i class="fa fa-linkedin"
                                                                       aria-hidden="true"></i></a></span>-->
                    </div>
                </div>
            </div>
            <!-- box ends -->
            <div class="col-md-4" style="float: none; margin: 0 auto;">
                <div class="team-box">
                    <div class="box-upper">
                        <img src="https://sportco.io/img/team/13.png" class="img-responsive col-md-8 col-xs-12 centered">
                    </div>
                    <div class="box-med text-center">
                        <h3>Jon Ching</h3>
                        <p class="text-gold mb-1">Marketing Advisor for China</p>
                        <p>
                            Graduated from Univ. of Kent majoring in Actuarial Science. He has 8 yrs of experience in the Financial Sector. When he was a former General Manager in Tradslide Trading Technologies Limited, they won the IUIA Start-up competition UK in 2015. He then joined Infinox Capital as Head of PR & Marketing for their South Asia & China business unit, where he was responsible for devising marketing and portfolio strategy across Infinox capital's brands.

                        </p>
                        <span class="text-muted"><a href="https://www.linkedin.com/in/jon7280/"
                                                    target="_blank"><i class="fa fa-linkedin"
                                                                       aria-hidden="true"></i></a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="partners" class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="text-center text-uppercase section-small-heading">我們的合作夥伴</p><br>&nbsp;
            </div>
        </div>
        <div class="row m-b-30">
            <div class="col-md-3">
                <h4 class="service-heading"><a href="http://www.fincapadvisers.com/">FInCap</a></h4>
                <hr>
                <p class="text-muted">FInCap 是一家領先的財務與法務公司SportCo 與 FInCap 攜手合作，制訂資本增值計畫結構。</p>
            </div>
            <div class="col-md-3">
                <h4 class="service-heading"><a href="http://sportswizzleague.com/">SportsWizz League</a></h4>
                <hr>
                <p class="text-muted">這個技術、產品與運動內容開發團隊會使用適合 SportCo 的技術，提供所需的運動產品及服務。</p>
            </div>
            <div class="col-md-3">
                <h4 class="service-heading">TechFinancials</h4>
                <hr>
                <p class="text-muted">TechFinancials 是一家歐洲領先的金融科技公司。SportCo 與 TechFinancials 合作，持續開發與整合代幣交換及交易平台。</p>
            </div>
            <div class="col-md-3">
                <h4 class="service-heading"><a href="https://blockchaintechteam.com/">區塊鍊技術團隊</a></h4>
                <hr>
                <p class="text-muted">我們會與區塊鍊技術團隊合作，設立各項標準與建立各個平台，以提供區塊鍊及代幣技術。</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 offset-md-2">
                <h4 class="service-heading"><a href="https://tokentarget.com/">Token Target</a></h4>
                <hr>
                <p class="text-muted">Token Target
                    是在金融科技、財務、投資銀行以及加密貨幣等產業具有資深背景的專業團隊。他們的使命是協助首次代幣發行及代幣銷售品牌獲得期望的資本募資，並提升該幣種與代幣的價值。</p>
            </div>
            <div class="col-md-4">
                <h4 class="service-heading"><a href="http://pilanimation.com/">Pil Animation</a></h4>
                <hr>
                <p class="text-muted">Pil Animation 於 1998 年由榮獲多項大獎的動畫師兼導演 Sharon Gazit
                    創辦，他現在是創意總監暨共同執行長。他們的動畫專案曾斬獲世界多個獎項，並且滿足以色列與全球市場多家頂尖公司、企業、廣告與製作代理商和新創公司的需求。</p>
            </div>
        </div>
    </div>
</section>

<section id="techno">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="text-center text-uppercase section-small-heading">我們的技術</p><br>&nbsp;
            </div>
        </div>
        <div class="row text-center tech_row">
            <div class="col-md-4">
 <span class="fa-stack fa-4x wow zoomIn">
 <i class="fa fa-circle fa-stack-2x text-primary"></i>
 <!--<img src="img/networks.png" class="img-fluid img-tech">-->
 </span>
                <h4 class="service-heading">區塊鍊網路</h4>
                <p class="text-muted">SPORTCO 會使用 Ethereum 主網路來建立「獎勵忠誠計畫」，以及點對點的內容與遊戲交換。這項技術將可能用於全世界數以百萬計的運動社群粉絲</p>
            </div>
            <div class="col-md-4">
 <span class="fa-stack fa-4x wow zoomIn">
 <i class="fa fa-circle fa-stack-2x text-primary"></i>
 <!--<img src="img/sportsdata.png" class="img-fluid img-tech">-->
 </span>
                <h4 class="service-heading">用於運動資料的人工智慧</h4>
                <p class="text-muted">隨著技術不斷演進讓資料分析的次數增加，SPORTCO 會將人工智慧用於運動產業，以促進運動訓練與表現、票券、商品銷售和統計數據分析等活動的進行。</p>
            </div>
            <div class="col-md-4">
 <span class="fa-stack fa-4x wow zoomIn">
 <i class="fa fa-circle fa-stack-2x text-primary"></i>
 <!--<img src="img/clouddata.png" class="img-fluid img-tech">-->
 </span>
                <h4 class="service-heading">雲端資料</h4>
                <p class="text-muted">SPORTCO
                    會使用雲端基礎的資料服務，在可擴充的隨需環境中提供大量的即時更新資料。會從多個資料來源與物聯網感測器收集即時資料。資料儲存庫能夠提供資料來源，以便進行分析與資料探勘。</p>
            </div>
        </div>
        <div class="row text-center tech_row">
            <div class="col-md-4 offset-md-2">
 <span class="fa-stack fa-4x wow zoomIn">
 <i class="fa fa-circle fa-stack-2x text-primary"></i>
 <!--<img src="img/backenddevelopment.png" class="img-fluid img-tech">-->
 </span>
                <h4 class="service-heading">後端開發</h4>
                <p class="text-muted">SPORTCO
                    會投入可靠且可擴充之後端解決方案的開發，以供運動生態系統使用。應用程式運用整合的區塊鏈分散式帳本技術，以私密方式為客戶提供服務。雲端式介面採用模組化的微服務基礎架構，提供最佳的低延遲更新。</p>
            </div>
            <div class="col-md-4">
 <span class="fa-stack fa-4x wow zoomIn">
 <i class="fa fa-circle fa-stack-2x text-primary"></i>
 <!--<img src="img/web_apps.png" class="img-fluid img-tech">-->
 </span>
                <h4 class="service-heading">網路及應用程式層</h4>
                <p class="text-muted">SPORTCO 使用最新的技術來開發多項用於行動遊戲、預測工具、即時分數以及社群平台的網頁、Anrdoid 以及 iOS 介面。UI/UX
                    設計師擁有豐富經驗，能夠確保完美的用戶體驗與參與程度。</p>
            </div>
        </div>
    </div>
</section>

<section id="why" class="bg-light text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="text-center text-uppercase section-small-heading">為何選擇我們</p>
                <p class="service-heading">我們擁有卓越技能、專業知識、平台以及熱情，<br>能夠推動 SPORTCO 建立全新的運動數位生態系統。<br>&nbsp;
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
                        <p>經驗豐富的團隊</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="row">
                    <div class="col-md-12">
                        <img src="img/producers.png" class="img-fluid centered m-b-20">
                    </div>
                    <div class="col-md-12">
                        <p>現有的運動製作人與服務平台</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="row">
                    <div class="col-md-12">
                        <img src="img/trade.png" class="img-fluid centered m-b-20">
                    </div>
                    <div class="col-md-12">
                        <p>功能實用的交易貨幣</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="row">
                    <div class="col-md-12">
                        <img src="img/multiple-sports.png" class="img-fluid centered m-b-20">
                    </div>
                    <div class="col-md-12">
                        <p>SPORTCO Global Club 包含多種運動、地理區以及社群</p>
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
                        <p>運動聯賽與點對點競賽</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="row">
                    <div class="col-md-12">
                        <img src="img/blockchain.png" class="img-fluid centered m-b-20">
                    </div>
                    <div class="col-md-12">
                        <p>區塊鏈的使用</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="row">
                    <div class="col-md-12">
                        <img src="img/communities.png" class="img-fluid centered m-b-20">
                    </div>
                    <div class="col-md-12">
                        <p>目前擁有強大的運動社群</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="row">
                    <div class="col-md-12">
                        <img src="img/economy.png" class="img-fluid centered m-b-20">
                    </div>
                    <div class="col-md-12">
                        <p>運動市場及市場經濟</p>
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
                        <p>獎勵對運動的熱情</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="row">
                    <div class="col-md-12">
                        <img src="img/multiple-sports.png" class="img-fluid centered m-b-20">
                    </div>
                    <div class="col-md-12">
                        <p>豐富的流程、遊戲以及功能</p>
                    </div>
                </div>
            </div>


            <div class="col-md-3 col-sm-6">
                <div class="row">
                    <div class="col-md-12">
                        <img src="img/producers.png" class="img-fluid centered m-b-20">
                    </div>
                    <div class="col-md-12">
                        <p>AI、AR 及 SWARM 技術</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="row">
                    <div class="col-md-12">
                        <img src="img/Partners.png" class="img-fluid centered m-b-20">
                    </div>
                    <div class="col-md-12">
                        <p>現實中的品牌與運動機構合作夥伴</p>
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
                <p class="text-uppercase text-center section-small-heading">運動大使</p><br>&nbsp;
            </div>
            <div class="col-lg-12">
                <div class="bxslider">
                    <div>
                        <div class="row">
                            <div class="col-md-5 mob-div mb-4">
                                <img src="img/amb/tim.jpg" class="img-fluid centered bximg">
                            </div>
                            <div class="col-md-7">
                                <h3 class="text-left text-uppercase">tim de leede</h3>
                                <p class="text-left text-uppercase">kncb cricket halden</p>
                                <blockquote>
                                    <p><i><span class="quote left">「</span>這是運動迷的全新時代。觀眾不只會在賽事進行中觀賞賽事，而且只要有時間就會關心賽事進行狀況，而透過
                                            Sportco 這樣的平台，他們就能夠分享他們的觀點，並閱讀來自全世界運動愛好者的背景資訊。<span
                                                    class="quote right">」</span></i></p>
                                </blockquote>
                                <p>Tim de Leede 曾為荷蘭板球球員，以荷蘭國家隊單日國際賽球員的身份出賽長達 11 年的時間。他是一位全方位的右手球員，在 1996、2003 以及 2007
                                    年世界盃中代表荷蘭出賽。當他在 2007 年退休後，隨後成為教練，並在 2015 年時被任命為法國國家板球隊的首席教練。</p>
                                <p>Tim de Leede 名列於 KNCB (Netherlands Cricket Association，荷蘭板球理事會) 名人堂中。</p>
                                <a class="btn btn-warning text-uppercase"
                                   href="<?= siteurl(); ?>testimonial/tim-de-leede.php" target="_blank">閱讀更多資訊</a>
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
                                <h3 class="text-left text-uppercase">JUAN CARLOS</h3>
                                <p class="text-left text-uppercase">網球選手兼教練 </p>
                                <blockquote>
                                    <p><i><span class="quote left">「</span>運動這個產業是由選手和粉絲的熱情所推動，Sportco
                                            的平台讓這個產業邁入全新的階段。這個專案獲得了成熟的卓越技術的協助，而且我非常認同將運動迷置於一切本質核心的概念。我認為這個專案具有極大的潛力，並且是通訊及體育界領域的一大新聞。<span
                                                    class="quote right">」</span></i></p>
                                </blockquote>
                                <p>Juan Carlos Báguena 是一名網球教練，並且是西班牙前職業網球選手。他具有優異的執業水準，ATP 單打排名達到 190 名，雙打達到 100
                                    名。他曾獲得多項 ATP 大賽的雙打獎項，並在馬德里贏得一座 ATP 大賽單打獎項。</p>
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
                <p class="text-uppercase text-center">我們的平台</p>
            </div>
            <div class="col-md-12">
                <h2 class="service-heading text-center">SPORTCO 的應用程式與遊戲讓運動迷可以參與並組織社群。</h2><br>&nbsp;
            </div>
            <div class="col-md-12">
                <div class="row">

                    <div class="col-md-6 game_box">
                        <div class="row">
                            <div class="col-md-2">
                                <svg height="50" width="50">
                                    <circle cx="25" cy="25" r="20" fill="#6270FF"/>
                                </svg>
                            </div>
                            <div class="col-md-10">
                                <h4>SPORTCO 問答與趣聞</h4>
                                <p>成為您所屬俱樂部、國家/地區以及全世界的冠軍。加入運動問答與遊戲，展現你的知識並成為贏家，還能獲得各項頭銜。對問答獻計獻策，並贏得多項獎項。</p>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 game_box">
                        <div class="row">
                            <div class="col-md-2">
                                <svg height="50" width="50">
                                    <circle cx="25" cy="25" r="20" fill="#6270FF"/>
                                </svg>
                            </div>
                            <div class="col-md-10">
                                <h4>SPORTCO SWARM 社群</h4>
                                <p>你是否希望成為預測比賽結果的高手呢？透過 Swarm 技術，讓你能夠善用運動迷的群眾智慧，對運動競賽、團隊、選手以及他們的生活形態做出預測。</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 game_box">
                        <div class="row">
                            <div class="col-md-2">
                                <svg height="50" width="50">
                                    <circle cx="25" cy="25" r="20" fill="#6270FF"/>
                                </svg>
                            </div>
                            <div class="col-md-10">
                                <h4>SPORTCO 預測遊戲</h4>
                                <p>在場內場外、你的運動迷群組、你的國家/地區以及全世界成為運動賽事的預測大師，並贏得各項頭銜及獎項。做出你自己的預測，並上傳到我們的平台。</p>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 game_box">
                        <div class="row">
                            <div class="col-md-2">
                                <svg height="50" width="50">
                                    <circle cx="25" cy="25" r="20" fill="#6270FF"/>
                                </svg>
                            </div>
                            <div class="col-md-10">
                                <h4>SPORTCO 統計數據分析</h4>
                                <p>統計數據分析讓你能夠追蹤並分享前所未有的洞見以及這些洞見的深遠影響。</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 game_box">
                        <div class="row">
                            <div class="col-md-2">
                                <svg height="50" width="50">
                                    <circle cx="25" cy="25" r="20" fill="#6270FF"/>
                                </svg>
                            </div>
                            <div class="col-md-10">
                                <h4>SPORTCO 部落格</h4>
                                <p>部落格讓你能夠用文字紓發對於運動的熱情。</p>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 game_box">
                        <div class="row">
                            <div class="col-md-2">
                                <svg height="50" width="50">
                                    <circle cx="25" cy="25" r="20" fill="#6270FF"/>
                                </svg>
                            </div>
                            <div class="col-md-10">
                                <h4>SPORTS FANTASY</h4>
                                <p>加入這個以隊長和選手為中心的虛擬奇妙遊戲。</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 game_box">
                        <div class="row">
                            <div class="col-md-2">
                                <svg height="50" width="50">
                                    <circle cx="25" cy="25" r="20" fill="#6270FF"/>
                                </svg>
                            </div>
                            <div class="col-md-10">
                                <h4>運動影片</h4>
                                <p>分享你以身為粉絲的直覺所捕捉到，而媒體卻捕捉不到的運動影片。</p>
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
                <p class="text-uppercase section-small-heading">粉絲社群獎勵池</p>
                <p class="service-heading col-md-8 offset-md-2">運動迷在 SportCo 平台上對運動社群做出創意十足且富有高深見識的貢獻後，如何獲得獎勵的一些典範案例。
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
                <p>所有的貢獻都具有發表資格，而只有在經過編輯與版主的投票審核後，才能獲得獎勵。</p>
            </div>
        </div>
    </div>
</section>

<section id="fan" class="navy-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="text-uppercase section-small-heading">賞金獎勵</p>
                <p class="service-heading col-md-10 offset-md-1">成為 SPORTCO 商業模式的早期採納者。將 SPORTCO
                    的訊息傳給你的區塊鏈運動社群成員，並協助我們回饋全世界的運動迷，讓你自己也能獲得獎勵。</p>
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
                                <h5 class="text-center">寫一篇 400-600 字的部落格文章，說明你的社群為何應該對 SportCo 的 ICO
                                    做出貢獻，並在社群媒體上發佈給你的追蹤者看。</h5>
                            </div>
                            <div class="bounty-medium">
                                <h4 class="text-center">100 點</h4>
                            </div>
                            <div class="bounty-bottom">
                                <h4 class="text-center">&nbsp;</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bounty-box bounty-box2">
                            <div class="bounty-upper">
                                <h5 class="text-center">讓 50 個人在 SPORTCO 的 ICO 日轉發我們的 twitter 貼文。</h5>
                            </div>
                            <div class="bounty-medium">
                                <h4 class="text-center">50 點</h4>
                            </div>
                            <div class="bounty-bottom">
                                <h5 class="text-center">以 SPORTCO 幣提供獎勵</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bounty-box bounty-box3">
                            <div class="bounty-upper">
                                <h5 class="text-center">在 bitcoin talk 發佈 100-200 字的部落格文章，說明 SPORTCO 為何是當月的重點 ICO。</h5>
                            </div>
                            <div class="bounty-medium">
                                <h4 class="text-center">100 點</h4>
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

                <p>所有的貢獻都會經過我們的編輯與版主檢閱後進行核准。</p>
            </div>
        </div>
    </div>
</section>

<section id="contactSection">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <p class="text-uppercase text-center section-small-heading">聯絡表單</p>
                <p class="service-heading text-center col-md-10 offset-md-1">聯繫我們</p>
                <div id="back_result"></div>
                <br><br>
                <form class="contact-form">
                    <div class="row form-group">
                        <div class="col-md-6">
                            <input type="name" name="vname" class="form-control" placeholder="姓名">
                        </div>
                        <div class="col-md-6">
                            <input type="email" name="vemail" class="form-control" placeholder="電子郵件">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <input type="text" name="vsubject" class="form-control" placeholder="主旨">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <textarea name="vmessage" class="form-control" placeholder="Message" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-3">
                            <button class="btn btn-primary text-uppercase btnSubmit" type="button">傳送訊息</button>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
            </div>
        </div>
    </div>
</div>
<script src="js/jquery.bxslider.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        function setHeight() {
            var win_ht = $(window).innerHeight();
            $('header').height(win_ht);
        }

        setHeight();
        $(window).resize(function () {
            setHeight();
        });

        $('.bxslider').bxSlider({
            mode: 'vertical',
            auto: true,
            speed: 500,
            slideMargin: 0,
            infiniteLoop: true,
            pager: true,
            controls: false,
            minSlides: 1,
            moveSlides: 1,
            adaptiveHeight: false
        });

        $(document).on("click", ".btnSubmit", function (e) {
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
                success: function (response) {
                    if (response == 1) {
                        var success = '<div class="alert alert-success alert-dismissable">\n' +
                            '  <button type="button" class="close" data-dismiss="alert">×</button>\n' +
                            '  <strong>Thanks!</strong> We have received your request.\n' +
                            '</div>'
                        $('#back_result').html(success);
                        $('.contact-form').find('input,textarea').val('');
                    }
                    else {
                        var error = '<div class="alert alert-info alert-dismissable">\n' +
                            '  <button type="button" class="close" data-dismiss="alert">×</button>\n' +
                            '  <strong>Error!</strong> Please check our the fields.\n' +
                            '</div>'
                        $('#back_result').html(error);
                        setTimeout(function () {
                            $('#back_result').html('');
                        }, 4000);
                    }
                }
            })
        });


        var deadline = 'july 31 2018 23:59:59 GMT+0530';

        function getTimeRemaining(endtime){
            var t = Date.parse(endtime) - Date.parse(new Date());
            var seconds = Math.floor( (t/1000) % 60 );
            var minutes = Math.floor( (t/1000/60) % 60 );
            var hours = Math.floor( (t/(1000*60*60)) % 24 );
            var days = Math.floor( t/(1000*60*60*24) );
            return {
                'total': t,
                'days': days,
                'hours': hours,
                'minutes': minutes,
                'seconds': seconds
            };
        }

        function initializeClock(endtime){
            var timeinterval = setInterval(function(){
                var t = getTimeRemaining(endtime);
                var days = 0,hours = 0,minutes = 0,seconds = 0;
                days = t.days;
                if(t.days < 10){
                    days = "0"+days;
                }
                hours = t.hours;
                if(t.hours < 10){
                    hours = "0"+hours;
                }
                minutes = t.minutes;
                if(t.minutes < 10){
                    minutes = "0"+minutes;
                }
                seconds = t.seconds;
                if(t.seconds < 10){
                    seconds = "0"+seconds;
                }
                $('.count_day').html(days);
                $('.count_hour').html(hours);
                $('.count_min').html(minutes);
                $('.count_sec').html(seconds);

                if(t.total<=0){
                    clearInterval(timeinterval);
                    $('.count_day').html('00');
                    $('.count_hour').html('00');
                    $('.count_min').html('00');
                    $('.count_sec').html('00');
                }
            },1000);
        }

        initializeClock(deadline);
        $('input[name="vname"]').bind('keyup blur',function() {
            var node = $(this);
            node.val(node.val().replace(/[^A-Za-z_\s]/, ''));
        });
        $('input[name="vemail"]').bind('blur',function() {
            var thisis = $(this);
            var node = thisis.val();
            var regex = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            if(regex.test(node)==false){
                thisis.parent().find('.alert').remove();
                thisis.parent().append('<div class="alert alert-light my-alert mt-2" role="alert"><div class="down-arrow"></div>\n' +
                    'Please enter a valid email address.' +
                    '</div>');
                thisis.focus();
            }
            else{
                thisis.parent().find('.alert').remove();
            }
        });

        $(document).on("click", ".btn-subscribe", function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                data: {
                    "ajax": 2,
                    "sub_email": $("input[name='semail']").val()
                },
                success: function (response) {
                    if (response == 1) {
                        var success = '<div class="alert alert-success alert-dismissable">\n' +
                            '  <button type="button" class="close" data-dismiss="alert">×</button>\n' +
                            '  <strong>Thanks!</strong> You have been subscribed.\n' +
                            '</div>'
                        $('#sub_result').html(success);
                        $('.subscribe-form').find('input').val('');
                    }
                    else {
                        var error = '<div class="alert alert-info alert-dismissable">\n' +
                            '  <button type="button" class="close" data-dismiss="alert">×</button>\n' +
                            '  <strong>Error!</strong> Please check out the field.\n' +
                            '</div>'
                        $('#sub_result').html(error);
                        setTimeout(function () {
                            $('#sub_result').html('');
                        }, 4000);
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
        $('.team-box').on('click', function () {
            var img = $(this).children('.box-upper').find('img').attr('src');
            var name = $(this).children('.box-med').find('h3').html();
            var desig = $(this).children('.box-med').find('p.text-uppercase').html();
            var social_list = $(this).children('.box_lower').find('.team-social-list').html();
            var order = $(this).attr('data-order');
            $('.team-pop-img').attr('src', img);
            $('.team-pop-name').html(name);
            $('.team-pop-desig').html(desig);
            $('.team-pop-detail').html(desc[order]);
            $('.team-pop-list').find('ul.team-social-list').html(social_list);
        });
        var current_coin = $('.current-coin').attr('data-current');
        var total_coin = $('.total-coin').attr('data-total');
        var barwidth = (current_coin / total_coin) * 100;
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

    function onPlayerReady(event) {
    }

    function customPlay() {
        player.playVideo();
    }

    var done = false;

    function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
            done = true;
        }
    }

    $('.btn-play').on('click', function () {
        $('.videoCover').fadeOut(2800);
        setTimeout(function () {
            $('.videoCover').remove();
        }, 3200);
        customPlay();
    });
</script>
<?php include('footer.php'); ?>
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
