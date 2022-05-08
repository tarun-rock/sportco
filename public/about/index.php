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
?>
<?php include('header.php'); ?>

<style>
    .teamSection .nav.nav-tabs {
        margin: auto;
        border: 1px solid #ddd
    }

    .teamSection .nav.nav-tabs li a {
        color: #999;
        border: none;
        padding: 10px 35px;
    }

    .teamSection .nav.nav-tabs li a:hover {
        border: none;
    }

    .teamSection .nav.nav-tabs li a.active {
        background: #f0ad4e;
        border-radius: 0;
        color: #fff;
    }
</style>
<!-- Header -->
<header class="masthead">
    <div class="col-md-12">
        <div class="row">
            <div id="demo" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ul class="carousel-indicators">
                    <li data-target="#demo" data-slide-to="0" class="active"></li>
                    <li data-target="#demo" data-slide-to="1"></li>

                </ul>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/header_01.jpg" class="img-fluid banner-image">
                        <div class="carousel-caption">
                            <h1 class="text-uppercase centered section-carousel-heading">Join a 500K strong sport fans community</h1>
                        </div>
                    </div>

                    <div class="carousel-item ">
                        <img src="img/header_03.jpg" class="img-fluid banner-image">
                        <div class="carousel-caption">
                            <h1 class="text-uppercase centered section-carousel-heading">Receive Rewards for your Sports Passion</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--<div class="front-bottom col-md-6 col-sm-6 col-xs-10">
        <span class="intro-lead-in">PRE-ICO STARTS IN</span>
        <div class="countdown wow fadeInUpSlightly animated" data-wow-delay="0.9s" dir="ltr" style="visibility: visible; animation-delay: 0.9s;">
            <div class="header-style countdown__item">
                <div class="header-style countdown__number">
                    <div class="count_day">00</div>
                </div>
                <span class="countdown__label">DAYS</span>
            </div>
            <div class="header-style countdown__item">
                <div class="header-style countdown__number">
                    <div class="count_hour">00</div>
                </div>
                <span class="countdown__label">HOURS</span>
            </div>
            <div class="header-style countdown__item">
                <div class="header-style countdown__number">
                    <div class="count_min">00</div>
                </div>
                <span class="countdown__label">MINUTES</span>
            </div>
            <div class="header-style countdown__item">
                <div class="header-style countdown__number">
                    <div class="count_sec">00</div>
                </div>
                <span class="countdown__label">SECONDS</span>
            </div>
        </div>
    </div>-->
</header>
<!--
<div class="front-bottom col-md-2 col-sm-6 col-xs-10" style="background-color: #fff">
    <h3 class=h3_font style="color: #000; padding-top: 5px; "> Pre - Sale Is Live!</h3>-->
<!-- <span class="intro-lead-in" style="color: #000;">ICO STARTS IN</span>
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
</div> -->


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

<!--    <div class="">
        <div class="row pt-4">

            <div class="col-sm-5 text-left ico_price_1" style="color:#000;"><span"><b> PRE-ICO
                    PRICE</b></span>
            </div>
            <div class="ico_price_2" style="color: #000; text-align:right;">1 Sportco Coin = 0.04 USD</div>

            <div class="pt-3 col-md-12">
                <a href="#" style="text-decoration:none">
                    <center>
                        <a href="https://tokensale.sportco.io/#!/register"
                           style="background-color:#E9AB60; text-decoration: none; color: black !important;"
                           class="btn btn-block reserve_now">JOIN TOKEN SALE
                        </a>
                </a></center>
            </div>
        </div>
    </div>
    <div class="icon_live">
        <div class="pt-4">
            <div class="row">
                <div class="col-md-12 text-center" style="color: #0E3240">
                    <span><img src="img/live/bank.png" class="img-fluid centered_1"></span> <span
                            class="bank">BTC, ETH, USD</span>
                </div>
            </div>
            <div class="row text-center live_icons_1">
                <div class="col-md-12">
                    <a href="http://t.me/SPORTCO_token"><img src="img/live/telegram.png"
                                                             class="img-fluid centered_1 pr-2"></a>
                    <!--<a href="http://t.me/SPORTCO_token"><img src="img/live/bitcoin.png" class="img-fluid centered_1 pr-2"></a>
                    <!--<a href="http://t.me/SPORTCO_token"><img src="img/live/github.png" class="img-fluid centered_1 pr-2"></a>
                    <a href="https://www.facebook.com/SportCo.io/"><img src="img/live/facebook.png"
                                                                        class="img-fluid centered_1 pr-2"></a>
                    <a href="https://www.linkedin.com/company/sportco-io/"><img src="img/live/linkedin.png"
                                                                                class="img-fluid centered_1 pr-2"></a>
                    <a href="https://twitter.com/Sportcoio"><img src="img/live/twitter.png"
                                                                 class="img-fluid centered_1 pr-2"></a>
                </div>
            </div>
        </div>
    </div>

</div>-->


<!--change to ico listing-->
<!--<section id="raised">-->
<!--    <div class="container">-->
<!--        <div class="row">-->
<!--            <div class="col-lg-12 text-center">-->
<!--                <p class="text-center text-uppercase section-small-heading">ICO LISTINGS</p><br>&nbsp;-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="container">-->
<!--            <div class="row text-center tech_row">-->
<!--                <div class="col-md-3">-->
<!--                    <img src="img/live/logo/1-01.png" class="img-fluid">-->
<!--                    <p><h4 class="service-heading text-capitalize">Rate: <strong-->
<!--                                style="color: red;">4.6</strong><strong style="color: #0E3240 font-size:0.9rem">-->
<!--                            /5.0</strong></h4></p>-->
<!--                </div>-->
<!--                <div class="col-md-3">-->
<!--                    <img src="img/live/logo/1-02.png" class="img-fluid">-->
<!--                    <p><h4 class="service-heading text-capitalize">Rate: <strong-->
<!--                                style="color: red;">4.0</strong><strong style="color: #0E3240 font-size:0.9rem">-->
<!--                            /5.0</strong></h4></p>-->
<!--                </div>-->
<!--                <div class="col-md-3">-->
<!--                    <img src="img/live/logo/1-03.png" class="img-fluid">-->
<!--                    <p><h4 class="service-heading text-capitalize">Rate: <strong-->
<!--                                style="color: red;">Positive </strong><strong-->
<!--                                style="color: #0E3240 font-size:0.9rem"></strong></h4></p>-->
<!--                </div>-->
<!--                <div class="col-md-3">-->
<!--                    <img src="img/live/logo/1-04.png" class="img-fluid">-->
<!--                    <p><h4 class="service-heading text-capitalize">Rate: <strong-->
<!--                                style="color: red;">9.2</strong><strong style="color: #0E3240 font-size:0.9rem">-->
<!--                            /10</strong></h4></p>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--</section>-->
<!--<!--editing here end-->

<section class="video_holder">
    <div id="video_section"></div>
    <div class="videoCover">
        <img src="img/videobanner.jpg" class="img-fluid video-banner centered">
        <div class="video-btn-holder">
            <img src="img/playBtn.png" class="btn-play centered">
        </div>
    </div>
</section>


<!-- Trading token -->
<section class="bg-light" id="ourtoken">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="text-center text-uppercase section-small-heading">our token</p><br>&nbsp;
            </div>
        </div>
        <div class="row text-center tech_row">
            <div class="col-md-4">
                <img src="img/payouts.png" class="img-fluid">
                    <h4 class="service-heading text-capitalize">Mine your Passion and Win Rewards</h4>
                <p class="text-muted">Contribute sports content receive SPORTCO tokens. Get Social ratings on SPORTCO and receive more Tokens.</p>
            </div>
            <div class="col-md-4">
                <img src="img/sportsgroup.png" class="img-fluid">
                <h4 class="service-heading text-capitalize">SPORTCO shop</h4>
                <p class="text-muted">Use Tokens to buy Sports Merchandise, Memorabilia & Tickets, all at special price on our online marketplace.</p>
            </div>
            <div class="col-md-4">
                <img src="img/bumper_winner.png" class="img-fluid">
                <h4 class="service-heading text-capitalize">Sports Games and Contests</h4>
                <p class="text-muted">Use your earned SPORTCO Tokens to enter Sports Games & Contests like Predictions, Quizzes & Virtual Games and win more rewards</p>
            </div>
        </div>
    </div>
</section>


<section id="techno">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="text-center text-uppercase section-small-heading">OUR TECHNOLOGIES</p><br>&nbsp;
            </div>
        </div>
        <div class="row text-center tech_row">
            <div class="col-md-4">
            <span class="fa-stack fa-4x wow zoomIn">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <img src="img/networks.png" class="img-fluid img-tech">
            </span>
                <h4 class="service-heading">BLOCKCHAIN NETWORK</h4>
                <p class="text-muted">SPORTCO will use Ethereum mainnet to create Community Reward Program, and peer to
                    peer content. The technology is capable of handling several million sports community fans engaged
                    throughout the world.</p>
            </div>
            <div class="col-md-4">
            <span class="fa-stack fa-4x wow zoomIn">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <img src="img/sportsdata.png" class="img-fluid img-tech">
            </span>
                <h4 class="service-heading">AI IN SPORTS DATA</h4>
                <p class="text-muted">SPORTCO will deploy Artificial Intelligence in sports industry to increase data
                    analysis to facilitate in sports training & performance, ticketing, and statistical analysis.</p>
            </div>
            <div class="col-md-4" style="display: none;">
            <span class="fa-stack fa-4x wow zoomIn">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <img src="img/clouddata.png" class="img-fluid img-tech">
            </span>
                <h4 class="service-heading">CLOUD DATA</h4>
                <p class="text-muted">SPORTCO uses Cloud based data services to serve a multitude of real-time updates
                    in a scalable and on-demand environment. Realtime data is collected from various data feeds and IoT
                    sensors. The data repository can provide feeds for analysis and data mining.</p>
            </div>
            <div class="col-md-4">
            <span class="fa-stack fa-4x wow zoomIn">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <img src="img/web_apps.png" class="img-fluid img-tech">
            </span>
                <h4 class="service-heading">WEB &amp; APP LAYERS</h4>
                <p class="text-muted">SPORTCO will provide custom built interfaces for mobile games, predictors, live
                    scores and other social media platforms. Our UI and UX will be tuned to provide to provide unique
                    fan engagement and experience.</p>
            </div>


        </div>
        <div class="row text-center tech_row" style="display: none;">
            <div class="col-md-4 offset-md-2" style="display: none;">
            <span class="fa-stack fa-4x wow zoomIn">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <img src="img/backenddevelopment.png" class="img-fluid img-tech">
            </span>
                <h4 class="service-heading">BACKEND DEVELOPMENTS</h4>
                <p class="text-muted">SPORTCO is engaged in developing robust and scalable backend solutions for sports
                    eco-system. Applications use Blockchain distributed-ledger technology integrated to securely serve
                    customers. Cloud based interfaces use modular and micro-services architecture for optimum low
                    latency updates.</p>
            </div>
            <div class="col-md-4">
            <span class="fa-stack fa-4x wow zoomIn">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <img src="img/web_apps.png" class="img-fluid img-tech">
            </span>
                <h4 class="service-heading">WEB &amp; APP LAYERS</h4>
                <p class="text-muted">SPORTCO uses latest technologies to develop for various Web, Android, and iOS
                    interfaces for mobile games, predictors, live scores and social platform. UI/UX designers are
                    seasoned to provide best user experience and engagement.</p>
            </div>
        </div>
    </div>
</section>

<section id="why" class="bg-light text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="text-center text-uppercase section-small-heading">WHY US</p>
                <p class="service-heading">We have the skills, expertise, platforms and passion<br> to drive SPORTCO to
                    create a new sport digital eco-system.<br>&nbsp;
                </p><br>&nbsp;
            </div>
        </div>
        <div class="row text-center reason_row">

            <div class="col-md-4 col-sm-3">
                <div class="row">
                    <div class="col-md-12">
                        <img src="img/rewards.png" class="img-fluid centered m-b-20">
                    </div>
                    <div class="col-md-12">
                        <p>Reward Sports Passion</p>
                    </div>
                </div>
            </div>


            <div class="col-md-4 col-sm-3">
                <div class="row">
                    <div class="col-md-12">
                        <img src="img/team.png" class="img-fluid centered m-b-20">
                    </div>
                    <div class="col-md-12">
                        <p>Experienced Team</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-3">
                <div class="row">
                    <div class="col-md-12">
                        <img src="img/producers.png" class="img-fluid centered m-b-20">
                    </div>
                    <div class="col-md-12">
                        <p>Existing Sports Producers &amp; Services Platforms</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-3" style="display:none;">
                <div class="row">
                    <div class="col-md-12">
                        <img src="img/trade.png" class="img-fluid centered m-b-20">
                    </div>
                    <div class="col-md-12">
                        <p>Trade Token with Utility</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="row text-center reason_row">

            <div class="col-md-4 col-sm-3">
                <div class="row">
                    <div class="col-md-12">
                        <img src="img/multiple-sports.png" class="img-fluid centered m-b-20">
                    </div>
                    <div class="col-md-12">
                        <p>Multiple Sports, Geographies & Communities as SPORTCO Global Club</p>
                    </div>
                </div>
            </div>


            <div class="col-md-4 col-sm-3">
                <div class="row">
                    <div class="col-md-12">
                        <img src="img/Tournament.png" class="img-fluid centered m-b-20">
                    </div>
                    <div class="col-md-12">
                        <p>Sports Tournament & Peer-Peer Contests</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-3" style="display:none;">
                <div class="row">
                    <div class="col-md-12">
                        <img src="img/blockchain.png" class="img-fluid centered m-b-20">
                    </div>
                    <div class="col-md-12">
                        <p>Use of BlockChain</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-3">
                <div class="row">
                    <div class="col-md-12">
                        <img src="img/communities.png" class="img-fluid centered m-b-20">
                    </div>
                    <div class="col-md-12">
                        <p>Experience with Strong Sports Communities</p>
                    </div>
                </div>
            </div>


            <div class="col-md-4 col-sm-3" style="display:none;">
                <div class="row">
                    <div class="col-md-12">
                        <img src="img/economy.png" class="img-fluid centered m-b-20">
                    </div>
                    <div class="col-md-12">
                        <p>Sports Market & Market Economy</p>
                    </div>
                </div>
            </div>


        </div>
        <div class="row text-center reason_row">

            <div class="col-md-4 col-sm-3">
                <div class="row">
                    <div class="col-md-12">
                        <img src="img/multiple-sports.png" class="img-fluid centered m-b-20">
                    </div>
                    <div class="col-md-12">
                        <p>Multiple Procedures, Games, Services &amp; Features</p>
                    </div>
                </div>
            </div>


            <div class="col-md-4 col-sm-3">
                <div class="row">
                    <div class="col-md-12">
                        <img src="img/producers.png" class="img-fluid centered m-b-20">
                    </div>
                    <div class="col-md-12">
                        <p>AI, AR &amp; SWARM Technologies</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-3>
            <div class=" row
            ">
            <div class="col-md-12">
                <img src="img/Partners.png" class="img-fluid centered m-b-20">
            </div>
            <div class="col-md-12">
                <p>Professional Athletes and Brand Ambassadors</p>
            </div>
        </div>

    </div>
    </div>
    </div>
</section>


<?php if(false){ ?>
<!-- Product Column -->
<section id="distribution" class="navy-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="text-center text-uppercase section-small-heading">TOKEN DISTRIBUTION</p><br>&nbsp;
            </div>
        </div>
        <div class="row">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12" style="margin: 0px auto;text-align: center;">
                        <div class="padding-top-60 padding-left-60 token-btn-holder">
                            <img src="img/logo4x.png" class="img-fluid col-md-9 centered">
                            <div class="row clear padding-top-60"></div>
                            <a class="btn btn-xl text-uppercase btn-wp" href="assets/whitepaper.pdf" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;WHITEPAPER&nbsp;&nbsp;&nbsp;&nbsp;</a><br>&nbsp;<br>
                            <a class="btn btn-warning btn-xl text-uppercase"
                               href="https://tokensale.sportco.io/#!/register" target="_blank">&nbsp;&nbsp;JOIN TOKEN
                                SALE&nbsp;&nbsp;&nbsp;</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 light_div">
                        <div style="clear: both;content: ' ';display: table"></div>
                        <div class="yellow_box">
                            <h5>AVAILABLE TOKENS IN WAVE 1 FOR COMMUNITY-FUNDING</h5>
                            <span class="large_no">500,000,000</span>
                            <!--<p class="f-12">Additional 125 Million Tokens reserved for Users and Fan Rewards - to be
                                distributed over 10 years.</p>-->
                        </div>
                        <hr>
                        <div class="">
                            <h5>PRE-ICO PRICE</h5>
                            <div style="clear: both;content: ' ';display: table"></div>

                            <p class="trade_rate">1 SPORTCO Coin = 0.045 USD</p>
                            <div style="clear: both;content: ' ';display: table"></div>
                            <!--  <p>Join Us Via Crypto Currency</p>-->
                            <div style="clear: both;content: ' ';display: table"></div>
                        </div>
                        <hr>
                        <div class="">
                            <h5>ICO Wave 1 PRICE</h5>
                            <p class="trade_rate">1 SPORTCO Coin = 0.05 USD</p>
                            <!--<p>Participate Via ETH</p>-->
                            <div style="clear: both;content: ' ';display: table"></div>
                        </div>
                        <div class="">
                            <p>Participate via ETH, BTC, USD</p>
                            <div style="clear: both;content: ' ';display: table"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2018-05-08: The section "Amount Raised" to be removed. -->
<section id="raised" style="display: none;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="text-center text-uppercase section-small-heading">AMOUNT RAISED</p><br>&nbsp;
            </div>
        </div>
        <div class="row">
            <div class="cx-skill col-md-4 offset-md-4">
                <div class="cx-skill-inner">
                    <!-- Start single skill -->
                    <div class="cx-single-skill">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="current-coin" data-current="15000000"><strong>150,000</strong> USD</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-right total-coin" data-total="24000000"><strong>24,000,000</strong> USD
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
                    <!-- End single skill -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team -->
<section class="bg-light" id="param">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="text-center text-uppercase section-small-heading">CROWDFUNDING PARAMETERS &amp; TOKEN
                    ALLOCATION</p><br>&nbsp;
            </div>
        </div>
        <div class="row text-center m-b-50">
            <div class="col-md-4">
                <h4 class="service-heading">PRE-ICO</h4>
                <p class="text-muted">We will release a limited supply of Tokens in Pre-ICO.
                    Any Pre-ICO Tokens unsold will go to the ICO Pool</p>

                <!--<span><strong>Starting Date: </strong>18th May, 2018</span><br>-->
                <!--<span><strong>Ending Date: </strong>31st May, 2018</span><br>-->
            </div>
            <div class="col-md-4">
                <h4 class="service-heading">ICO</h4>
                <span class="text-muted">At the end of  ICO Wave 1, unsold tokens will be put into the Rewards Pool.</span><br>
                <!--<span><strong>Starting Date: </strong>1st June, 2018</span><br>
                <span><strong>Ending Date: </strong>30th June, 2018</span><br>-->
            </div>
            <div class="col-md-4">
                <h4 class="service-heading">SPORTCO</h4>
                <span><strong>Wave 1 Supply of Tokens: </strong>500,000,000</span><br>
                <span><strong>Decimal: </strong>18</span><br>
                <span><strong>Symbol: </strong>SPRT</span><br>
                <span><strong>Blockchain: </strong>Ethereum</span>
            </div>
        </div>
        <div class="row">
            <div class="container-fluid">
                <img src="img/token-allocation-trans3.png" class="img-fluid centered">
            </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="text-center text-uppercase section-small-heading">USAGE OF FUNDS</p><br>&nbsp;
            </div>
        </div>
        <div class="row">
            <div class="cx-skill">
                <div class="cx-skill-inner">
                    <!-- Start single skill -->
                    <div class="cx-single-skill">
                        <p>SPORTS PRODUCT TECHNOLOGY DEVELOPMENT&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span
                                        class="progress-bold">4M</span></strong></p>
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
                    <!-- End single skill -->
                    <!-- Start single skill -->
                    <div class="cx-single-skill">
                        <p>ACCELERATED FAN COMMUNITIES ACQUISITION&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span
                                        class="progress-bold">5M</span></strong></p>
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
                    <!-- End single skill -->
                    <!-- Start single skill -->
                    <div class="cx-single-skill">
                        <p>SPORTCO ONLINE MARKET PLACE CREATION&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span
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
                    <!-- End single skill -->
                    <!-- Start single skill -->
                    <div class="cx-single-skill">
                        <p>DISCOVER THE CHAMPS ROLLOUT&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span
                                        class="progress-bold">1M</span></strong></p>
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
                    <!-- End single skill -->
                    <!-- Start single skill -->
                    <div class="cx-single-skill">
                        <p>EXPANSION OF GLOBAL SPORTS &amp; ADDITION OF REGIONAL SPORTS&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span
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
                    <!-- End single skill -->
                    <!-- Start single skill -->
                    <div class="cx-single-skill">
                        <p>SPORTS STUDIO CREATION WHICH FANS HAVE ACCESS TO&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span
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
                    <!-- End single skill -->
                    <!-- Start single skill -->
                    <div class="cx-single-skill">
                        <p>AI DRIVEN STATS & PREDICTOR FOR SPORTS UTILIZING AUGMENTED REALITY & SWARM&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span
                                        class="progress-bold">4M</span></strong></p>
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
                    <!-- End single skill -->
                    <!-- Start single skill -->
                    <div class="cx-single-skill">
                        <p>BLOCKCHAIN DRIVEN COMMUNITY REWARD PROGRAM &amp; MEMORABILIA MANAGEMENT&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span
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
                    <!-- End single skill -->
                </div>
            </div>
        </div>
</section>
<?php } ?>
<!-- Services -->
<section id="timeline" class="navy-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="text-center text-uppercase section-small-heading">Our Timeline</p><br>&nbsp;
            </div>
            <div class="col-lg-12">
                <img src="img/timeline.png" class="img-fluid">
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-2 offset-lg-5 m-t-60">
                      <?php if(false) { ?>
                        <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger centered" href="timeline.php"
                           target="_blank">VIEW DETAILS</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="team" class="teamSection">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="text-uppercase text-center">sportco team</p>
                <p class="service-heading">Having a collective business experience of over 200 years, our team has the
                    drive, experience and what it takes to bring an idea to life and make a business successful.</p><br>&nbsp;

            </div>

            <ul class="nav nav-tabs" role="tablist">

                <li class="nav-item">
                    <a class="nav-link active" href="#profile" role="tab" data-toggle="tab">Team</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#buzz" role="tab" data-toggle="tab">Advisors</a>
                </li>

            </ul>


        </div>

        <div class="tab-content"> <!--TEAM-->
            <div role="tabpanel" class="tab-pane fade in active show" id="profile">
                <div class="row">
                    <!-- box starts -->
                    <div class="col-md-4">
                        <div class="team-box">
                            <div class="box-upper">
                                <img src="img/team/1-05.png" class="img-responsive col-md-8 col-xs-12 centered">
                            </div>
                            <div class="box-med text-center">
                                <h3>Anuj Sharma</h3>
                                <p class="text-gold mb-1">CEO</p>
                                <p>Anuj is the founder and CEO of Sportco, SportsWizz Limited, and Abacus (Seychelles)
                                    Limited. Earning his PGDM from Indian Institute of Management Ahmedabad in
                                    Marketing, Finance, and Business Management, Anuj has over 25 years of experience
                                    across sports media, financial services and technology industries. Previously, he
                                    served as
                                    a principal consultant and head of the Retail & CPG Domain team at Infosys
                                    Technologies Ltd. As an entrepreneur, he has brought these three essential
                                    components
                                    together to envision the Sportco eco-system using token economy based on blockchain
                                    technology.</p>
                                <span class="text-muted"><a href="https://www.linkedin.com/in/anujsharma17/"
                                                            target="_blank"><i
                                                class="fa fa-linkedin" aria-hidden="true"></i></a></span>
                            </div>
                        </div>
                    </div>
                    <!-- box ends -->

                    <!-- box starts -->
                    <div class="col-md-4">
                        <div class="team-box">
                            <div class="box-upper">
                                <img src="img/team/1-01.png" class="img-responsive col-md-8 col-xs-12 centered">
                            </div>
                            <div class="box-med text-center">
                                <h3>Phiroze Mogrelia</h3>
                                <p class="text-gold mb-1">COO</p>
                                <p>Phiroze is both the COO and a Senior Advisor for Sportco, with experience leading
                                    different teams across the globe. Receiving his Master of Science in Digital
                                    Currency
                                    from the University of Nicosia, he expanded his knowledge in the technical
                                    underpinnings of digital currency and now advises Sportco on how to strategically
                                    grow
                                    its international footprint. Before Sportco, Phiroze served as the Global Head of
                                    Lending and Liquidity Solutions, Products and Solutions, and Private Banking
                                    International at ABN AMRO Bank.</p>
                                <span class="text-muted"><a href="https://www.linkedin.com/in/phirozemogrelia/"
                                                            target="_blank"><i
                                                class="fa fa-linkedin" aria-hidden="true"></i></a></span>
                            </div>
                        </div>
                    </div>
                    <!-- box ends -->

                    <!-- box starts -->
                    <div class="col-md-4">
                        <div class="team-box">
                            <div class="box-upper">
                                <img src="img/team/23.png" class="img-responsive col-md-8 col-xs-12 centered">
                            </div>
                            <div class="box-med text-center">
                                <h3>Michael Serres</h3>
                                <p class="text-gold mb-1">CTO</p>
                                <p>Michael is CTO and Head of Market Analytics for Sportco. He is co-founder at Blockleo
                                    Bitfolios, a news, insights and exchange platform for cryptocurrencies and formerly
                                    Head of Digital for Asia Pacific at Manulife and at BlackRock, the world’s largest
                                    asset manager. Michael holds a joint BSc in Maths and Computer Science from
                                    University of East Anglia in the United Kingdom and speaks fluent English, French,
                                    Spanish and Italian.</p>
                                <span class="text-muted"><a href="https://www.linkedin.com/in/michael-serres/"
                                                            target="_blank"><i
                                                class="fa fa-linkedin" aria-hidden="true"></i></a></span>
                            </div>
                        </div>
                    </div>
                    <!-- box ends -->

                </div>

                <div class="row">


                    <!-- box starts & if needed remove style from col-md-4 div-->
                    <div class="col-md-4" style="float: none; margin: 0 auto;">
                        <div class="team-box">
                            <div class="box-upper">
                                <img src="img/team/24.png" class="img-responsive col-md-8 col-xs-12 centered">
                            </div>
                            <div class="box-med text-center">
                                <h3>Amrinder Singh Mallhi </h3>
                                <p class="text-gold mb-1"> Product Development</p>
                                <p>

                                    Along with spearheading product development at Sportco, Amrinder serves as the
                                    product head at SportsWizz League, where he heads the design and development of
                                    digital media products for the company. With extensive experience in technology
                                    product design and development, he was also the co-founder and product head of
                                    OneMedCrew Pvt. Ltd. While serving those roles, Amrinder designed, developed and
                                    launched a mobile digital health solution platform that leveraged technology to
                                    provide
                                    continuous care for people with Diabetes.
                                </p>
                                <!-- <span class="text-muted"><a href="https://www.linkedin.com/in/selveena-samy-12453bb8/"
                                                             target="_blank"><i class="fa fa-linkedin"
                                                                                aria-hidden="true"></i></a></span>-->
                            </div>
                        </div>
                    </div>
                    <!-- box ends -->


                    <!-- box starts & if needed remove style from col-md-4 div-->
                    <div class="col-md-4" style="float: none; margin: 0 auto;">
                        <div class="team-box">
                            <div class="box-upper">
                                <img src="img/team/19.png" class="img-responsive col-md-8 col-xs-12 centered">
                            </div>
                            <div class="box-med text-center">
                                <h3>Devang Prasad</h3>
                                <p class="text-gold mb-1"> Content Development</p>
                                <p>
                                    Devang is a content and communications professional with skills particularly in
                                    content
                                    marketing, social media, journalism, and research methods. Having graduated with a
                                    Bachelors of Arts from University of California, Berkeley in interdisciplinary field
                                    studies, Devang worked at Floh as a community manager and eventually moved on to
                                    serving as the content and community manager for SportsWizz League.

                                </p>
                                <!-- <span class="text-muted"><a href="https://www.linkedin.com/in/selveena-samy-12453bb8/"
                                                             target="_blank"><i class="fa fa-linkedin"
                                                                                aria-hidden="true"></i></a></span>-->
                            </div>
                        </div>
                    </div>
                    <!-- box ends -->

                    <!-- box starts & if needed remove style from col-md-4 div-->
                    <div class="col-md-4" style="float: none; margin: 0 auto;">
                        <div class="team-box">
                            <div class="box-upper">
                                <img src="img/team/20.png" class="img-responsive col-md-8 col-xs-12 centered">
                            </div>
                            <div class="box-med text-center">
                                <h3>Manpreet Singh</h3>
                                <p class="text-gold mb-1"> Technology Development</p>
                                <p>

                                    Manpreet has over 8-years experience in development, mentoring, and managing mobile
                                    applications. An expert on iOS development using Objective-C and Swift programming
                                    languages, interfacing web service APIs, JSON and other third party libraries,
                                    Manpreet
                                    has extensive exposure in delivering software solutions to Retail, Real Estate,
                                    HealthCare, Financial, and Education sectors.
                                </p>
                                <!-- <span class="text-muted"><a href="https://www.linkedin.com/in/selveena-samy-12453bb8/"
                                                             target="_blank"><i class="fa fa-linkedin"
                                                                                aria-hidden="true"></i></a></span>-->
                            </div>
                        </div>
                    </div>
                    <!-- box ends -->

                </div>

                <div class="row">

                    <!-- box starts & if needed remove style from col-md-4 div-->
                    <div class="col-md-4" style="float: none; margin: 0 auto;">
                        <div class="team-box">
                            <div class="box-upper">
                                <img src="img/team/22.png" class="img-responsive col-md-8 col-xs-12 centered">
                            </div>
                            <div class="box-med text-center">
                                <h3>Rajiv Saini </h3>
                                <p class="text-gold mb-1"> Server and Applications Admin</p>
                                <p>
                                    A seasoned software professional and systems architect, Rajiv worked in the
                                    Information Technology domain for over 28-years, including 6-years in the USA.
                                    Receiving his PGD in Operations Management from Indira Gandhi National Open
                                    University, Rajiv previously worked at Shunya Computing Lab as a systems architect.
                                    He moved on to serve as CTO at deazy and CIO at SportsWizz League before joining
                                    Sportco as the Server and Applications Admin.
                                </p>
                                <!-- <span class="text-muted"><a href="https://www.linkedin.com/in/selveena-samy-12453bb8/"
                                                             target="_blank"><i class="fa fa-linkedin"
                                                                                aria-hidden="true"></i></a></span>-->
                            </div>
                        </div>
                    </div>
                    <!-- box ends -->


                    <!-- box starts & if needed remove style from col-md-4 div-->
                    <div class="col-md-4" style="float: none; margin: 0 auto;">
                        <div class="team-box">
                            <div class="box-upper">
                                <img src="img/team/17.png" class="img-responsive col-md-8 col-xs-12 centered">
                            </div>
                            <div class="box-med text-center">
                                <h3>Hans Madhoo</h3>
                                <p class="text-gold mb-1">Finance & Accounting</p>
                                <p>
                                    A fellow of the ACCA and member of the Mauritius Institute of Professional
                                    Accountants (MIPA), Hans is currently the Finance Manager for one of the leading
                                    global businesses in Seychelles. Hans has more than four years of experience in
                                    global

                                    business as well as extensive audit and assurance knowledge in various sectors.
                                    Serving as
                                    an audit at KPMG and Deloitte for more than 6 years, Hans looks over accounting and
                                    CDD for Sportco.

                                </p>
                                <span class="text-muted"><a
                                            href="https://www.linkedin.com/in/hans-madhoo-fcca-0898b684/"
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
                                <img src="img/team/16.png" class="img-responsive col-md-8 col-xs-12 centered">
                            </div>
                            <div class="box-med text-center">
                                <h3>Selveena Samy</h3>
                                <p class="text-gold mb-1"> Corporate & Admin </p>
                                <p>
                                    Selveena has over 7 years of experience in Corporate Administration, Sales and
                                    Marketing, and Business Development. Graduating with a M.A. in Communication
                                    and Public Relations, and a BSC in Political Science, she is also a team member of
                                    Cryptec, an ICO Service Provider.

                                </p>
                                <span class="text-muted"><a href="https://www.linkedin.com/in/selveena-samy-12453bb8/"
                                                            target="_blank"><i class="fa fa-linkedin"
                                                                               aria-hidden="true"></i></a></span>
                            </div>
                        </div>
                    </div>
                    <!-- box ends -->

                </div>

            </div>

            <div role="tabpanel" class="tab-pane fade" id="buzz"> <!--advisor-->

                <div class="row">
                    <!-- box starts & if needed remove style from col-md-4 div-->
                    <div class="col-md-4" style="float: none; margin: 0 auto;">
                        <div class="team-box">
                            <div class="box-upper">
                                <img src="img/team/1-04.png" class="img-responsive col-md-8 col-xs-12 centered">
                            </div>
                            <div class="box-med text-center">
                                <h3>George Giaglis</h3>
                                <p class="text-gold mb-1">Lead Advisor</p>
                                <p>
                                    Since 2012, George has been involved in the blockchain and cryptocurrencies space,
                                    helping set up the world’s first academic degree on blockchain at the University of
                                    Nicosia. He currently serves there as the Director of the Institute for the Future
                                    and
                                    leads a team of scientists and researchers working on technologies that will shape
                                    the
                                    world of tomorrow and their implications for our societies and economy:
                                    blockchain,artificial intelligence, augmented & virtual reality, autonomous
                                    vehicles,
                                    robotics and the internet of things. George has also been a professor at Athens
                                    University of Business and Economics for 16 years, researching and teaching on
                                    blockchain, fintech and the future of commerce. A published author with more than 10
                                    books and 150 pages, George advises Sportco in many crucial areas in blockchain
                                    implementation.

                                </p>
                                <span class="text-muted"><a
                                            href="https://www.linkedin.com/in/georgegiaglis/"
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
                                <img src="img/team/11.png" class="img-responsive col-md-8 col-xs-12 centered">
                            </div>
                            <div class="box-med text-center">
                                <h3>Theodosis Mourouzis</h3>
                                <p class="text-gold mb-1">Business & Tokenomics Advisor</p>
                                <p>
                                    Theodosis (Theo) is a cryptologist and information security professional, serving as
                                    a
                                    research Fellow at the University College London Centre for Blockchain Technologies
                                    and Programme Director of the MSc in Business Intelligence and Data Analytics at the
                                    Cyprus International Institute of Management (CIIM). Previously involved in advisory
                                    roles to more than 20 I{C,T}Os, Theo has extensive consultancy and advisory
                                    experience in information security, cryptography, blockchain implementation, and
                                    data
                                    analytics. Additionally, he is the recipient of the 1st award in the UK Cyber Cipher
                                    Security Challenge in 2013 and has represented Cyprus four times in Balkan &
                                    International competitions in Mathematics.
                                </p>
                                <span class="text-muted"><a
                                            href="https://www.linkedin.com/in/theodosis-mourouzis-phd-58556a15/"
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
                                <img src="img/team/18.png" class="img-responsive col-md-8 col-xs-12 centered">
                            </div>
                            <div class="box-med text-center">
                                <h3>Dmitry Fedotov</h3>
                                <p class="text-gold mb-1">Advisor of Strategy and Business Development</p>
                                <p>
                                    With over 15 years of experience in Asia-Pacific tech sector, Dmitry is a frequent
                                    speaker on artificial intelligence, blockchain technology, autonomous
                                    transportation,

                                    and digital distribution. Passionate about innovation, Dmitry established first
                                    technology startup as a freshman at the University of Kaiserslautern (Germany).
                                    While
                                    still a student he managed to convince Vodafone and Motorola to grant him equipment
                                    and resources to develop a GSM-based triangulation solution for logistics
                                    optimization.
                                    In 2011 Dmitry established Multichannel Group: first universal digital marketing
                                    platform with integrated dashboard built to optimize ad management, provide
                                    suggestions, and improve spending on marketing campaigns across multiple channels.

                                </p>
                                <!-- <span class="text-muted"><a
                                             href="https://www.linkedin.com/in/faadiyah-nabiiha-hossenally-421b78145/"
                                             target="_blank"><i class="fa fa-linkedin"
                                                                aria-hidden="true"></i></a></span>-->
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
                                <img src="img/team/1-03.png" class="img-responsive col-md-8 col-xs-12 centered">
                            </div>
                            <div class="box-med text-center">
                                <h3>Malika Jivan</h3>
                                <p class="text-gold mb-1">Corporate Advisor</p>
                                <p>Malika is an international tax and accounting professional with over 10 years of
                                    experience in legal and financial due diligence, investment advisory, tax planning
                                    and
                                    company law. Serving as the Director of Abacus Seychelles Limited, she has worked
                                    with one of the big 4 global consulting firms and specializes in structuring for the
                                    Indian ocean regions.</p>
                                <span class="text-muted"><a href="https://www.linkedin.com/in/malika-jivan-1740026/"
                                                            target="_blank"><i class="fa fa-linkedin"
                                                                               aria-hidden="true"></i></a></span>
                            </div>
                        </div>
                    </div>
                    <!-- box ends -->


                    <!-- box starts -->
                    <div class="col-md-4">
                        <div class="team-box">
                            <div class="box-upper">
                                <img src="img/team/1-02.png" class="img-responsive col-md-8 col-xs-12 centered">
                            </div>
                            <div class="box-med text-center">
                                <h3>Juan Carlos Báguena</h3>
                                <p class="text-gold mb-1">Sports & Training Advisor</p>
                                <p>With over 30 years of experience in the Sports World, Juan is a tennis coach and
                                    former
                                    professional tennis player from Spain. He specializes in sports management,
                                    coaching,
                                    and marketing strategy.</p>
                                <span class="text-muted"><a
                                            href="https://www.linkedin.com/in/juan-carlos-b%C3%A1guena-902406b/"
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
                                <img src="img/team/1-06.png" class="img-responsive col-md-8 col-xs-12 centered">
                            </div>
                            <div class="box-med text-center">
                                <h3>Ben Acheson</h3>
                                <p class="text-gold mb-1">Investment Advisor</p>
                                <p>
                                    Ben has 20 years of business experience, with an extensive knowledge in digital
                                    marketing, investment, and technology. Receiving his B.A. in Business Studies,
                                    Business, and Management and IT from The Open University, he currently serves as
                                    the CEO of Skyline Startups, raising investment and delivering growth through SEO
                                    and digital marketing. He also acts as a digital marketing consultant and trainer
                                    for The
                                    Digital Garage, ,providing free training from Google to hundreds of people across
                                    the
                                    UK. Ben’s strong track record of investment in and promotion of successful
                                    businesses
                                    is matched only by his international reputation for helping startups to grow.

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
                                <img src="img/team/13.png" class="img-responsive col-md-8 col-xs-12 centered">
                            </div>
                            <div class="box-med text-center">
                                <h3>Jon Ching</h3>
                                <p class="text-gold mb-1">Asia Market Advisor</p>
                                <p>
                                    Jon serves as the Marketing Advisor for Sportco’s Asian markets, applying his
                                    expertise
                                    in business development, marketing, and strategy. With eight years of experience in
                                    the
                                    financial sector, he was a former General Manager for Tradeslide Trading
                                    Technologies
                                    Limited and lead the team to win the IUIA Start-Up competition in 2015. He then
                                    joined Infinox Capital as Head of PR & Marketing for their South Asia & China
                                    business unit, where he was responsible for devising marketing and portfolio
                                    strategy
                                    across Infinox capital's brands.

                                </p>
                                <span class="text-muted"><a href="https://www.linkedin.com/in/jon7280/"
                                                            target="_blank"><i class="fa fa-linkedin"
                                                                               aria-hidden="true"></i></a></span>
                            </div>
                        </div>
                    </div>
                    <!--  -->


                </div>
            </div>

        </div>


</section>

<section class="navy-bg" id="news">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="text-center text-uppercase section-small-heading">AS SEEN IN</p><br>&nbsp;
            </div>
        </div>
        <div class="row text-center tech_row mb-2">
            <div class="col-md-3">
                <a href="https://www.metro.news/qa-bryan-roy/986812/" target="_blank"><img src="img/logo-metro.png"
                                                                                           class="img-fluid centered partners"></a>
            </div>
            <div class="col-md-3">
                <a href="https://icobench.com/ico/sportco" target="_blank"><img src="img/logo-icobench.png"
                                                                                class="img-fluid centered partners"></a>
            </div>
            <div class="col-md-3">
                <a href="http://coin5s.com/content/bringing-sports-fans-sports-economy" target="_blank"><img
                            src="img/logo-coin5s.png" class="img-fluid centered partners"></a>
            </div>
            <div class="col-md-3">
                <a href="http://blogs.oglobo.globo.com/top-spin/post/ex-tenista-espanhol-baguena-se-une-site-de-esportes.html"
                   target="_blank"><img src="img/logo-globo.png" class="img-fluid centered partners"></a>

            </div>
        </div>
        <div class="row text-center tech_row mb-2">
            <div class="col-md-3">
                <a href="https://www.techbullion.com/connection-cricket-superstar-professor-blockchain-offers-new-era-sports-fans/"
                   target="_blank"><img src="img/logo-techbullion.png" class="img-fluid centered partners"></a>
            </div>
            <div class="col-md-3">
                <a href="https://jaxenter.com/blockchain-interview-george-giaglis-141970.html" target="_blank"><img
                            src="img/logo-jaxenter.png" class="img-fluid centered partners"></a>
            </div>
            <div class="col-md-3">
                <a href="https://www.devicedaily.com/pin/__trashed-80/" target="_blank"><img src="img/devicedaily.png"
                                                                                             class="img-fluid centered partners"></a>
            </div>
            <div class="col-md-3">
                <a href="https://www.mediapost.com/publications/article CHOICEVIEW/314189/blockchain-enters-sports-world-to-spur-engagement.html"
                   target="_blank"><img src="img/logo_mediapost.png" class="img-fluid centered partners"></a>
            </div>
        </div>
        <div class="row text-center tech_row">
            <div class="col-md-3">
                <a href="https://netleaders.news/2018/02/08/blockchain-plays-role-in-community-inspired-sports-project/"
                   target="_blank"><img src="img/logo_netleaders.png" class="img-fluid centered partners"></a>
            </div>
            <div class="col-md-3">
                <a href="http://www.the42.ie/bryan-roy-interview-3931770-Apr2018/" target="_blank"><img
                            src="img/logo-the42.png" class="img-fluid centered partners"></a>
            </div>
            <div class="col-md-3">
                <a href="https://sportuptr.com/spor-sitesi-takipcilerine-kripto-para-dagitacak/" target="_blank"><img
                            src="img/logo_sportup.png" class="img-fluid centered partners"></a>
            </div>
            <div class="col-md-3">
                <a href="http://bunews.com.ua/opinion/item/opinion-will-the-initial-coin-offering-bubble-burst"
                   target="_blank"><img src="img/logo-bunews.png" class="img-fluid centered partners"></a>
            </div>
        </div>
        <div class="row text-center tech_row">
            <div class="col-md-3 offset-md-3">
                <a href="http://lvivtoday.com.ua/lviv-business/5076" target="_blank"><img src="img/logo_lviv.png"
                                                                                          class="img-fluid centered partners"></a>
            </div>
            <div class="col-md-3">
                <a href="<?= siteurl(); ?>news/digital-journal.php" target="_blank"><img src="img/digi-journal-logo.png"
                                                                                         class="img-fluid centered partners"></a>
            </div>
        </div>
    </div>
</section>
<div class="container-fluid interview">
    <a href="http://www.soundcloud.com/sportstechx/sportco"
       class="normal">
        <div class="row">
            <div class="col-md-6 left-interview pr-5 pb-5">
                <h5 class="pt-4 text-right text-white pr-5">Benjamin Penkert from SportsTechX interviews Anuj
                    Sharma</h5>
            </div>
            <div class="right-interview">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="row">
                            <div class="col-md-5">
                                <h6 class="text-white pt-4"><img src="img/inter-play.png" width="30">&nbsp;<span
                                            class="listen">Listen Now</span></h6>
                            </div>
                            <div class="col-md-7">
                                <img src="img/sd.png" class="sound-cloud" width="130">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
<div class="container-fluid interview">
    <a href="https://soundcloud.com/oneradionetwork/010318-block-chain-technology-april-3-2018" class="normal">
        <div class="row">
            <div class="col-md-6 left-interview-v2 pr-5 pb-5">
                <h5 class="pt-4 text-right text-white pr-5">Patrick Timpone interviews Professor Giaglis on
                    Blockchain</h5>
            </div>
            <div class="right-interview-v2">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="row">
                            <div class="col-md-5">
                                <h6 class="text-white pt-4"><img src="img/inter-play.png" width="30">&nbsp;<span
                                            class="listen">Listen Now</span></h6>
                            </div>
                            <div class="col-md-7">
                                <img src="img/sd.png" class="sound-cloud" width="130">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
<div class="container-fluid interview">
    <a href="https://techofsports.blubrry.net/juan-carlos-baguena-former-atp-tour-tennis-player-for-sportco/"
       class="normal">
        <div class="row">
            <div class="col-md-6 left-interview pr-5 pb-5">
                <h5 class="pt-4 text-right text-white pr-5">Rick Limpert interviews Juan Carlos on Sportco</h5>
            </div>
            <div class="right-interview">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="row">
                            <div class="col-md-5">
                                <h6 class="text-white pt-4"><img src="img/inter-play.png" width="30">&nbsp;<span
                                            class="listen">Listen Now</span></h6>
                            </div>
                            <div class="col-md-7">
                                <img src="img/timer.png" class="timer" width="130">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
<div class="container-fluid interview int-border">
    <div class="row">
        <div class="col-md-3 left-mirror pt-5 pb-5">
            <img src="img/logo-mirror.png" width="200" class="img-fluid">
        </div>
        <div class="col-md-9 right-mirror">
            <div class="row">
                <div class="col-md-10 offset-md-2">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="mb-2 pt-4 pb-2 text-white f-18">"Sportco has the same idea to create a
                                community for sports fans and when your fan engagement is so big you get tokens you can
                                buy merchandise and it's a win-win situation. Not only clubs but also media and big
                                sponsors. Nowadays, fans get taken seriously, they have a route into football." - <span
                                        class="text-gold"><em>Bryan Roy</em></span>&nbsp;&nbsp;&nbsp;
                                <a href="https://www.mirror.co.uk/sport/football/news/gareth-southgates-england-talent-momentum-12230239"
                                   target="_blank" class="normal desk-text"><img src="img/art-link.png" width="120"></a>
                            </p>
                            <a href="https://www.mirror.co.uk/sport/football/news/gareth-southgates-england-talent-momentum-12230239"
                               target="_blank" class="normal centered mob-div"><img src="img/art-link.png" width="120"
                                                                                    class="centered"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section id="partners" class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="text-center text-uppercase section-small-heading">OUR PARTNERS</p><br>&nbsp;
            </div>
        </div>
        <div class="row m-b-30">
            <div class="col-md-3">
                <h4 class="service-heading"><a href="http://www.fincapadvisers.com/">FINCAP</a></h4>
                <hr>
                <p class="text-muted">FINCAP is a leading Financial and Leval firm. SportCo has partnered with FINCAP to
                    develop structures Capital Appreciation plan.</p>
            </div>
            <div class="col-md-3">
                <h4 class="service-heading"><a href="http://sportswizzleague.com/">SportsWizz League</a></h4>
                <hr>
                <p class="text-muted">Team of technology, product and sports content developers. Provides sports
                    products and services needed using appropriate technologies to SportCo.</p>
            </div>
            <div class="col-md-3">
                <h4 class="service-heading">TechFinancials</h4>
                <hr>
                <p class="text-muted">TechFinancials is a leading Fintech firm in Europe. SportCo is partnering with
                    TechFinancials to keep evolving and integrating the Token exchange and trade platforms.</p>
            </div>
            <div class="col-md-3">
                <h4 class="service-heading"><a href="https://blockchaintechteam.com/">Blockchain Tech Team</a></h4>
                <hr>
                <p class="text-muted">We work with Blockchain Tech Team to set standards and create platforms to provide
                    the Blockchain and Token technology.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h4 class="service-heading"><a href="https://tokentarget.com/">Token Target</a></h4>
                <hr>
                <p class="text-muted">Token Target is a team of professionals with strong backgrounds in the fintech,
                    finance, investment banking and crypto currencies sectors. Their mission is to help initial coin
                    offerings and token sales brands achieve their desired capital funding and expand their coin and
                    token value.</p>
            </div>
            <div class="col-md-4">
                <h4 class="service-heading"><a href="http://pilanimation.com/">Pil Animation</a></h4>
                <hr>
                <p class="text-muted">Pil Animation was founded in 1998 by award winning animator and director, Sharon
                    Gazit, who acts as the Creative Director and co-CEO. Their animated projects have won multiple
                    awards worldwide and have met the needs of top companies, corporations, ad & production agencies and
                    start-ups in the Israeli and global market.</p>
            </div>

            <div class="col-md-4">
                <h4 class="service-heading"><a href="https://www.nmore.com/about-our-company/">NMORE Group</a></h4>
                <hr>
                <p class="text-muted">NMORE Group is an established technological company based in Cyprus. It sets out
                    to achieve a crucial challenge of bringing all modern digital advances to improve working potential
                    and efficiency of its clients. NMORE provides a variety of IT services and solutions to its partners
                    and clients.</p>
            </div>
        </div>
    </div>
</section>


<!-- 2018-05-08: hide the sections: CLOUD DATA & BACKEND DEVELOPMENTS -->

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="text-uppercase text-center section-small-heading">sports ambassadors</p><br>&nbsp;
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
                                    <p><i><span class="quote left">"</span>This is a new era for sports fans. People
                                            watch sports not when it's on but when they have time, and through platforms
                                            like Sportco they can share their views and read background information from
                                            sports lovers all around the world.<span class="quote right">"</span></i>
                                    </p>
                                </blockquote>
                                <p>Tim de Leede is a former Dutch cricketer, who had a long One Day International career
                                    of 11 years for the Dutch national team. A right-handed all-rounder, he played for
                                    the Netherlands at 1996, 2003, and 2007 World Cups. After his retirement in 2007 he
                                    started a coaching career and in 2015 was appointed as the head coach of the France
                                    national cricket team.</p>
                                <p>Tim de Leede is recorded in KNCB (Netherlands Cricket Association) Hall of Fame.</p>
                                <a class="btn btn-warning text-uppercase"
                                   href="<?= siteurl(); ?>testimonial/tim-de-leede.php" target="_blank">read more</a>
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
                                <p class="text-left text-uppercase">tennis player and coach </p>
                                <blockquote>
                                    <p><i><span class="quote left">"</span>Sports is an industry that is motivated by
                                            passion, by both players and fans, and Sportco's platform takes it to the
                                            next step. The project was aided by brilliant technology that reached
                                            maturity, and I was very sympathized with the idea that in essence put the
                                            sports fans in the center. I see the project as great potential and real
                                            news in the field of communications and sports.<span
                                                    class="quote right">"</span></i></p>
                                </blockquote>
                                <p>Juan Carlos BÃ¡guena is a tennis coach and former professional tennis player from
                                    Spain. He has played to a high professional level, acquiring ATP rankings of 190 in
                                    singles and 100 in doubles. He has won several ATP tour events in doubles and a
                                    singles ATP tour event in Madrid.</p>
                            </div>
                            <div class="col-md-5 desk-div">
                                <img src="img/amb/juan.jpg" class="img-fluid centered bximg">
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="row">
                            <div class="col-md-5 mob-div mb-4">
                                <img src="img/amb/bryan.jpg" class="img-fluid centered bximg">
                            </div>
                            <div class="col-md-7">
                                <h3 class="text-left text-uppercase">BRYAN ROY</h3>
                                <p class="text-left text-uppercase">FOOTBALL PLAYER & COACH</p>
                                <blockquote>
                                    <p><i><span class="quote left">"</span>One of the greatest principles of my
                                            master, Johan Cruyff, is that soccer is all about entertaining the fans.
                                            We have identified a great need for sports fans to express themselves on a
                                            dedicated platform that takes them seriously
                                            and ensures they're widely read.<span class="quote right">"</span></i></p>
                                </blockquote>
                                <p>Bryan Roy, who picked up 32 international caps for the Netherlands national football
                                    team and played in
                                    numerous championship games, also believes in the vision of Sportco and will help
                                    Sportco spread its vision.</p>
                            </div>
                            <div class="col-md-5 desk-div">
                                <img src="img/amb/bryan.jpg" class="img-fluid centered bximg">
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
                <p class="text-uppercase text-center">OUR PLATFORMS</p>
            </div>
            <div class="col-md-12">
                <h2 class="service-heading text-center">SPORTCO Applications &amp; Games on which Sports Fans can engage
                    and form communities.</h2><br>&nbsp;
            </div>
            <div class="col-md-12">
                <div class="row">
                    <!-- game box -->
                    <div class="col-md-6 game_box">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="img/platform/pt1.png" class="img-fluid centered">
                            </div>
                            <div class="col-md-10">
                                <h4>SPORTCO QUIZ & TRIVIA</h4>
                                <p>Become the Champion of your Club, your Country and of the World. Play sports quiz and
                                    games, display your knowledge and become a winner; and win titles. Contribute to
                                    quizzes and win prizes.</p>
                            </div>
                        </div>
                    </div>
                    <!-- game box ends -->
                    <!-- game box -->
                    <div class="col-md-6 game_box">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="img/platform/pt2.png" class="img-fluid centered">
                            </div>
                            <div class="col-md-10">
                                <h4>SPORTCO SWARM COMMUNITY</h4>
                                <p>Do you want to be the master of guessing games? Make your predictions about sports
                                    matches, teams, players and their lifestyles; and get the group wisdom of Sports
                                    fans through Swarm Technologies.</p>
                            </div>
                        </div>
                    </div>
                    <!-- game box ends -->
                </div>

                <div class="row">
                    <!-- game box -->
                    <div class="col-md-6 game_box">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="img/platform/pt3.png" class="img-fluid centered">
                            </div>
                            <div class="col-md-10">
                                <h4>SPORTCO PREDICTOR GAME</h4>
                                <p>Become the Predictor Champion of Sports events on the court and off the court, in
                                    your Sports Fan groups, your country and of the World, and win Titles and Prizes.
                                    Make your own Predictions and upload on our platform.</p>
                            </div>
                        </div>
                    </div>
                    <!-- game box ends -->
                    <!-- game box -->
                    <div class="col-md-6 game_box">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="img/platform/pt4.png" class="img-fluid centered">
                            </div>
                            <div class="col-md-10">
                                <h4>SPORTCO STAT ANALYTICS</h4>
                                <p>Stat Analytics that allow you to follow and share insights and their impacts, not
                                    viewed before.</p>
                            </div>
                        </div>
                    </div>
                    <!-- game box ends -->
                </div>

                <div class="row">
                    <!-- game box -->
                    <div class="col-md-6 game_box">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="img/platform/pt5.png" class="img-fluid centered">
                            </div>
                            <div class="col-md-10">
                                <h4>SPORTCO BLOGS</h4>
                                <p>Blogs that allow you to express your sports passion in words.</p>
                            </div>
                        </div>
                    </div>
                    <!-- game box ends -->
                    <!-- game box -->
                    <div class="col-md-6 game_box">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="img/platform/pt6.png" class="img-fluid centered">
                            </div>
                            <div class="col-md-10">
                                <h4>SPORTS FANTASY</h4>
                                <p>Play virtual fantasy games that are captain and player centric.</p>
                            </div>
                        </div>
                    </div>
                    <!-- game box ends -->
                </div>

                <div class="row">
                    <!-- game box -->
                    <div class="col-md-6 game_box">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="img/platform/pt7.png" class="img-fluid centered">
                            </div>
                            <div class="col-md-10">
                                <h4>SPORTS VIDEOS</h4>
                                <p>Share Sports videos that you have captured with a fan's instinct that the media
                                    cannot capture.</p>
                            </div>
                        </div>
                    </div>
                    <!-- game box ends -->
                </div>
            </div>
        </div>
    </div>
</section>
<?php if(false){ ?>
<section id="fan">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="text-uppercase section-small-heading">FAN COMMUNITY REWARD POOL</p>
                <p class="service-heading col-md-8 offset-md-2">A few examples of how sports fans will get rewarded for
                    their creative and knowledgeable contribution to sports communities on SportCo platform.
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
                <p>All contributions will qualify for publishing and rewards only after approval vioting by user panel
                    of Editors and Moderators.</p>
            </div>
        </div>
    </div>
</section>

<section id="fan" class="navy-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="text-uppercase section-small-heading">BOUNTY REWARDS</p>
                <p class="service-heading col-md-10 offset-md-1">Be early Adopters of SPORTCO business model. Reward
                    yourself by taking message of SPORTCO to your fellow Blockchain and Sports Community members and
                    help them get rewarded too.</p>
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
                                <h5 class="text-center">Write a 400-600 words blog on why your community should
                                    contribute to SportCo ICO & post to your followers on social media.</h5>
                            </div>
                            <div class="bounty-medium">
                                <h4 class="text-center">100 Points</h4>
                            </div>
                            <div class="bounty-bottom">
                                <h4 class="text-center">&nbsp;</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bounty-box bounty-box2">
                            <div class="bounty-upper">
                                <h5 class="text-center">Get 10 of your friends to contribute Content to Sportco Platform
                                </h5>
                            </div>
                            <div class="bounty-medium">
                                <h4 class="text-center">50 Points</h4>
                            </div>
                            <div class="bounty-bottom">
                                <h5 class="text-center">Reward in SPORTCO Coins</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bounty-box bounty-box3">
                            <div class="bounty-upper">
                                <h5 class="text-center">Post a 100-200 words blog on bitcointalk or an equally popular
                                    sports forum on why SPORTCO tokens awarded for contributing content are the best
                                    rewards in sports eco-system</h5>
                            </div>
                            <div class="bounty-medium">
                                <h4 class="text-center">100 Points</h4>
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

                <p>All contributions will be reviewed and approved by our panel of Editors and Moderators.</p>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<section class="bg-light" id="ourtoken">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="text-center text-uppercase section-small-heading">token Details</p><br>&nbsp;
            </div>
        </div>
        <div class="row text-center tech_row">

            <table class="table table-borderless" style="max-width: 800px;margin:auto">
                <tr>
                    <th>Name</th>
                    <td class="text-left">Sportco Token</td>
                </tr>
                <tr>
                    <th>Symbol</th>
                    <td class="text-left">SPRT</td>
                </tr>
                <tr>
                    <th>Precision</th>
                    <td class="text-left">18</td>
                </tr>
                <tr>
                    <th>Token address</th>
                    <td class="text-left">0x52f8a931863cc8bfd2b7c00d1ff488e7d3e9825d</td>
                </tr>
            </table>
        </div>
    </div>
</section>
<div style="background:#003142">
<img src="img/RewardsGraph-2.png" class="img-fluid">
</div>

<section id="contactSection">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <p class="text-uppercase text-center section-small-heading">CONTACT FORM</p>
                <p class="service-heading text-center col-md-10 offset-md-1">Get in touch</p>
                <div id="back_result"></div>
                <br><br>
                <form class="contact-form">
                    <div class="row form-group">
                        <div class="col-md-6">
                            <input type="text" name="vname" class="form-control" placeholder="Name">
                        </div>
                        <div class="col-md-6">
                            <input type="email" name="vemail" class="form-control" placeholder="E-mail">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <input type="text" name="vsubject" class="form-control" placeholder="Subject">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <textarea name="vmessage" class="form-control" placeholder="Message" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-3">
                            <button class="btn btn-primary text-uppercase btnSubmit" type="button">send message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- The Modal -->
<div class="modal fade" id="teamModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal body -->
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

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            speed: 1000,
            pause: 5500,
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
                            '  <button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
                            '  <strong>Thanks!</strong> We have received your request.\n' +
                            '</div>'
                        $('#back_result').html(success);
                        $('.contact-form').find('input,textarea').val('');
                    }
                    else {
                        var error = '<div class="alert alert-info alert-dismissable">\n' +
                            '  <button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
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

        function getTimeRemaining(endtime) {
            var t = Date.parse(endtime) - Date.parse(new Date());
            var seconds = Math.floor((t / 1000) % 60);
            var minutes = Math.floor((t / 1000 / 60) % 60);
            var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
            var days = Math.floor(t / (1000 * 60 * 60 * 24));
            return {
                'total': t,
                'days': days,
                'hours': hours,
                'minutes': minutes,
                'seconds': seconds
            };
        }

        function initializeClock(endtime) {
            var timeinterval = setInterval(function () {
                var t = getTimeRemaining(endtime);
                var days = 0, hours = 0, minutes = 0, seconds = 0;
                days = t.days;
                if (t.days < 10) {
                    days = "0" + days;
                }
                hours = t.hours;
                if (t.hours < 10) {
                    hours = "0" + hours;
                }
                minutes = t.minutes;
                if (t.minutes < 10) {
                    minutes = "0" + minutes;
                }
                seconds = t.seconds;
                if (t.seconds < 10) {
                    seconds = "0" + seconds;
                }
                $('.count_day').html(days);
                $('.count_hour').html(hours);
                $('.count_min').html(minutes);
                $('.count_sec').html(seconds);

                if (t.total <= 0) {
                    clearInterval(timeinterval);
                    $('.count_day').html('00');
                    $('.count_hour').html('00');
                    $('.count_min').html('00');
                    $('.count_sec').html('00');
                }
            }, 1000);
        }

        initializeClock(deadline);
        $('input[name="vname"]').bind('keyup blur', function () {
            var node = $(this);
            node.val(node.val().replace(/[^A-Za-z_\s]/, ''));
        });
        $('input[name="vemail"]').bind('blur', function () {
            var thisis = $(this);
            var node = thisis.val();
            var regex = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            if (regex.test(node) == false) {
                thisis.parent().find('.alert').remove();
                thisis.parent().append('<div class="alert alert-light my-alert mt-2" role="alert"><div class="down-arrow"></div>\n' +
                    'Please enter a valid email address.' +
                    '</div>');
                thisis.focus();
            }
            else {
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
                            '  <button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
                            '  <strong>Thanks!</strong> You have been subscribed.\n' +
                            '</div>'
                        $('#sub_result').html(success);
                        $('.subscribe-form').find('input').val('');
                    }
                    else {
                        var error = '<div class="alert alert-info alert-dismissable">\n' +
                            '  <button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
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
            'Fishery Officer/Scientist at FAO, over 15 years of experience; is capable of coordinating and managing open water fisheries stock assessment and ecological issues.'
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
    });
    //ready function
    var tag = document.createElement('script');

    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    var player;

    function onYouTubeIframeAPIReady() {
        player = new YT.Player('video_section', {
            height: '100%',
            width: '100%',
            videoId: 'qOJWHao1aOU',
            playerVars: {rel: 0, showinfo: 0, ecver: 2},
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
