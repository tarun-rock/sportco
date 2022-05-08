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
                     <h1 class="text-uppercase centered section-carousel-heading">50万人の強力なスポーツコミュニティに参加しよう</h1>
                  </div>
               </div>
               <div class="carousel-item">
                  <img src="img/header_02.jpg" class="img-fluid">
                  <div class="carousel-caption">
                     <h1 class="text-uppercase centered section-carousel-heading">スポーツへの情熱に報いる仕組み</h1>
                  </div>
               </div>
               <div class="carousel-item">
                  <img src="img/header_03.jpg" class="img-fluid">
                  <div class="carousel-caption">
                     <h1 class="text-uppercase centered section-carousel-heading">世界中のスポーツファンとつながろう</h1>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
       <!-- <div class="front-bottom col-md-6 col-sm-6 col-xs-10">
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
    <section class="video_holder">
       <div id="video_section"></div>
       <div class="videoCover">
          <img src="img/videobanner.jpg" class="img-fluid video-banner centered">
          <div class="video-btn-holder">
             <img src="img/playBtn.png" class="btn-play centered">
          </div>
       </div>
    </section>
<section class="bg-light" id="ourtoken">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 text-center">
            <p class="text-center text-uppercase section-small-heading">私たちのトークン</p><br>&nbsp;
         </div>
      </div>
      <div class="row text-center tech_row">
         <div class="col-md-4">
            <img src="img/utility.png" class="img-fluid">
            <h4 class="service-heading text-capitalize">ユーティリティートークン</h4>
            <p class="text-muted">このトークンを使って、弊社のオンラインショップからスポーツ関連商品・記念品・チケットを特別価格で購入することができます。 </p>
         </div>
         <div class="col-md-4">
            <img src="img/sportsglobal.png" class="img-fluid">
            <h4 class="service-heading text-capitalize">バリュートークン</h4>
            <p class="text-muted">このバリュートークンを使ってSPORTICOグローバルクラブの会員になることができます。</p>
         </div>
         <div class="col-md-4">
            <img src="img/bumper_winner.png" class="img-fluid">
            <h4 class="service-heading text-capitalize">スポーツ大会にエントリーする</h4>
            <p class="text-muted">トークンを使って弊社主催のスポーツスキルトーナメントにエントリーしてバンパー報酬獲得のチャンスに挑むことができます</p>
         </div>
      </div>
      <div class="row text-center tech_row">
         <div class="col-md-4">
            <img src="img/payouts.png" class="img-fluid">
            <h4 class="service-heading text-capitalize">通常報酬の支払い</h4>
            <p class="text-muted">コンテンツへの寄稿やパフォーマンス目標達成に対する通常報酬の支払いは、お客様のSPORTCOウォレットに支払われます。 </p>
         </div>
         <div class="col-md-4">
            <img src="img/sportsgroup.png" class="img-fluid">
            <h4 class="service-heading text-capitalize">SPORTCOショップ</h4>
            <p class="text-muted">トークンを使って、提携スポーツ団体とのトレードや交換ができます。</p>
         </div>
         <div class="col-md-4">
            <img src="img/peer-to-peer.png" class="img-fluid">
            <h4 class="service-heading text-capitalize">ピアツーピア</h4>
            <p class="text-muted">弊社のスポーツプラットフォーム上では、スポーツゲームで競ったり挑戦したりすることで他のスポーツファンとトークンを交換することができます。</p>
         </div>
      </div>
   </div>
</section>
<section id="distribution" class="navy-bg">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 text-center">
            <p class="text-center text-uppercase section-small-heading">トークンの分配</p>
            <br>&nbsp;
         </div>
      </div>
      <div class="row">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-6 col-sm-6 col-xs-12" style="margin: 0px auto;text-align: center;">
                  <div class="padding-top-60 padding-left-60">
                     <img src="img/logo4x.png" class="img-fluid col-md-9 centered">
                     <div class="row clear padding-top-60"></div>
                     <a class="btn btn-xl text-uppercase btn-wp" href="assets/whitepaper.pdf" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;ホワイトペーパー&nbsp;&nbsp;&nbsp;&nbsp;</a><br>&nbsp;<br>
                     <a class="btn btn-warning btn-xl text-uppercase" href="http://eepurl.com/dhQLwD" target="_blank">今すぐ予約</a>
                  </div>
               </div>
               <div class="col-md-6 col-sm-6 col-xs-12 light_div">
                  <div style="clear: both;content: ' ';display: table"></div>
                  <div class="yellow_box">
                     <h5>コミュニティ基金として利用な可能トークン</h5>
                     <span class="large_no">250,000,000</span>
                  </div>
                  <hr>
                  <div class="">
                     <h5>プレICOの価格</h5>
                     <div style="clear: both;content: ' ';display: table"></div>
                     <p class="trade_rate">1 ETH = 8,000 SPORTCOトークン</p>
                     <div style="clear: both;content: ' ';display: table"></div>
                     <p>暗号通貨で参加しましょう</p>
                     <div style="clear: both;content: ' ';display: table"></div>
                  </div>
                  <hr>
                  <div class="">
                     <h5>ICO価格</h5>
                     <p class="trade_rate">1 ETH = 5,000 SPORTCOトークン</p>
                     <p>ETHで参加</p>
                     <div style="clear: both;content: ' ';display: table"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section id="raised">
    <section id="raised" style="display: none;">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 text-center">
            <p class="text-center text-uppercase section-small-heading">集まった資金</p>
            <br>&nbsp;
         </div>
      </div>
      <div class="row">
         <div class="cx-skill col-md-4 offset-md-4">
            <div class="cx-skill-inner">
               <div class="cx-single-skill">
                  <div class="row">
                     <div class="col-md-6">
                        <p class="current-coin" data-current="15000000"><strong>1,50,000</strong> 米ドル</p>
                     </div>
                     <div class="col-md-6">
                        <p class="text-right total-coin" data-total="20000000"><strong>2,00,00,000</strong> 米ドル</p>
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
         <p class="text-center text-uppercase section-small-heading">クラウドファンディングのパラメータ＆トークン配分</p>
         <br>&nbsp;
      </div>
   </div>
   <div class="row text-center m-b-50">
      <div class="col-md-4">
         <h4 class="service-heading">プレICO</h4>
         <p class="text-muted">プレICOで売れ残ったトークンはICOに追加されます。</p>
      </div>
      <div class="col-md-4">
         <h4 class="service-heading">ICO</h4>
         <p class="text-muted">ICOの終わりで未使用となったトークンは、臨時報酬プールに追加されます。</p>
      </div>
      <div class="col-md-4">
         <h4 class="service-heading">SPORTCO</h4>
         <span><strong>総供給量： </strong>500,000,000</span><br>
         <span><strong>単位桁数（Decimal）： </strong>5</span><br>
         <span><strong>シンボル（Symbol）： </strong>SPRT</span><br>
         <span><strong>ブロックチェーン: </strong>イーサリアム（Ethereum）</span>
      </div>
   </div>
   <div class="row">
      <div class="container-fluid">
         <img src="../../img/token-allocation-trans2.png" class="img-fluid centered">
      </div>
   </div>
</section>
<section>
   <div class="container">
   <div class="row">
      <div class="col-lg-12 text-center">
         <p class="text-center text-uppercase section-small-heading">マイルストーン＆進捗状況</p>
         <br>&nbsp;
      </div>
   </div>
   <div class="row">
      <div class="cx-skill">
         <div class="cx-skill-inner">
            <div class="cx-single-skill">
               <p>スポーツ関連製品技術開発&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span class="progress-bold">4M</span></strong></p>
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
               <p>ファンコミュニティ獲得促進&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span class="progress-bold">5M</span></strong></p>
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
               <p>SPORTCOオンラインショップ制作&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span class="progress-bold">3M</span></strong> </p>
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
               <p>未来のチャンピオン発掘&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span class="progress-bold">1M</span></strong></p>
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
               <p>グローバルスポーツの拡張＆地域スポーツの追加&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span class="progress-bold">3M</span></strong></p>
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
               <p>ファンが拡張現実とスワーム（SWARM）にアクセスできるスポーツスタジオの設立&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span class="progress-bold">2M</span></strong></p>
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
               <p>人工知能（AI）によるスポーツ統計＆予測&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span class="progress-bold">4M</span></strong></p>
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
               <p>ブロックチェーンによるコミュニティ報酬プログラム＆記念品管理&nbsp;&nbsp;|&nbsp;&nbsp;<strong><span class="progress-bold">3M</span></strong></p>
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
            <p class="text-center text-uppercase section-small-heading">タイムライン</p>
            <br>&nbsp;
         </div>
         <div class="col-lg-12">
            <img src="../../img/timeline.png" class="img-fluid">
         </div>
         <div class="col-lg-12">
            <div class="row">
               <div class="col-lg-2 offset-lg-5 m-t-60">
                  <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger centered" href="timeline.php" target="_blank">詳細を表示</a>
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
            <p class="text-uppercase text-center">SPORTCOのチーム</p>
            <p class="service-heading">200年以上もの共同事業における経験とともに、私たちのチームには意欲と経験、そしてアイデアを形にしたり事業を成功に導く力があります。</p>
            <br>&nbsp;
         </div>
      </div>
      <div class="row">

                           <div class="col-md-4">
                              <div class="team-box">
                                 <div class="box-upper">
                                    <img src="img/team/01.png" class="img-responsive col-md-8 col-xs-12 centered">
                                 </div>
                                 <div class="box-med text-center">
                                    <h3>Anuj Sharma</h3>
                                    <p class="text-gold mb-1">創業者およびビジネスリーダー</p>
                                    <br>
                                    <p>&nbsp;</p>
                                 </div>

                                          </div>
                                       </div>

                           <div class="col-md-4">
                              <div class="team-box">
                                 <div class="box-upper">
                                    <img src="img/team/03.png" class="img-responsive col-md-8 col-xs-12 centered">
                                 </div>
                                 <div class="box-med text-center">
                                    <h3>Prof George Giaglis</h3>
                                    <p class="text-gold mb-1">主任アドバイザー</p>
                        <p>Vice Rector of Finance and Development for 5 years; Professor of eBusiness at the Athens University of Economics and Business. A professional researcher and writer on Information Systems Journal, the International Journal of Electronic Commerce, and the International Journal of Information Management.</p>
                        <span class="text-muted"><a href="https://www.linkedin.com/in/georgegiaglis/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></span>
                                 </div>

                                          </div>
                                       </div>

                           <div class="col-md-4">
                              <div class="team-box">
                                 <div class="box-upper">
                                    <img src="img/team/08.png" class="img-responsive col-md-8 col-xs-12 centered">
                                 </div>
                                 <div class="box-med text-center">
                                    <h3>Phiroze Mogrelia</h3>
                                    <p class="text-gold mb-1">シニアアドバイザー</p>
                        <p>Global Head Lending & Liquidity Solutions, Products & Solutions, Private Banking Int\'l at ABN AMRO Bank. He has led teams in several countries and believes empowerment is the key to success.</p>
                        <span class="text-muted"><a href="https://www.linkedin.com/in/phirozemogrelia/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></span>
                                 </div>

                                          </div>
                                       </div>
                                    </div>

                        <div class="row">
                           <div class="col-md-4">
                              <div class="team-box">
                                 <div class="box-upper">
                                    <img src="img/team/04.png" class="img-responsive col-md-8 col-xs-12 centered">
                                 </div>
                                 <div class="box-med text-center">
                                    <h3>Malika Jivan</h3>
                                    <p class="text-gold mb-1">企業アドバイザー</p>
                        <p>Director of Abacus Seychelles Limited, an Independent Director for the Barclays Bank, an international tax and accounting professional and has over 10 years of experience in legal and financial due diligence, investment advisory, tax planning and company law. She has over 3 years of experience and worked with one of the big 4 global consulting firms.</p>
                        <span class="text-muted"><a href="https://www.linkedin.com/in/malika-jivan-1740026/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></span>
                                 </div>

                                          </div>
                                       </div>

                           <div class="col-md-4">
                              <div class="team-box">
                                 <div class="box-upper">
                                    <img src="img/team/05.png" class="img-responsive col-md-8 col-xs-12 centered">
                                 </div>
                                 <div class="box-med text-center">
                                    <h3>Juan Carlos Báguena</h3>
                                    <p class="text-gold mb-1">スポーツアドバイザー</p>
                        <p>National Tennis Instructor (Highest Qualification in Spain). He has over 30 years of experience in the Sports World as he was a professional Tennis player.</p>
                        <span class="text-muted"><a href="https://www.linkedin.com/in/juan-carlos-b%C3%A1guena-902406b/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></span>
                                 </div>

                                          </div>
                                       </div>

                           <div class="col-md-4">
                              <div class="team-box">
                                 <div class="box-upper">
                                    <img src="img/team/07.png" class="img-responsive col-md-8 col-xs-12 centered">
                                 </div>
                                 <div class="box-med text-center">
                                    <h3>Rishi Sharma博士</h3>
                                    <p class="text-gold mb-1">統計およびAIアドバイザー</p>
                        <p>Fishery Officer/Scientist at FAO, over 15 years of experience; is capable of coordinating and managing open water fisheries stock assessment and ecological issues.</p>
                        <span class="text-muted"><a href="https://www.linkedin.com/in/rishi-sharma-5aa6108" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></span>
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

                            <!-- box starts & if needed remove style from col-md-4 div-->
                            <div class="col-md-4" style="float: none; margin: 0 auto;">
                                <div class="team-box">
                                    <div class="box-upper">
                                        <img src="../../img/team/12.png" class="img-responsive col-md-8 col-xs-12 centered">
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
                                        <img src="../../img/team/13.png" class="img-responsive col-md-8 col-xs-12 centered">
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

    <section class="navy-bg" id="news">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p class="text-center text-uppercase section-small-heading">AS SEEN IN</p><br>&nbsp;
                </div>
            </div>
            <div class="row text-center tech_row mb-2">
                <div class="col-md-3">
                    <a href="https://www.metro.news/qa-bryan-roy/986812/" target="_blank"><img src="img/logo-metro.png" class="img-fluid centered partners"></a>
                                          </div>
                <div class="col-md-3">
                    <a href="https://icobench.com/ico/sportco" target="_blank"><img src="img/logo-icobench.png" class="img-fluid centered partners"></a>
                                       </div>
                <div class="col-md-3">
                    <a href="http://coin5s.com/content/bringing-sports-fans-sports-economy" target="_blank"><img src="img/logo-coin5s.png" class="img-fluid centered partners"></a>
                                    </div>
                <div class="col-md-3">
                    <a href="http://blogs.oglobo.globo.com/top-spin/post/ex-tenista-espanhol-baguena-se-une-site-de-esportes.html" target="_blank"><img src="img/logo-globo.png" class="img-fluid centered partners"></a>
                                 </div>
            </div>
            <div class="row text-center tech_row mb-2">
                <div class="col-md-3">
                    <a href="https://www.techbullion.com/connection-cricket-superstar-professor-blockchain-offers-new-era-sports-fans/" target="_blank"><img src="img/logo-techbullion.png" class="img-fluid centered partners"></a>
                </div>
                <div class="col-md-3">
                    <a href="https://jaxenter.com/blockchain-interview-george-giaglis-141970.html" target="_blank"><img src="img/logo-jaxenter.png" class="img-fluid centered partners"></a>
                </div>
                <div class="col-md-3">
                    <a href="https://www.devicedaily.com/pin/__trashed-80/" target="_blank"><img src="img/devicedaily.png" class="img-fluid centered partners"></a>
                </div>
                <div class="col-md-3">
                    <a href="https://www.mediapost.com/publications/article/314189/blockchain-enters-sports-world-to-spur-engagement.html" target="_blank"><img src="img/logo_mediapost.png" class="img-fluid centered partners"></a>
                </div>
            </div>
            <div class="row text-center tech_row">
                <div class="col-md-3">
                    <a href="https://netleaders.news/2018/02/08/blockchain-plays-role-in-community-inspired-sports-project/" target="_blank"><img src="img/logo_netleaders.png" class="img-fluid centered partners"></a>
            </div>
                <div class="col-md-3">
                    <a href="http://www.the42.ie/bryan-roy-interview-3931770-Apr2018/" target="_blank"><img src="img/logo-the42.png" class="img-fluid centered partners"></a>

                        </div>
                <div class="col-md-3">
                    <a href="https://sportuptr.com/spor-sitesi-takipcilerine-kripto-para-dagitacak/" target="_blank"><img src="img/logo_sportup.png" class="img-fluid centered partners"></a>
                </div>
                <div class="col-md-3">
                    <a href="http://bunews.com.ua/opinion/item/opinion-will-the-initial-coin-offering-bubble-burst" target="_blank"><img src="img/logo-bunews.png" class="img-fluid centered partners"></a>
                                       <li><a href="https://www.linkedin.com/in/anujsharma17/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                    </ul>
                                 </div>
                              </div>
            <div class="row text-center tech_row">
                <div class="col-md-3 offset-md-3">
                    <a href="http://lvivtoday.com.ua/lviv-business/5076" target="_blank"><img src="img/logo_lviv.png" class="img-fluid centered partners"></a>
                           </div>
                <div class="col-md-3">
                    <a href="<?= siteurl();?>news/digital-journal.php" target="_blank"><img src="img/digi-journal-logo.png" class="img-fluid centered partners"></a>
                </div>
                     </div>
                  </div>
    </section>
    <div class="container-fluid interview">
        <a href="https://soundcloud.com/oneradionetwork/010318-block-chain-technology-april-3-2018" class="normal">
                              <div class="row">
                                 <div class="col-md-6 left-interview-v2 pr-5 pb-5 ">
                    <h5 class="pt-4 text-right text-white pr-5">Patrick Timpone interviews Professor Giaglis on Blockchain</h5>

                                 </div>
                <div class="right-interview-v2">

                              <div class="row">
                        <div class="col-md-10 offset-md-1">

                            <div class="row">
                                <div class="col-md-5">
                                    <h6 class="text-white pt-4"><img src="img/inter-play.png" width="30">&nbsp;<span class="listen">Listen Now</span></h6>

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
        <a href="https://techofsports.blubrry.net/juan-carlos-baguena-former-atp-tour-tennis-player-for-sportco/" class="normal">
                              <div class="row">
                                 <div class="col-md-6 left-interview pr-5 pb-5"">
                    <h5 class="pt-4 text-right text-white pr-5">Rick Limpert interviews Juan Carlos on Sportco</h5>
                </div>
                <div class="right-interview">

                              <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <div class="row">
                                <div class="col-md-5">
                                    <h6 class="text-white pt-4"><img src="img/inter-play.png" width="30">&nbsp;<span class="listen">Listen Now</span></h6>
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
                                <p class="mb-2 pt-4 pb-2 text-white f-18">“ Sportco has the same idea to create a community for sports fans and when your fan engagement is so big you get tokens you can buy merchandise and it’s a win-win situation.Not only clubs but also media and big sponsors. Nowadays, fans get taken seriously,they have a route into football. ”- <span class="text-gold"><em>Bryan Roy</em></span>&nbsp;&nbsp;&nbsp;
                                    <a href="https://www.mirror.co.uk/sport/football/news/gareth-southgates-england-talent-momentum-12230239" target="_blank" class="normal desk-text"><img src="img/art-link.png" width="120"></a></p>
                                <a href="https://www.mirror.co.uk/sport/football/news/gareth-southgates-england-talent-momentum-12230239" target="_blank" class="normal centered mob-div"><img src="img/art-link.png" width="120" class="centered"></a>
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
            <p class="text-center text-uppercase section-small-heading">パートナー</p>
            <br>&nbsp;
         </div>
      </div>
      <div class="row m-b-30">
         <div class="col-md-3">
            <h4 class="service-heading"><a href="http://www.fincapadvisers.com/">FInCap</a></h4>
            <hr>
            <p class="text-muted">FInCapは、金融および法律のトップ企業です。SportCoは、資本増価計画の骨組みを策定するためにFInCapと提携しました。</p>
         </div>
         <div class="col-md-3">
            <h4 class="service-heading"><a href="http://sportswizzleague.com/">SportsWizz League</a></h4>
            <hr>
            <p class="text-muted">SportCoが必要とするスポーツ関連商品とサービスを適切な技術を使って提供してくれる技術、製品＆スポーツコンテンツ開発のチームです。</p>
         </div>
         <div class="col-md-3">
            <h4 class="service-heading">TechFinancials</h4>
            <hr>
            <p class="text-muted">TechFinancialsはヨーロッパで有数のフィンテック企業です。SportCoはTechFinancialsと提携することで、トークンの交換＆取引プラットフォームの進化と統合の継続を目指しています。</p>
         </div>
         <div class="col-md-3">
            <h4 class="service-heading"><a href="https://blockchaintechteam.com/">Blockchain Tech Team</a></h4>
            <hr>
            <p class="text-muted">Blockchain Tech Teamと共にブロックチェーンとトークン技術の標準化とプラットフォームの構築に取り組んでいます。</p>
         </div>
      </div>
      <div class="row">
         <div class="col-md-4 offset-md-2">
            <h4 class="service-heading"><a href="https://tokentarget.com/">Token Target</a></h4>
            <hr>
            <p class="text-muted">Token Targetは、フィンテック・金融・投資銀行業務・暗号通貨分野で強力な経歴を持つ専門家のチームです。彼らのミッションは、ICOとトークンセールブランドが目標としている資金調達の達成や、それらのコインやトークの価値向上に役立つことです。</p>
         </div>
         <div class="col-md-4">
            <h4 class="service-heading"><a href="http://pilanimation.com/">Pil Animation</a></h4>
            <hr>
            <p class="text-muted">Pil Animationは受賞歴のあるアニメーター＆監督のSharon Gazitが1998年に設立し、同氏がクリエイティブ・ディレクター兼CEOに就任しています。彼らのアニメ化プロジェクトは世界中でいくつもの賞を受賞しており、イスラエルや世界のマーケットでトップ企業・広告代理店のニーズに応えています。</p>
         </div>
      </div>
   </div>
</section>
<!-- 2018-05-08: hide the sections: CLOUD DATA & BACKEND DEVELOPMENTS -->
<section id="techno">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 text-center">
            <p class="text-center text-uppercase section-small-heading">私たちの技術</p>
            <br>&nbsp;
         </div>
      </div>
      <div class="row text-center tech_row">
         <div class="col-md-4">
            <span class="fa-stack fa-4x wow zoomIn">
            <i class="fa fa-circle fa-stack-2x text-primary"></i>
            <img src="img/networks.png" class="img-fluid img-tech">
            </span>
            <h4 class="service-heading">ブロックチェーンネットワーク</h4>
            <p class="text-muted">SPORTCO はイーサリアムメインネットを使って報酬ロイヤルティプログラム、ピアツーピアコンテンツ、ゲームエクスチェンジを制作します。世界中のファンが関わる数百万のスポーツコミュニティを扱う可能性を秘めています。</p>
         </div>
         <div class="col-md-4">
            <span class="fa-stack fa-4x wow zoomIn">
            <i class="fa fa-circle fa-stack-2x text-primary"></i>
            <img src="img/sportsdata.png" class="img-fluid img-tech">
            </span>
            <h4 class="service-heading">スポーツデータにおける人工知能（AI）</h4>
            <p class="text-muted">SPORTCO はスポーツ業界に人工知能（AI）を取り入れ、それをデータ分析を増やす進化系技術として、スポーツトレーニング＆パフォーマンス・チケット発券業務・販売計画・統計的な分析を促進しようとしています。</p>
         </div>
       <!--  <div class="col-md-4">
            <span class="fa-stack fa-4x wow zoomIn">
            <i class="fa fa-circle fa-stack-2x text-primary"></i>
            <img src="img/clouddata.png" class="img-fluid img-tech">
            </span>
            <h4 class="service-heading">クラウドデータ</h4>
            <p class="text-muted">SPORTCO はクラウド型データサービスを活用して複数のリアルタイム更新を拡張可能なオンデマンド環境で実現します。リアルタイムデータは様々なデータ供給元やIoTセンサーから収集されます。データ・レポジトリがデータ分析とデータ・マイニングにフィードを供給します。</p>
         </div>-->
                <div class="col-md-4">
            <span class="fa-stack fa-4x wow zoomIn">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <img src="img/web_apps.png" class="img-fluid img-tech">
            </span>
                    <h4 class="service-heading">ウェブ＆アプリレイヤー</h4>
                    <p class="text-muted">SPORTCO は、最新の技術を使ってウェブ、Android、iOSなど様々なインターフェースをモバイルゲーム、予測、ライブスコア、SNSプラットフォーム向けに開発します。熟練のUI/UXデザイナーたちには、最高のユーザー体験＆関わり方を提供できる技量を持ち合わせています。</p>
      </div>


            </div>
            <div class="row text-center tech_row" style="display: none;">
                <div class="col-md-4 offset-md-2" style="display: none;">
            <span class="fa-stack fa-4x wow zoomIn">
            <i class="fa fa-circle fa-stack-2x text-primary"></i>
            <img src="img/backenddevelopment.png" class="img-fluid img-tech">
            </span>
            <h4 class="service-heading">バックエンド開発</h4>
            <p class="text-muted">SPORTCO はスポーツエコシステム向けの強固で拡張可能なバックエンドソリューションの開発に取り組んでいます。アプリケーションはブロックチェーン分散台帳技術を使って安全に顧客へサービスを提供します。クラウド型インタフェースはモジュールとマイクロサービス構造を使い、待ち時間の少ない最適なアップデートを可能にしています。</p>
         </div>
         <div class="col-md-4">
            <span class="fa-stack fa-4x wow zoomIn">
            <i class="fa fa-circle fa-stack-2x text-primary"></i>
            <img src="img/web_apps.png" class="img-fluid img-tech">
            </span>
            <h4 class="service-heading">ウェブ＆アプリレイヤー</h4>
            <p class="text-muted">SPORTCO は、最新の技術を使ってウェブ、Android、iOSなど様々なインターフェースをモバイルゲーム、予測、ライブスコア、SNSプラットフォーム向けに開発します。熟練のUI/UXデザイナーたちには、最高のユーザー体験＆関わり方を提供できる技量を持ち合わせています。</p>
         </div>
      </div>
   </div>
</section>
<section id="why"  class="bg-light text-center">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 text-center">
            <p class="text-center text-uppercase section-small-heading">私たちを選ぶ理由</p>
            <p class="service-heading">弊社には技術、経験、プラットフォーム、そして情熱があり、<br>それらを新たなスポーツ・デジタル・エコシステムを創造するSPORTCOの運営に活かします。<br>&nbsp;
            </p>
            <br>&nbsp;
         </div>
      </div>
      <div class="row text-center reason_row">

           <div class="col-md-4 col-sm-3">
            <div class="row">
               <div class="col-md-12">
                <img src="img/rewards.png" class="img-fluid centered m-b-20">
              </div>
              <div class="col-md-12">
                <p>スポーツへの情熱に報いる仕組み</p>
              </div>
            </div>
          </div>


          <div class="col-md-4 col-sm-3">
            <div class="row">
              <div class="col-md-12">
                  <img src="img/team.png" class="img-fluid centered m-b-20">
               </div>
               <div class="col-md-12">
                  <p>経験豊富なチーム</p>
               </div>
            </div>
         </div>

          <div class="col-md-4 col-sm-3">
            <div class="row">
               <div class="col-md-12">
                  <img src="img/producers.png" class="img-fluid centered m-b-20">
               </div>
               <div class="col-md-12">
                  <p>既存のスポーツプロデューサー＆サービスプラットフォーム</p>
               </div>
            </div>
         </div>

          <div class="col-md-4 col-sm-3" style="display:none;">
            <div class="row">
               <div class="col-md-12">
                  <img src="img/trade.png" class="img-fluid centered m-b-20">
               </div>
               <div class="col-md-12">
                  <p>ユーティリティを介したトークン取引</p>
               </div>
            </div>
         </div>
         <div class="col-md-3 col-sm-6">
        </div>

        <div class="row text-center reason_row">

           <div class="col-md-4 col-sm-3">
            <div class="row">
               <div class="col-md-12">
                  <img src="img/multiple-sports.png" class="img-fluid centered m-b-20">
               </div>
               <div class="col-md-12">
                  <p>複数のスポーツ、地域およびコミュニティをつなぐSPORTCOグローバルクラブ</p>
               </div>
            </div>
         </div>

             <div class="col-md-4 col-sm-3">
            <div class="row">
               <div class="col-md-12">
                  <img src="img/Tournament.png" class="img-fluid centered m-b-20">
               </div>
               <div class="col-md-12">
                  <p>スポーツトーナメント＆仲間同士（ピアツーピア）のコンテスト</p>
               </div>
            </div>
         </div>
           <div class="col-md-4 col-sm-3" style="display:none;">
            <div class="row">
               <div class="col-md-12">
                  <img src="img/blockchain.png" class="img-fluid centered m-b-20">
               </div>
               <div class="col-md-12">
                  <p>ブロックチェーンの利用</p>
               </div>
            </div>
         </div>

            <div class="col-md-4 col-sm-3">
            <div class="row">
               <div class="col-md-12">
                  <img src="img/communities.png" class="img-fluid centered m-b-20">
               </div>
               <div class="col-md-12">
                  <p>既存の強力なスポーツコミュニティ</p>
               </div>
            </div>
         </div>

          <div class="col-md-4 col-sm-3" style="display:none;">
            <div class="row">
               <div class="col-md-12">
                  <img src="img/economy.png" class="img-fluid centered m-b-20">
               </div>
               <div class="col-md-12">
                  <p>スポーツマーケット＆マーケットエコノミー</p>
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
                  <p>複数の手続き、ゲーム、サービス＆機能</p>
               </div>
            </div>
         </div>

          <div class="col-md-4 col-sm-3">
            <div class="row">
               <div class="col-md-12">
                  <img src="img/producers.png" class="img-fluid centered m-b-20">
               </div>
               <div class="col-md-12">
                  <p>人工知能（AI）、拡張現実（AR）＆群知能（SWARM）技術</p>
               </div>
            </div>
         </div>

          <div class="col-md-4 col-sm-3">
            <div class="row">
               <div class="col-md-12">
                  <img src="img/Partners.png" class="img-fluid centered m-b-20">
               </div>
               <div class="col-md-12">
                  <p>実在するブランド＆スポーツ団体のパートナー</p>
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
            <p class="text-uppercase text-center section-small-heading">スポーツアンバサダー</p>
            <br>&nbsp;
         </div>
         <div class="col-lg-12">
            <div class="bxslider">
               <div>
                  <div class="row">
                     <div class="col-md-5 mob-div mb-4">
                        <img src="img/amb/tim.jpg" class="img-fluid centered bximg">
                     </div>
                     <div class="col-md-7">
                        <h3 class="text-left text-uppercase">ティム・デ・レーデ</h3>
                        <p class="text-left text-uppercase">KNCB クリケット</p>
                        <blockquote>
                           <p><i><span class="quote left">「</span>これはスポーツファンにとって新たな時代の幕開けです。これからは試合が実際に行われている時間でなくても、好きな時にSportcoのようなプラットフォームを通じて意見交換したり、世界中のスポーツ愛好家から提供される経歴情報などを楽しむことができるのです。<span class="quote right">」</span></i></p>
                        </blockquote>
                        <p>ティム・デ・レーデは、オランダの元クリケット選手で、11年という長いワン・デイ・インターナショナルでのキャリアをオランダナショナルチームで築き上げました。 右利きのオールラウンドに対応できる選手として1996年、2003年、2007年のワールドカップにオランダ代表として出場しました。2007年の引退後はコーチに転身し、2015年にはフランスのクリケットナショナルチームのヘッドコーチに就任しました。</p>
                        <p>ティム・デ・レーデはKNCB（オランダ・クリケット協会）に殿堂入りしています。</p>
                        <a class="btn btn-warning text-uppercase" href="<?= siteurl();?>testimonial/tim-de-leede.php" target="_blank">もっと読む</a>
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
                        <h3 class="text-left text-uppercase">フアン・カルロス</h3>
                        <p class="text-left text-uppercase">テニス選手、テニスコーチ </p>
                        <blockquote>
                           <p><i><span class="quote left">「</span>スポーツは選手と観客の情熱で動かされる業界であり、Sportcoのプラットフォームがそれを次の段階へ引き上げます。プロジェクトは完成された素晴らしい技術に支えられており、スポーツファンを中心に据えるそのアイデアに私自身も共感しました。プロジェクトに大きな可能性を感じています。これはコミュニケーションとスポーツの分野にとって本当に新しい出来事です。<span class="quote right">」</span></i></p>
                        </blockquote>
                        <p>フアン・カルロス・バゲーナはスペイン出身のテニスコーチおよび元プロテニスプレイヤーです。プロとしてトップレベルでプレイしていた彼のATP自己最高ランキングはシングルス190位、ダブルス100位です。いくつかのATPツアー・ダブルスイベントで優勝し、シングルスではマドリーとの大会で優勝しました。</p>
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
                                        <p><i><span class="quote left">“</span>One of the greatest principles of my master, Johan Cruyff, is that soccer is all about entertaining the fans.
                                                We have identified a great need for sports fans to express themselves on a dedicated platform that takes them seriously
                                                and ensures they're widely read.<span class="quote right">”</span></i></p>
                                    </blockquote>
                                    <p>Bryan Roy, who picked up 32 international caps for the Netherlands national football team and played in
                                        numerous championship games, also believes in the vision of Sportco and  will help Sportco spread its vision.</p>
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
            <p class="text-uppercase text-center">私たちのプラットフォーム</p>
         </div>
         <div class="col-md-12">
            <h2 class="service-heading text-center">スポーツファンが関わり、コミュニティを形成できるSPORTCOアプリケーション＆ゲーム。</h2>
            <br>&nbsp;
         </div>
         <div class="col-md-12">
            <div class="row">
               <div class="col-md-6 game_box">
                  <div class="row">
                     <div class="col-md-2">
                    <img src="img/platform/pt1.png" class="img-fluid centered">

                     </div>
                     <div class="col-md-10">
                        <h4>SPORTCO クイズ＆トリビア</h4>
                        <p>クラブ、国、そして世界のチャンピオンになりましょう。スポーツのクイズやゲームをプレイして自らの知識を証明し、勝者になるだけでなくタイトルも獲得しましょう。クイズに協力して賞品を獲得しましょう。</p>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 game_box">
                  <div class="row">
                     <div class="col-md-2">
                            <img src="img/platform/pt2.png" class="img-fluid centered">

                     </div>
                     <div class="col-md-10">
                        <h4>SPORTCO SWARMコミュニティ</h4>
                        <p>予想ゲームの達人になりませんか？スポーツの試合、チーム、選手、彼らのライフスタイルを予想するときは、Swarm技術を通じてスポーツファンから知恵を借りましょう。</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 game_box">
                  <div class="row">
                     <div class="col-md-2">
                      <img src="img/platform/pt3.png" class="img-fluid centered">

                     </div>
                     <div class="col-md-10">
                        <h4>SPORTCO 予測ゲーム</h4>
                        <p>スポーツイベントの予測でチャンピオンになりましょう。あなたが、その場にいても、いなくても、自分のスポーツファングループ、国内、または世界でチャンピオンになり、タイトルと賞品を手に入れましょう。自身の予測を立ててプラットフォームにアップロードしましょう。</p>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 game_box">
                  <div class="row">
                     <div class="col-md-2">
                            <img src="img/platform/pt4.png" class="img-fluid centered">

                     </div>
                     <div class="col-md-10">
                        <h4>SPORTCO 統計分析</h4>
                        <p>これまでにない見方やその影響力をシェアしたり、フォローすることができる統計分析です。</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 game_box">
                  <div class="row">
                     <div class="col-md-2">
                            <img src="img/platform/pt5.png" class="img-fluid centered">

                     </div>
                     <div class="col-md-10">
                        <h4>SPORTCO ブログ</h4>
                        <p>スポーツへの情熱を言葉で表現するブロクです。</p>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 game_box">
                  <div class="row">
                     <div class="col-md-2">
                            <img src="img/platform/pt6.png" class="img-fluid centered">

                     </div>
                     <div class="col-md-10">
                        <h4>スポーツファンタジー</h4>
                        <p>キャプテンとプレイヤーが中心となるバーチャル・ファンタジーゲームをプレイしましょう。</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 game_box">
                  <div class="row">
                     <div class="col-md-2">
                              <img src="img/platform/pt7.png" class="img-fluid centered">

                     </div>
                     <div class="col-md-10">
                        <h4>スポーツ動画</h4>
                        <p>メディアが捉えることのできない、ファンの直感で撮影したスポーツ動画をシェアしましょう。</p>
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
            <p class="text-uppercase section-small-heading">ファンコミュニティ報酬プール</p>
            <p class="service-heading col-md-8 offset-md-2">スポーツファンがSportCoプラットフォーム上のスポーツコミュニティへ、自らの創造性と豊かな知識をもって寄稿することに対し、どのように報酬が与えられるかの数少ない例です。
            </p>
            <br>&nbsp;
         </div>
      </div>
      <div class="row reason_row">
         <div class="col-md-12">
            <img src="img/fan_pool.png" class="img-fluid centered">
         </div>
      </div>
      <div class="row reason_row">
         <div class="col-md-12 text-center">
            <p>すべての寄稿は発行に値しますが、報酬は編集者とモデレーターによるユーザーパネルの投票によって承認された場合にのみ与えられます。 </p>
         </div>
      </div>
   </div>
</section>
<section id="fan"  class="navy-bg">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 text-center">
            <p class="text-uppercase section-small-heading">バウンティ報酬</p>
            <p class="service-heading col-md-10 offset-md-1">SPORTCO ビジネスモデルの早期導入者になりましょう。SPORTCO からのメッセージを仲間のブロックチェーンスポーツコミュニティへ伝えたり、世界中のスポーツファンに報いる私たちを助けたりすることで、自ら報酬を受け取りましょう。</p>
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
                        <h5 class="text-center">コミュニティがSportCoのICOに貢献すべき理由について400～600単語のブログ記事を書き、投稿して自分のSNSフォロワーへ伝えましょう。 </h5>
                     </div>
                     <div class="bounty-medium">
                        <h4 class="text-center">100ポイント</h4>
                     </div>
                     <div class="bounty-bottom">
                        <h4 class="text-center">&nbsp;</h4>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="bounty-box bounty-box2">
                     <div class="bounty-upper">
                        <h5 class="text-center">SPORTICOのICO日程についの私たちのツイッターを50人にリツイートさせる。</h5>
                     </div>
                     <div class="bounty-medium">
                        <h4 class="text-center">50ポイント</h4>
                     </div>
                     <div class="bounty-bottom">
                        <h5 class="text-center">報酬はSPORTCOコインで支払われます</h5>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="bounty-box bounty-box3">
                     <div class="bounty-upper">
                        <h5 class="text-center">SPORTCOが今月注目のICOであるというBitcoinトークについて100～200単語のブログ記事を投稿する。</h5>
                     </div>
                     <div class="bounty-medium">
                        <h4 class="text-center">100ポイント</h4>
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
            <p>すべての寄稿は編集者とモデレーターのパネルによりレビュー＆承認されます。 </p>
                    <p>All contributions will be reviewed and approved by our panel of Editors and Moderators.</p>
         </div>
      </div>
   </div>
</section>
<section id="contactSection">
   <div class="container">
      <div class="row">
         <div class="col-md-10 offset-md-1">
            <p class="text-uppercase text-center section-small-heading">お問合せフォーム</p>
            <p class="service-heading text-center col-md-10 offset-md-1">お気軽にお問合せください</p>
            <div id="back_result"></div>
            <br><br>
            <form class="contact-form">
               <div class="row form-group">
                  <div class="col-md-6">
                     <input type="name" name="vname" class="form-control" placeholder="お名前">
                  </div>
                  <div class="col-md-6">
                     <input type="email" name="vemail" class="form-control" placeholder="メールアドレス">
                  </div>
               </div>
               <div class="row form-group">
                  <div class="col-md-12">
                     <input type="text" name="vsubject" class="form-control" placeholder="件名">
                  </div>
               </div>
               <div class="row form-group">
                  <div class="col-md-12">
                     <textarea name="vmessage" class="form-control" placeholder="Message" rows="5"></textarea>
                  </div>
               </div>
               <div class="row form-group">
                  <div class="col-md-3">
                     <button class="btn btn-primary text-uppercase btnSubmit" type="button">メッセージを送信</button>
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
                  <p class="team-pop-detail">サンプルテキスト</p>
                  <div class="team-pop-list">
                     <ul class="team-social-list"></ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
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
           speed: 1000,
           pause: 5500,
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
                      '  <button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
                         '  <strong>Thanks!</strong> We have received your request.\n' +
                         '</div>'
                     $('#back_result').html(success);
                     $('.contact-form').find('input,textarea').val('');
                 }
                 else{
                     var error = '<div class="alert alert-info alert-dismissable">\n' +
                      '  <button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
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
var deadline = 'May 17 2018 23:59:59 GMT+0530';

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
                      '  <button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
                         '  <strong>Thanks!</strong> You have been subscribed.\n' +
                         '</div>'
                     $('#sub_result').html(success);
                     $('.subscribe-form').find('input').val('');
                 }
                 else{
                     var error = '<div class="alert alert-info alert-dismissable">\n' +
                      '  <button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
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