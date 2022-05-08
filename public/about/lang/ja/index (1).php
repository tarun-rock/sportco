<?php
if(!empty($_POST) && $_POST['ajax'] == 1)
{
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $msg = trim($_POST['msg']);

    if(($name != null) && ($email != null) && ($subject != null) && ($msg != null))
    {

        $message = "こんにちは、\n\n さん";

        $message.= "You have a new contact request on sportco.io : \n\n";

        $message.= "Name : ".$name." \n\n";

        $message.= "Email : ".$email." \n\n";

        $message.= "Subject : ".$subject." \n\n";

        $message.= "Message : ".$msg." \n\n";

        $message.= "Thanks \n\n";

        $senderMail = "info@sportco.io";

        $headers = "差出人: no-reply@sportco.io" . "\r\n";

        //$senderMail = "business@sportswizz.com";

        $subject = "SportCoでのコンタクトリクエスト";

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
        $our_message = "こんにちは、\n\n さん";

        $our_message.= "You have a new subscriber on sportco.io : \n\n";

        $our_message.= "Email : ".$sub_email." \n\n";

        $our_message.= "Thanks \n\n";

        $senderMail = "info@sportco.io";

        $headers = "差出人: no-reply@sportco.io" . "\r\n";

        //$senderMail = "business@sportswizz.com";

        $subject = "SportCoの新規購読者";

        mail($senderMail,$subject, $our_message, $headers);

        //subscriber email

        $sub_msg = "こんにちは、\n\n さん";

        $sub_msg.= "Thank you for subscribing to the sportco newsletter \n\n";

        $sub_msg.= "Best Wishes \n\n";

        $sub_msg.= "SPORTCO \n\n";

        $headers = "差出人: no-reply@sportco.io" . "\r\n";

        //$senderMail = "business@sportswizz.com";

        $subject = "ニュースレター購読";

        mail($sub_email,$subject, $sub_msg, $headers);

        echo 1; exit;

    }
    else
    {
        echo 0; exit;
    }

}
?>
<?php include('header.php');?>
    <!-- Header -->
    <header class="masthead">
        <div class="col-md-12">
          <div class="row">
<!--              <div class="intro-heading text-uppercase centered">JOIN A 500k strong sport community</div>-->
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
                              <h1 class="text-uppercase centered section-carousel-heading">JOIN A 500k strong sport community</h1>
                          </div>
                      </div>
                      <div class="carousel-item">
                          <img src="img/header_02.jpg" class="img-fluid">
                          <div class="carousel-caption">
                              <h1 class="text-uppercase centered section-carousel-heading">REWARDING SPORTS PASSION</h1>
                          </div>
                      </div>
                      <div class="carousel-item">
                          <img src="img/header_03.jpg" class="img-fluid">
                          <div class="carousel-caption">
                              <h1 class="text-uppercase centered section-carousel-heading">Stay connected with Sport fans all over the world</h1>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
    </header>

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
            <img src="img/utility.png" class="img-fluid">
            <h4 class="service-heading text-capitalize">utility token</h4>
            <p class="text-muted">A Token that can be used to buy Sports Merchandise, Memorabilia & Tickets at special prices on our online marketplace.</p>
          </div>
           <div class="col-md-4">
               <img src="img/sportsglobal.png" class="img-fluid">
               <h4 class="service-heading text-capitalize">value token</h4>
               <p class="text-muted">A value Token that can be used to become a member of the SPORTCO Global Club.</p>
           </div>
           <div class="col-md-4">
               <img src="img/bumper_winner.png" class="img-fluid">
               <h4 class="service-heading text-capitalize">enter sports tournaments</h4>
               <p class="text-muted">You can use the Token to get entry into our SPORTS Skill Tournaments and get a chance to win Bumper Rewards</p>
           </div>
        </div>
        <div class="row text-center tech_row">
          <div class="col-md-4">
            <img src="img/payouts.png" class="img-fluid">
            <h4 class="service-heading text-capitalize">regular payouts</h4>
            <p class="text-muted">Receive Regular Payouts to your SPORTCO Wallet on contribution of content or reaching a performance milestone.</p>
          </div>
          <div class="col-md-4">
              <img src="img/sportsgroup.png" class="img-fluid">
              <h4 class="service-heading text-capitalize">SPORTCO shop</h4>
              <p class="text-muted">Use Tokens to trade with affiliated sports groups and exchanges.</p>
          </div>
          <div class="col-md-4">
              <img src="img/peer-to-peer.png" class="img-fluid">
              <h4 class="service-heading text-capitalize">peer to peer</h4>
              <p class="text-muted">You can exchange the Token with other Sports fans on our sports platforms for competing or challenging in any of our Sports Games.</p>
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
                            <div class="padding-top-60 padding-left-60">
                                <img src="img/logo4x.png" class="img-fluid col-md-9 centered">
                                <div class="row clear padding-top-60"></div>
                                <a class="btn btn-xl text-uppercase btn-wp" href="assets/whitepaper.pdf" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;WHITEPAPER&nbsp;&nbsp;&nbsp;&nbsp;</a><br>&nbsp;<br>
                                <a class="btn btn-warning btn-xl text-uppercase" href="http://eepurl.com/dhQLwD" target="_blank">RESERVE NOW</a>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 light_div">
                            <div style="clear: both;content: ' ';display: table"></div>
                            <div class="yellow_box">
                                <h5>AVAILABLE TOKENS FOR COMMUNITY-FUNDING</h5>
                                <span class="large_no">250,000,000</span>
                            </div>
                            <hr>
                            <div class="">
                                <h5>PRE-ICO PRICE</h5>
                                <div style="clear: both;content: ' ';display: table"></div>

                                <p class="trade_rate">1 ETH = 8,000 SPORTCO Tokens</p>
                                <div style="clear: both;content: ' ';display: table"></div>
                                <p>Join Us Via Crypto Currency</p>
                                <div style="clear: both;content: ' ';display: table"></div>
                            </div>
                            <hr>
                            <div class="">
                                <h5>ICO PRICE</h5>
                                <p class="trade_rate">1 ETH = 5,000 SPORTCO Tokens</p>
                                <p>Participate Via ETH</p>
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
                                    <p class="current-coin" data-current="15000000"><strong>1,50,000</strong> USD</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-right total-coin" data-total="20000000"><strong>2,00,00,000</strong> USD</p>
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
              <p class="text-center text-uppercase section-small-heading">CROWDFUNDING PARAMETERS &amp; TOKEN ALLOCATION</p><br>&nbsp;
          </div>
        </div>
        <div class="row text-center m-b-50">
          <div class="col-md-4">
            <h4 class="service-heading">PRE-ICO</h4>
            <p class="text-muted">Tokens which are unsold in pre-ICO will be added to ICO.</p>
          </div>
          <div class="col-md-4">
            <h4 class="service-heading">ICO</h4>
            <p class="text-muted">At the end of ICO, unused tokens will be put into the Contigency Rewards Pool.</p>
          </div>
          <div class="col-md-4">
            <h4 class="service-heading">SPORTCO</h4>
            <span><strong>Supply: </strong>500,000,000</span><br>
            <span><strong>Decimal: </strong>5</span><br>
            <span><strong>Symbol: </strong>SPRT</span><br>
            <span><strong>Blockchain: </strong>Ethereum</span>
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
                <p class="text-center text-uppercase section-small-heading">MILESTONES &amp; PROGRESS</p><br>&nbsp;
            </div>
        </div>
        <div class="row">
            <div class="cx-skill">
              <div class="cx-skill-inner">
                  <!-- Start single skill -->
                  <div class="cx-single-skill">
                      <p>SPORTS PRODUCT TECHNOLOGY DEVELOPMENT&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span class="progress-bold">4M</span></strong></p>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="progress">
                              <div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay=".5s" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%; visibility: visible; animation-duration: 0.8s; animation-delay: 0.5s; animation-name: fadeInLeft;">
                              </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  <!-- End single skill -->
                  <!-- Start single skill -->
                  <div class="cx-single-skill">
                      <p>ACCELERATED FAN COMMUNITIES ACQUISITION&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span class="progress-bold">5M</span></strong></p>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="progress">
                              <div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay=".5s" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%; visibility: visible; animation-duration: 0.8s; animation-delay: 0.5s; animation-name: fadeInLeft;">
                              </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  <!-- End single skill -->
                  <!-- Start single skill -->
                  <div class="cx-single-skill">
                      <p>SPORTCO ONLINE MARKET PLACE CREATION&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span class="progress-bold">3M</span></strong></p>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="progress">
                              <div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay=".6s" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%; visibility: visible; animation-duration: 0.8s; animation-delay: 0.6s; animation-name: fadeInLeft;">
                              </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  <!-- End single skill -->
                  <!-- Start single skill -->
                  <div class="cx-single-skill">
                      <p>DISCOVER THE CHAMPS ROLLOUT&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span class="progress-bold">1M</span></strong></p>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="progress">
                              <div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay=".7s" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%; visibility: visible; animation-duration: 0.8s; animation-delay: 0.7s; animation-name: fadeInLeft;">
                              </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  <!-- End single skill -->
                  <!-- Start single skill -->
                  <div class="cx-single-skill">
                      <p>EXPANSION OF GLOBAL SPORTS &amp; ADDITION OF REGIONAL SPORTS&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span class="progress-bold">3M</span></strong></p>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="progress">
                              <div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay=".7s" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%; visibility: visible; animation-duration: 0.8s; animation-delay: 0.7s; animation-name: fadeInLeft;">
                              </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  <!-- End single skill -->
                  <!-- Start single skill -->
                  <div class="cx-single-skill">
                      <p>SPORTS STUDIO CREATION WHICH FANS CAN ACESS TO AN AUGMENTED REALITY &amp; SWARM&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span class="progress-bold">2M</span></strong></p>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="progress">
                              <div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay=".7s" role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="width: 67%; visibility: visible; animation-duration: 0.8s; animation-delay: 0.7s; animation-name: fadeInLeft;">
                              </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  <!-- End single skill -->
                  <!-- Start single skill -->
                  <div class="cx-single-skill">
                      <p>AI, DRIVEN STATS &amp; PREDICTOR FOR SPORTS&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span class="progress-bold">4M</span></strong></p>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="progress">
                              <div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay=".7s" role="progressbar" aria-valuenow="84" aria-valuemin="0" aria-valuemax="100" style="width: 84%; visibility: visible; animation-duration: 0.8s; animation-delay: 0.7s; animation-name: fadeInLeft;">
                              </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  <!-- End single skill -->
                  <!-- Start single skill -->
                  <div class="cx-single-skill">
                      <p>BLOCKCHAIN DRIVEN COMMUNITY REWARD PROGRAM &amp; MEMORABILIA MANAGEMENT&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span class="progress-bold">3M</span></strong></p>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="progress">
                              <div class="progress-bar wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay=".7s" role="progressbar" aria-valuenow="71" aria-valuemin="0" aria-valuemax="100" style="width: 71%; visibility: visible; animation-duration: 0.8s; animation-delay: 0.7s; animation-name: fadeInLeft;">
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
                          <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger centered" href="timeline.php" target="_blank">VIEW DETAILS</a>
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
            <div class="container">

                <div id="teamCarousel" class="carousel slide desk-div" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#teamCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#teamCarousel" data-slide-to="1"></li>
                        <li data-target="#teamCarousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <!-- item starts -->
                        <div class="carousel-item active">
                            <div class="col-md-12">
                                <div class="row">
                                    <!-- box starts -->
                                    <div class="col-md-4">
                                        <div class="team-box" data-toggle="modal" data-target="#teamModal" data-order="0">
                                            <div class="box-upper">
                                                <img src="img/team/01.png" class="img-responsive col-md-8 col-xs-12 centered">
                                            </div>
                                            <div class="box-med">
                                                <h3>Anuj Sharma</h3>
                                                <p class="text-uppercase">Founder and Business Leader</p>
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
                                    <!-- box ends -->
                                    <!-- box starts -->
                                    <div class="col-md-4">
                                        <div class="team-box" data-toggle="modal" data-target="#teamModal" data-order="1">
                                            <div class="box-upper">
                                                <img src="img/team/03.png" class="img-responsive col-md-8 col-xs-12 centered">
                                            </div>
                                            <div class="box-med">
                                                <h3>Prof George Giaglis</h3>
                                                <p class="text-uppercase">Lead Advisor</p>
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
                                    <!-- box ends -->
                                    <!-- box starts -->
                                    <div class="col-md-4">
                                        <div class="team-box" data-toggle="modal" data-target="#teamModal" data-order="2">
                                            <div class="box-upper">
                                                <img src="img/team/08.png" class="img-responsive col-md-8 col-xs-12 centered">
                                            </div>
                                            <div class="box-med">
                                                <h3>Phiroze Mogrelia</h3>
                                                <p class="text-uppercase">senior advisor</p>
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
                                    <!-- box ends -->
                                </div>
                            </div>
                        </div>
                        <!-- item ends -->
                        <!-- item starts -->
                        <div class="carousel-item">
                            <div class="col-md-12">
                                <div class="row">
                                    <!-- box starts -->
                                    <div class="col-md-4">
                                        <div class="team-box" data-toggle="modal" data-target="#teamModal" data-order="3">
                                            <div class="box-upper">
                                                <img src="img/team/04.png" class="img-responsive col-md-8 col-xs-12 centered">
                                            </div>
                                            <div class="box-med">
                                                <h3>Malika Jivan</h3>
                                                <p class="text-uppercase">Corporate Advisor</p>
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
                                    <!-- box ends -->
                                    <!-- box starts -->
                                    <div class="col-md-4">
                                        <div class="team-box" data-toggle="modal" data-target="#teamModal" data-order="4">
                                            <div class="box-upper">
                                                <img src="img/team/05.png" class="img-responsive col-md-8 col-xs-12 centered">
                                            </div>
                                            <div class="box-med">
                                                <h3>Juan Carlos Báguena</h3>
                                                <p class="text-uppercase">SPORTS ADVISOR</p>
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
                                    <!-- box ends -->
                                    <!-- box starts -->
                                    <div class="col-md-4">
                                        <div class="team-box" data-toggle="modal" data-target="#teamModal" data-order="5">
                                            <div class="box-upper">
                                                <img src="img/team/07.png" class="img-responsive col-md-8 col-xs-12 centered">
                                            </div>
                                            <div class="box-med">
                                                <h3>Dr. Rishi Sharma</h3>
                                                <p class="text-uppercase">Statistics and AI Advisor</p>
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
                                    <!-- box ends -->
                                </div>
                            </div>
                        </div>
                        <!-- item ends -->
                        <!-- item starts -->
                        <div class="carousel-item">
                            <div class="col-md-12">
                                <div class="row">
                                    <!-- box starts -->
                                    <div class="col-md-4 offset-md-4">
                                        <div class="team-box" data-toggle="modal" data-target="#teamModal" data-order="6">
                                            <div class="box-upper">
                                                <img src="img/team/06.png" class="img-responsive col-md-8 col-xs-12 centered">
                                            </div>
                                            <div class="box-med">
                                                <h3>Mr. Kuldip Lal</h3>
                                                <p class="text-uppercase">Media Advisor</p>
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
                                    <!-- box ends -->
                                </div>
                            </div>
                        </div>
                        <!-- item ends -->
                    </div>

                </div>

                <div id="teamMobCarousel" class="carousel slide mob-div col-sm-9 centered" data-ride="carousel">

                    <div class="carousel-inner" role="listbox">
                        <!-- item starts -->
                        <div class="carousel-item active">
                            <!-- box starts -->
                            <div class="team-box" data-toggle="modal" data-target="#teamModal" data-order="0">
                                <div class="box-upper">
                                    <img src="img/team/01.png" class="img-responsive col-md-8 centered">
                                </div>
                                <div class="box-med">
                                    <h3>Anuj Sharma</h3>
                                    <p class="text-uppercase">Founder and Business Leader</p>
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
                            <!-- box ends -->
                        </div>
                        <div class="carousel-item">
                            <!-- box starts -->
                            <div class="team-box" data-toggle="modal" data-target="#teamModal" data-order="1">
                                <div class="box-upper">
                                    <img src="img/team/03.png" class="img-responsive col-md-8 centered">
                                </div>
                                <div class="box-med">
                                    <h3>Prof George Giaglis</h3>
                                    <p class="text-uppercase">Lead Advisor</p>
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
                            <!-- box ends -->
                        </div>
                        <div class="carousel-item">
                            <!-- box starts -->
                            <div class="team-box" data-toggle="modal" data-target="#teamModal" data-order="2">
                                <div class="box-upper">
                                    <img src="img/team/08.png" class="img-responsive col-md-8 centered">
                                </div>
                                <div class="box-med">
                                    <h3>Phiroze Mogrelia</h3>
                                    <p class="text-uppercase">senior advisor</p>
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
                            <!-- box ends -->
                        </div>
                        <div class="carousel-item">
                            <!-- box starts -->
                            <div class="team-box" data-toggle="modal" data-target="#teamModal" data-order="3">
                                <div class="box-upper">
                                    <img src="img/team/04.png" class="img-responsive col-md-8 centered">
                                </div>
                                <div class="box-med">
                                    <h3>Malika Jivan</h3>
                                    <p class="text-uppercase">Corporate Advisor</p>
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
                            <!-- box ends -->
                        </div>
                        <div class="carousel-item">
                            <!-- box starts -->
                            <div class="team-box" data-toggle="modal" data-target="#teamModal" data-order="4">
                                <div class="box-upper">
                                    <img src="img/team/05.png" class="img-responsive col-md-8 centered">
                                </div>
                                <div class="box-med">
                                    <h3>Juan Carlos Báguena</h3>
                                    <p class="text-uppercase">SPORTS ADVISOR</p>
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
                            <!-- box ends -->
                        </div>
                        <div class="carousel-item">
                            <!-- box starts -->
                            <div class="team-box" data-toggle="modal" data-target="#teamModal" data-order="5">
                                <div class="box-upper">
                                    <img src="img/team/07.png" class="img-responsive col-md-8 centered">
                                </div>
                                <div class="box-med">
                                    <h3>Dr. Rishi Sharma</h3>
                                    <p class="text-uppercase">Statistics and AI Advisor</p>
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
                            <!-- box ends -->
                        </div>
                        <div class="carousel-item">
                            <!-- box starts -->
                            <div class="team-box" data-toggle="modal" data-target="#teamModal" data-order="6">
                                <div class="box-upper">
                                    <img src="img/team/06.png" class="img-responsive col-md-8 centered">
                                </div>
                                <div class="box-med">
                                    <h3>Mr Kuldip Lal</h3>
                                    <p class="text-uppercase">Media Advisor</p>
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
                            <!-- box ends -->
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
                    <p class="text-center text-uppercase section-small-heading">AS SEEN IN</p><br>&nbsp;
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
              <p class="text-center text-uppercase section-small-heading">OUR PARTNERS</p><br>&nbsp;
          </div>
        </div>
        <div class="row m-b-30">
          <div class="col-md-3">
              <h4 class="service-heading"><a href="http://www.fincapadvisers.com/">FInCap</a></h4>
            <hr>
            <p class="text-muted">FInCap is a leading Financial and Leval firm. SportCo has partnered with FInCap to develop structures Capital Appreciation plan.</p>
          </div>
          <div class="col-md-3">
              <h4 class="service-heading"><a href="http://sportswizzleague.com/">SportsWizz League</a></h4>
            <hr>
            <p class="text-muted">Team of technology, product and sports content developers, provides sports products and services needed using appropriate technologies to SportCo.</p>
          </div>
          <div class="col-md-3">
            <h4 class="service-heading">TechFinancials</h4>
            <hr>
            <p class="text-muted">TechFinancials is a leading Fintech firm in Europe. SportCo is partnering with TechFinancials to keep evolving and integrating the Token exchange and trade platforms.</p>
          </div>
          <div class="col-md-3">
              <h4 class="service-heading"><a href="https://blockchaintechteam.com/">Blockchain Tech Team</a></h4>
            <hr>
            <p class="text-muted">We work with Blockchain Tech Team to set standards and create platforms to provide the Blockchain and Token technology.</p>
          </div>
        </div>
          <div class="row">
              <div class="col-md-4 offset-md-2">
                  <h4 class="service-heading"><a href="https://tokentarget.com/">Token Target</a></h4>
                  <hr>
                  <p class="text-muted">Token Target is a team of professionals with strong backgrounds in the fintech, finance, investment banking and crypto currencies sectors. Their mission is to help initial coin offerings and token sales brands achieve their desired capital funding and expand their coin and token value.</p>
              </div>
              <div class="col-md-4">
                  <h4 class="service-heading"><a href="http://pilanimation.com/">Pil Animation</a></h4>
                  <hr>
                  <p class="text-muted">Pil Animation was founded in 1998 by award winning animator and director, Sharon Gazit, who acts as the Creative Director and co-CEO. Their animated projects have won multiple awards worldwide and have met the needs of top companies, corporations, ad & production agencies and start-ups in the Israeli and global market.</p>
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
                    <p class="text-muted">SPORTCO will use Ethereum mainnet to create Reward Loyalty Program and peer to peer content and game exchanges. It will potentially handle several million sports community fans engaged worldwide</p>
                </div>
                <div class="col-md-4">
            <span class="fa-stack fa-4x wow zoomIn">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <img src="img/sportsdata.png" class="img-fluid img-tech">
            </span>
                    <h4 class="service-heading">AI IN SPORTS DATA</h4>
                    <p class="text-muted">SPORTCO will deploy Artificial Intelligence in sports industry as evolving technology to increase data analysis to facilitate in sports training &amp; performance, ticketing, merchandising and statistical analysis.</p>
                </div>
                <div class="col-md-4">
            <span class="fa-stack fa-4x wow zoomIn">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <img src="img/clouddata.png" class="img-fluid img-tech">
            </span>
                    <h4 class="service-heading">CLOUD DATA</h4>
                    <p class="text-muted">SPORTCO uses Cloud based data services to serve a multitude of real-time updates in a scalable and on-demand environment. Realtime data is collected from various data feeds and IoT sensors. The data repository can provide feeds for analysis and data mining.</p>
                </div>
            </div>
            <div class="row text-center tech_row">
                <div class="col-md-4 offset-md-2">
            <span class="fa-stack fa-4x wow zoomIn">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <img src="img/backenddevelopment.png" class="img-fluid img-tech">
            </span>
                    <h4 class="service-heading">BACKEND DEVELOPMENTS</h4>
                    <p class="text-muted">SPORTCO is engaged in developing robust and scalable backend solutions for sports eco-system. Applications use Blockchain distributed-ledger technology integrated to securely serve customers. Cloud based interfaces use modular and micro-services architecture for optimum low latency updates.</p>
                </div>
                <div class="col-md-4">
            <span class="fa-stack fa-4x wow zoomIn">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <img src="img/web_apps.png" class="img-fluid img-tech">
            </span>
                    <h4 class="service-heading">WEB &amp; APP LAYERS</h4>
                    <p class="text-muted">SPORTCO uses latest technologies to develop for various Web, Android, and iOS interfaces for mobile games, predictors, live scores and social platform. UI/UX designers are seasoned to provide best user experience and engagement.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="why"  class="bg-light text-center">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
              <p class="text-center text-uppercase section-small-heading">WHY US</p>
              <p class="service-heading">We have the skills, expertise, platforms and passion<br> to drive SPORTCO to create a new sport digital eco-system.<br>&nbsp;
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
                <p>Experienced Team</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="row">
              <div class="col-md-12">
                <img src="img/producers.png" class="img-fluid centered m-b-20">
              </div>
              <div class="col-md-12">
                <p>Existing Sports Producers &amp; Services Platforms</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="row">
              <div class="col-md-12">
                <img src="img/trade.png" class="img-fluid centered m-b-20">
              </div>
              <div class="col-md-12">
                <p>Trade Token with Utility</p>
              </div>
            </div>
          </div>
           <div class="col-md-3 col-sm-6">
            <div class="row">
              <div class="col-md-12">
                <img src="img/multiple-sports.png" class="img-fluid centered m-b-20">
              </div>
              <div class="col-md-12">
                <p>Multiple Sports, Geographies & Communities as SPORTCO Global Club</p>
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
                <p>Sports Tournament & Peer-Peer Contests</p>
              </div>
            </div>
          </div>

           <div class="col-md-3 col-sm-6">
            <div class="row">
              <div class="col-md-12">
                <img src="img/blockchain.png" class="img-fluid centered m-b-20">
              </div>
              <div class="col-md-12">
                <p>Use of BlockChain</p>
              </div>
            </div>
          </div>

            <div class="col-md-3 col-sm-6">
            <div class="row">
              <div class="col-md-12">
                <img src="img/communities.png" class="img-fluid centered m-b-20">
              </div>
              <div class="col-md-12">
                <p>Existing Strong Sports Communities</p>
              </div>
            </div>
          </div>

              <div class="col-md-3 col-sm-6">
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
        <div class="row reason_row">

           <div class="col-md-3 col-sm-6">
            <div class="row">
              <div class="col-md-12">
                <img src="img/rewards.png" class="img-fluid centered m-b-20">
              </div>
              <div class="col-md-12">
                <p>Reward Sports Passion</p>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-sm-6">
            <div class="row">
              <div class="col-md-12">
                <img src="img/multiple-sports.png" class="img-fluid centered m-b-20">
              </div>
              <div class="col-md-12">
                <p>Multiple Procedures, Games, Services &amp; Features</p>
              </div>
            </div>
          </div>


          <div class="col-md-3 col-sm-6">
            <div class="row">
              <div class="col-md-12">
                <img src="img/producers.png" class="img-fluid centered m-b-20">
              </div>
              <div class="col-md-12">
                <p>AI, AR &amp; SWARM Technologies</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="row">
              <div class="col-md-12">
                <img src="img/Partners.png" class="img-fluid centered m-b-20">
              </div>
              <div class="col-md-12">
                <p>Real World Brands &amp; Sports Institutions as Partners</p>
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
                                        <p><i><span class="quote left">“</span>This is a new era for sports fans. People watch sports not when it's on but when they have time, and through platforms like Sportco they can share their views and read background information from sports lovers all around the world.<span class="quote right">”</span></i></p>
                                    </blockquote>
                                    <p>Tim de Leede is a former Dutch cricketer, who had a long One Day International career of 11 years for the Dutch national team. A right-handed all-rounder, he played for the Netherlands at 1996, 2003, and 2007 World Cups. After his retirement in 2007 he started a coaching career and in 2015 was appointed as the head coach of the France national cricket team.</p>
                                    <p>Tim de Leede is recorded in KNCB (Netherlands Cricket Association) Hall of Fame.</p>
                                    <a class="btn btn-warning text-uppercase" href="<?= siteurl();?>testimonial/tim-de-leede.php" target="_blank">read more</a>
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
                                        <p><i><span class="quote left">“</span>Sports is an industry that is motivated by passion, by both players and fans, and Sportco's platform takes it to the next step. The project was aided by brilliant technology that reached maturity, and I was very sympathized with the idea that in essence put the sports fans in the center. I see the project as great potential and real news in the field of communications and sports.<span class="quote right">”</span></i></p>
                                    </blockquote>
                                    <p>Juan Carlos Báguena is a tennis coach and former professional tennis player from Spain. He has played to a high professional level, acquiring ATP rankings of 190 in singles and 100 in doubles. He has won several ATP tour events in doubles and a singles ATP tour event in Madrid.</p>
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
            <p class="text-uppercase text-center">OUR PLATFORMS</p>
          </div>
          <div class="col-md-12">
            <h2 class="service-heading text-center">SPORTCO Applications &amp; Games on which Sports Fans can engage and form communities.</h2><br>&nbsp;
          </div>
          <div class="col-md-12">
            <div class="row">
              <!-- game box -->
              <div class="col-md-6 game_box">
                <div class="row">
                  <div class="col-md-2">
                    <svg height="50" width="50">
                      <circle cx="25" cy="25" r="20" fill="#6270FF" />
                    </svg>
                  </div>
                  <div class="col-md-10">
                    <h4>SPORTCO QUIZ & TRIVIA</h4>
                    <p>Become the Champion of your Club, your Country and of the World. Play sports quiz and games, display your knowledge and become a winner; and win titles. Contribute to quizzes and win prizes.</p>
                  </div>
                </div>
              </div>
              <!-- game box ends -->
                <!-- game box -->
                <div class="col-md-6 game_box">
                    <div class="row">
                        <div class="col-md-2">
                            <svg height="50" width="50">
                                <circle cx="25" cy="25" r="20" fill="#6270FF" />
                            </svg>
                        </div>
                        <div class="col-md-10">
                            <h4>SPORTCO SWARM COMMUNITY</h4>
                            <p>Do you want to be the master of guessing games? Make your predictions about sports matches, teams, players and their lifestyles; and get the group wisdom of Sports fans through Swarm Technologies.</p>
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
                    <svg height="50" width="50">
                      <circle cx="25" cy="25" r="20" fill="#6270FF" />
                    </svg>
                  </div>
                  <div class="col-md-10">
                    <h4>SPORTCO PREDICTOR GAME</h4>
                    <p>Become the Predictor Champion of Sports events on the court and off the court, in your Sports Fan groups, your country and of the World, and win Titles and Prizes. Make your own Predictions and upload on our platform.</p>
                  </div>
                </div>
              </div>
              <!-- game box ends -->
                <!-- game box -->
                <div class="col-md-6 game_box">
                    <div class="row">
                        <div class="col-md-2">
                            <svg height="50" width="50">
                                <circle cx="25" cy="25" r="20" fill="#6270FF" />
                            </svg>
                        </div>
                        <div class="col-md-10">
                            <h4>SPORTCO STAT ANALYTICS</h4>
                            <p>Stat Analytics that allow you to follow and share insights and their impacts, not viewed before.</p>
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
                            <svg height="50" width="50">
                                <circle cx="25" cy="25" r="20" fill="#6270FF" />
                            </svg>
                        </div>
                        <div class="col-md-10">
                            <h4>SPORTCO BLOGS</h4>
                            <p>Blogs that allow you to expres yoru sports passion in words.</p>
                        </div>
                    </div>
                </div>
                <!-- game box ends -->
                <!-- game box -->
                <div class="col-md-6 game_box">
                    <div class="row">
                        <div class="col-md-2">
                            <svg height="50" width="50">
                                <circle cx="25" cy="25" r="20" fill="#6270FF" />
                            </svg>
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
                              <svg height="50" width="50">
                                  <circle cx="25" cy="25" r="20" fill="#6270FF" />
                              </svg>
                          </div>
                          <div class="col-md-10">
                              <h4>SPORTS VIDEOS</h4>
                              <p>Share Sports videso that you have captured with a fan's instinct that the media cannot capture.</p>
                          </div>
                      </div>
                  </div>
                  <!-- game box ends -->
              </div>
          </div>
        </div>
      </div>
    </section>

    <section id="fan">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p class="text-uppercase section-small-heading">FAN COMMUNITY REWARD POOL</p>
                    <p class="service-heading col-md-8 offset-md-2">A few examples of how sports fans will get rewarded for their creative and knowledgeable contribution to sports communities on SportCo platform.
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
                    <p>All contributions will qualify for publishing and rewards only after approval vioting by user panel of Editors and Moderators.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="fan"  class="navy-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p class="text-uppercase section-small-heading">BOUNTY REWARDS</p>
                    <p class="service-heading col-md-10 offset-md-1">Be early Adopters of SPORTCO business model. Reward yourself by taking message of SPORTCO to your fellow Blockchain Sports Community members and helping us reward sports fan worldwide.</p>
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
                                    <h5 class="text-center">Write a 400-600 words blog on why your community should contribute to SportCo ICO & post to your followers on social media.</h5>
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
                                    <h5 class="text-center">Get 50 people to retweet our twitter post on SPORTCO ICO dates.</h5>
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
                                    <h5 class="text-center">Post a 100-200 words blog on bitcoin talk on why SPORTCO is the standout ICO of the month.</h5>
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
                  <input type="name" name="vname" class="form-control" placeholder="Name">
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
                      ' <button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
                      ' <strong>ありがとう！</strong>お客様のリクエストを受理しました。\n' +
                      '</div>'
                  $('#back_result').html(success);
                  $('.contact-form').find('input,textarea').val('');
              }
              else{
                  var error = '<div class="alert alert-info alert-dismissable">\n' +
                      ' <button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
                      ' <strong>エラー！</strong>入力内容をご確認ください。\n' +
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
                      ' <button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
                      ' <strong>ありがとう！</strong>購読が完了しました。\n' +
                      '</div>'
                  $('#sub_result').html(success);
                  $('.subscribe-form').find('input').val('');
              }
              else{
                  var error = '<div class="alert alert-info alert-dismissable">\n' +
                      ' <button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
                      ' <strong>エラー！</strong>入力内容をご確認ください。\n' +
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
        'Anuj は、スポーツメディア、金融サービス、テクノロジー業界で25年以上の経験を持つビジネス学部の卒業生です。起業家として、彼はブロックチェーン技術をベースとしたトークンエコノミーを利用し、3つの要素を合わせることでSportcoのエコシステムを作り上げました。',
        '5年間、金融開発部門の副長を務めました。アテネ経済商科大学のEビジネス教授でもあります。プロの研究者およびInformation Systems Journal誌、International Journal of Electronic Commerce誌、International Journal of Information Management誌に寄稿しています。',
        'ABNアムロ銀行にて、融資＆流動資産ソリューション、製品＆ソリューション、海外プライベート・バンキング部門のグローバルリーダーです。彼は様々な国でチームを率い、エンパワーメントが成功の鍵だと考えています。',
        'Abacus Seychelles Limited取締役、バークレイズ銀行独立取締役、国際的な税務と会計の専門家で、法務および財務デューデリジェンス、投資顧問、税務計画、会社法などに10年以上の経験を有しています。 彼女は3年以上の経験を持ち、グローバルコンサルティング大手4社のひとつで働いていました。 ',
        'ナショナルテニスインストラクター（スペインでの最高資格）。彼は元プロテニス選手で、スポーツ界において30年以上の経験があります。 ',
        'FAO（食糧農業機関）の水産業担当/科学者で、15年以上の経験を持ち、オープンウォーターでの水産資源評価、環境問題のコーディネート、管理能力を備えています。',
        'ニューデリーに拠点を置くベテランジャーナリストで、2015年に南アジアのAgence France-Presse （AFP、国際ニュース通信社）のチーフスポーツライターを退職しました。35年の経験を経て、6つのオリンピック大会、7つのアジア大会、8つのクリケットワールドカップを含む大規模なスポーツイベントを報道しました。'
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
