<html lang="en">
<head>
    <title>Team List</title>
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 ,user-scalable=no,maximum-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="stylesheet" href="https://olympics-app.sportswizzleague.biz/tatasky.min.css.gz"/>

    <link rel="stylesheet" href="https://olympics-app.sportswizzleague.biz/jquery-ui.css.gz"/>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
 


 
</head>
<style>
    /*.tabs-outer a {
        width: 16.7%;
    }*/
    body{font-family: 'Source Sans Pro', sans-serif;}
    .card-header {
        background: transparent;
        border: none;
    }

    .custom .card-header a {
        display: block;
        padding: 0;
    }

    .active.accordiontoggle:before {
        transform: rotate(180deg);
    }

    .custom {
        height: auto;
        padding: 0;
    }

    #navbar-example2 {
        top: 95px
    }
      .table td {
        padding: 10px;
        vertical-align: middle;
        white-space: nowrap;

    }
    .table td img{
        vertical-align: middle;
    }
    .matchdate strong{
        background: #ffffff;
    }

    .sub-heading{ font-size: 20px; font-weight: bold;}
    .bold,table tr.bold td{font-weight: bold;}
    .heading-row .heading{ font-size: 18px; font-weight: bold;; margin-bottom: 0;}
    .heading-row .heading span{ vertical-align: middle;}
     .heading-row{ background-color:#164b97; color: #fff;}
     .title-bar{ color: #888;}
     .date{ float: right; font-size: 12px; color: #666;}
     .tab-inner a { color: #333; text-decoration: none;}
     .medal_table tr td{ text-align: center;}
     .medal_table tr td span{ vertical-align: middle;}
     .medal_table tr td:first-child,.medal_table tr td:nth-child(2) { text-align: left;}
     .date-dropdown { position: relative;}
     .date-dropdown input,.search-bar input,.medal-dropdown select{font-size: 14px; color: #495057; background-color:#f1f3f5;  min-height: 34px; padding: .2rem 1rem; margin:0 .1rem;border:1px solid #f1f3f5;border-radius: 20px;  max-width: 150px;  -webkit-appearance: none; -moz-appearance: none;appearance: none;}
    
    .drop-icon,.search-icon{ width: 15px;  position: absolute; right: 15px;top: 50%; transform:translateY(-50%); font-size: 12px;;} 
    .date-dropdown input:focus-visible,.search-bar input:focus-visible,.medal-dropdown select:focus-visible{ outline: none;}
    .ui-state-highlight, .ui-widget-content .ui-state-highlight, .ui-widget-header .ui-state-highlight{
        border: 1px solid #164b97; ; background: #2f70ce;color: #ffffff;
    } 
    .ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, a.ui-button:active, .ui-button:active, .ui-button.ui-state-active:hover{
        border: 1px solid #3b3c97;background: #593097; font-weight: normal;}
        /* .ui-widget-header .ui-icon{  background: none;} */
    /* .ui-widget-header .ui-icon:after{ content:"\f078"; font-family: "Font Awesome 5 Free"; font-weight: 900; position: absolute; width: 20px; height: 20px; left: 0;} */
    .search-bar{ position: relative;}
    .search-bar input{ padding-left: 2rem;}
    .search-icon{ left: 15px;}
    .schedule-list tr td{ text-align: center;}
    .mobile-view{ width:402px; height: 836px; /*background-image: url('mobile-bg.png');*/ }
    .mobile-inner{width:372px; height:652px; background-color:#fff; position: absolute; left: 50%; top: 50%;
    transform:translate(-50%, -52%);}
    .main-screen{padding: 0rem; border-radius: 5px;}
    .main-screen header{ border-bottom: 1px solid #ece8e8; margin-bottom: .2rem; padding-bottom: .5rem;}
    .main-screen header h5{ font-weight: 600; font-size: 18px; margin-bottom: 0; line-height: 30px; }
    .main-screen header span.date{font-size: 12px; float: left; }
    .main-screen header .next-tab{ width: 24px; height: 24px;    margin-top: .5rem; text-align: center; background-color: #5087c7; border-radius: 100%; display: inline-block; text-decoration: none; color: #fff;;}
    .main-screen header .next-tab i{ line-height: 24px;}
    .main-screen .content p{ font-size: 14px;}
    .main-screen .content .live-link{ text-decoration: none; color:#e5007d;}
    .main-screen .content .live-link i{ font-size: 10px ;}
    .main-screen .content .score-bord{ font-size: 28px; text-align: center;margin-top: -10px;}
    .main-screen .content .score-bord span{ background-color: #cacaca; font-size: 12px; padding: 3px 5px;}
    .main-screen .primary-btn{ text-decoration: none; text-align:center;padding: .7rem; border-radius: 5px;; color: #fff; background-color: #5087c7; display: block; }
    .main-screen .primary-link{ display: block; text-align: center; color: #5087c7;}
</style>
<body>



<div class="container-fluid h-100">
    <div class="row row h-100 align-items-center">
        <div class="col-12 pt-2">
            <div class="main-screen">
                <header class="d-flex justify-content-between">
                    <div class="media">
                        <img width="40" class="mr-3" src="https://olympics-app.sportswizzleague.biz/olympics-2020.png">
                        <div class="media-body">
                          <h5 class="mt-0">Olympics 2020</h5>
                          <span class="date">Jul 21 - Aug 6</span>
                         </div>
                      </div>

                      <a class="next-tab link-sid" href="https://olympics.sportswizzleague.biz/widget/view-matches?sportco=true">
                        <i class="fas fa-angle-right"></i>
                      </a>
                </header>

                <div class="content">
                    <div id="main">
                       <div class="d-flex justify-content-between">
                        <p><strong> Badminton</strong> | Women | Qualifiers</p>
                        <a class="live-link" href="#"><i class="fas fa-circle"></i> <span class="align-middle">Fixture</span> </a>
                       </div>

                       
                    </div>

                    <a class="primary-btn mb-2 link-sid" id="sid" href="https://olympics.sportswizzleague.biz/widget/view-matches?sportco=true">View Arena</a>

                    <!-- <a class="primary-btn mb-2 link-sid" id="arena" href="https://olympics.sportswizzleague.biz/widget/view-matches">View Arena</a> -->

                    
                </div>

                <!-- <div class="content">
                    <div id="main">                   
                        
                        <div class="d-flex justify-content-between">
                            <p>Table Tennis  ! Women ! Qualifiers <span class="gray-batch ml-2">Game 2</span></p>
                            <a class="live-link" href="#"><i class="fas fa-circle"></i> <span class="align-middle">Live</span> </a>
                        </div>

                        <div class="d-flex justify-content-between">
                           <div>
                             <p><img width="20" class="mr-2" src="flag-4.png" alt="">  <span>P.V Sindhu</span></p>
                             <p><img width="20" class="mr-2" src="flag-3.png" alt="">  <span>Carolina Marin</span></p>
                           </div>
                           <div>
                               <p class="score-list"> 
                                    <span>15</span> 
                                    <span>21 </span>
                                    <span> 14</span>
                                    <span>0</span>
                                </p>
                                <p class="score-list">
                                    <span>15</span> 
                                    <span>21</span>
                                    <span>14</span> 
                                    <span>0</span>
                                </p>

                           </div>

                        </div>
                    </div>

                    <a class="primary-btn mb-2" href="">Watch Now</a>
                    <a class="primary-link mb-3" href="#">See What's Live</a>
                </div> -->


            </div>
        </div>
    </div>
    
</div>



   

<script src="https://swl-ts-widgets.s3.ap-south-1.amazonaws.com/widget/dv-preview.min.js.gz"></script>
<script>
    /*const urlSearchParams = new URLSearchParams(window.location.search);
    const params = Object.fromEntries(urlSearchParams.entries());
    // console.log(params)
    if(params?.sid){
        $(".link-sid").attr("href", "https://olympics.sportswizzleague.biz/widget/view-matches?sid="+params.sid)
    }*/

</script>
<script>

    $("#accordionlink3").one("click", function () {
        //console.log( "This will be displayed only once." );
        $(".accordionlink3").removeClass("active");
    });
    $("#accordionlink1").one("click", function () {
        //console.log( "This will be displayed only once." );
        $(".accordionlink1").removeClass("active");
    });


    

</script>
    <!-- calender -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://kit.fontawesome.com/6bec465ba9.js"crossorigin="anonymous"></script>
<script>
    $( function() {
      $( "#datepicker" ).datepicker();
    } );
    </script>
    <script>
        $( function() {
          $( "#datepicker2" ).datepicker();
        } );
        </script>

<script>
    $( function() {
        $('#arena').hide();        
    } );
</script>

    


<!-- <script type="text/javascript">
         var $prod="1"; 
         var baseUrl = "https://fbwidget.sportswizzleague.biz"; 
         var watchUrl = "https://watch.tatasky.com/sportzinteractive";
      </script> 
      <script src="https://swl-euro-widgets.s3.ap-south-1.amazonaws.com/widget/tatasky.min.js.gz"></script> 
<script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js"></script>

<script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-analytics.js"></script> -->
      <script>

        /*var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        console.log(urlSearchParams);
                        console.log(params);
                        return;*/

         /*var config={
            apiKey:"AIzaSyB4mMZivaUgdWzmUGXfKqvHAJZ1h2TNz4g",
            authDomain: "fir-firebase-173dc.firebaseapp.com",
            databaseURL: "https://fir-firebase-173dc-default-rtdb.asia-southeast1.firebasedatabase.app",
            projectId: "fir-firebase-173dc",
            storageBucket: "fir-firebase-173dc.appspot.com",
            messagingSenderId: "285788034549",
         };*/


            




         var config={
            apiKey:"AIzaSyB6vQ8sCE9UGxbSNL8_y1k1kE3mgTxdvQU",
            authDomain:"test-firestore-b2617.firebaseapp.com",
            databaseURL:"https://test-firestore-b2617.firebaseio.com",
            projectId:"test-firestore-b2617",
            storageBucket:"test-firestore-b2617.appspot.com",
            messagingSenderId:"503866906024"
         };

         
         firebase.initializeApp(config);
      </script> 
      <script type="text/javascript">
         // fetchData("matchDetails-40281",0);
         $(".date").html(new Date().toDateString())
        $(document).ready(function(){
            
            var db=firebase.firestore();

            
            db.collection("match_data").doc("live_category").onSnapshot(function(doc){
                var data       = doc.data();
                
                var docu = data.name;
                // console.log(docu);


            if(docu == "field_hockey"){


                db.collection("match_data").doc("field_hockey").onSnapshot(function(doc)
                {
                    var data       = doc.data();
                    var team_a     = data.team_a;
                    var team_b     = data.team_b;
                    var score_a    = data.score_a;
                    var score_b    = data.score_b;
                    var flag_a    = data.flag_a;
                    var flag_b    = data.flag_b;
                    var sport_name = data.sport_name;
                    var round_name = data.round_name;
                    var gender     = data.gender;

                    var status     = data.status;
                    


                    if(gender == 'male'){
                        gender = 'Male';
                    }else if(gender == 'male'){
                        gender = 'Female';
                    }else if(gender == 'mixed'){
                        gender = 'Mixed';
                    }

                    if(status == 'Playing'){
                        status = 'Live';
                        
                        var change = document.getElementById('sid');
                        change.innerHTML = 'Explore Now';
                        change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';

                    }else if(status == 'Break'){
                    
                        status = 'Break';
                        
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{

                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                    
                    }else if(status == 'Played'){
                        status = 'Played';
                        var change = document.getElementById('sid');

                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        
                    }else if(status == 'Fixture'){
                        status = 'Fixture'
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        
                    }else if(status == 'Postponed'){
                        status = 'Postponed';
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        
                    }else if(status == 'Awarded'){
                        status = 'Awarded'; 
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        
                    }else if(status == 'Cancelled'){
                        
                        status = 'Cancelled';
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                    }

                    var html = '<div class="d-flex justify-content-between"><p><strong>'+           sport_name+'</strong> | ' + gender + ' | '+ round_name +'           </p><a class="live-link" href="#"><i class="fas             fa-circle"></i> <span class="align-middle">'+ status +'</span> </a></div>' +

                                '<div class="d-flex justify-content-between"><p><img width="20" class="mr-2" src="https://olympics.sportswizzleague.biz/images/flags/'+flag_a+'.png" alt="">  <span>'+team_a+'</span></p><p class="score-bord mb-1">'+score_a+':'+score_b+' </p><p><img width="20" class="mr-2" src="https://olympics.sportswizzleague.biz/images/flags/'+flag_b+'.png" alt="">  <span>'+team_b+'</span></p></div>';               
                
                        $("#main").empty();
                        $("#main").html(html);
                });


            }else if(docu == "tennis"){

                db.collection("match_data").doc("tennis").onSnapshot(function(doc)
                {
                    var data    = doc.data();
                    var type    = data.type;

                    if(type == 'Singles'){

                        var contestant_a_match_name        = data.contestant_a_match_name;
                        var contestant_a_nationality_code  = data.contestant_a_nationality_code;
                        
                        var contestant_b_match_name         = data.contestant_b_match_name;
                        var contestant_b_nationality_code  = data.contestant_b_nationality_code;
                        
                        var gender                         = data.gender;
                        var round_name                     = data.round_name;
                        var score_a                        = data.score_a;
                        var score_b                        = data.score_b;
                        var status                         = data.status;
                        var sport_name                     = data.sport_name;
                        var set                            = data.set;

                        if(gender == 'male'){
                            gender = 'Male';
                        }else if(gender == 'male'){
                            gender = 'Female';
                        }else if(gender == 'mixed'){
                            gender = 'Mixed';
                        }
                        if(status == 'Playing'){
                        status = 'Live';
                        
                        var change = document.getElementById('sid');

                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'Watch Now';
                            change.href = 'https://watch.tatasky.com/sportzinteractive';
                        }

                    }else if(status == 'Break'){
                    
                        status = 'Break';
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                    
                    }else if(status == 'Played'){
                        status = 'Played';
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        
                    }else if(status == 'Fixture'){
                        status = 'Fixture'
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        
                    }else if(status == 'Postponed'){
                        status = 'Postponed';
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        
                    }else if(status == 'Awarded'){
                        status = 'Awarded'; 
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        
                    }else if(status == 'Cancelled'){
                        
                        status = 'Cancelled';
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                    }


                        var html = '<div class="d-flex justify-content-between"><p>' + sport_name  +   ' | ' + gender + ' | ' + round_name+ /*'<span class="gray-batch ml-2">Game 2</span>*/'</p><a class="live-link" href="#"><i class="fas fa-circle"></i> <span class="align-middle">'+status+'</span> </a></div>' +

                            '<div class="d-flex justify-content-between">'+
                               '<div>'+
                                 '<p><img width="20" class="mr-2" src="https://olympics.sportswizzleague.biz/images/flags/'+contestant_a_nationality_code+'.png" alt="">  <span>'+contestant_a_match_name+'</span></p>'+
                                 '<p>'+
                                 '<img width="20" class="mr-2" src="https://olympics.sportswizzleague.biz/images/flags/'+contestant_b_nationality_code+'.png" alt="">  <span>'+ contestant_b_match_name+'</span></p>'+
                               '</div>'+
                               '<div>'+
                                    '<p class="score-list">';

                                     $(set).each(function(i, result){

                                        length = result.score_a.length;
                                            
                                            if(length == 1){

                                                score = 0+result.score_a;
                                            }else{
                                                score = result.score_a;

                                            }
                                            html += '<span>'+score+'</span> &nbsp;';
                                        }); 

                                    html +='</p>'+

                                    '<p class="score-list">';

                                     $(set).each(function(i, result){
                                            length = result.score_b.length;
                                            
                                            if(length == 1){

                                                score = 0+result.score_b;
                                            }else{
                                                score = result.score_b;

                                            }

                                            html += '<span>'+score+'</span> &nbsp;';
                                        }); 

                                    html +='</p>'+
                                    

                               '</div>'+

                            '</div>';    
                    
                            $("#main").empty();
                            $("#main").html(html);

                    }else{
                        
                        var contestant_a1_matchname           = data.contestant_a1_matchname;
                        var contestant_a1_nationality_code    = data.contestant_a1_nationality_code;

                        var contestant_a2_matchname           = data.contestant_a2_matchname;
                        var contestant_a2_nationality_code    = data.contestant_a2_nationality_code;
                        
                        var contestant_b1_matchname           = data.contestant_b1_matchname;
                        var contestant_b1_nationality_code    = data.contestant_b1_nationality_code;

                        var contestant_b2_matchname           = data.contestant_b2_matchname;
                        var contestant_b2_nationality_code    = data.contestant_b2_nationality_code;


                        var gender                            = data.gender;
                        var round_name                        = data.round_name;
                        
                        var status                            = data.status;
                        var sport_name                        = data.sport_name;
                        var set                               = data.set;

                        if(gender == 'male'){
                            gender = 'Male';
                        }else if(gender == 'male'){
                            gender = 'Female';
                        }else if(gender == 'mixed'){
                            gender = 'Mixed';
                        }
                        if(status == 'Playing'){
                        status = 'Live';
                        
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'Watch Now';
                            change.href = 'https://watch.tatasky.com/sportzinteractive';
                        }

                    }else if(status == 'Break'){
                    
                        status = 'Break';
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                    
                    }else if(status == 'Played'){
                        status = 'Played';
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        
                    }else if(status == 'Fixture'){
                        status = 'Fixture'
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        
                    }else if(status == 'Postponed'){
                        status = 'Postponed';
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        
                    }else if(status == 'Awarded'){
                        status = 'Awarded'; 
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        
                    }else if(status == 'Cancelled'){
                        
                        status = 'Cancelled';
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                    }

                        var html = '<div class="d-flex justify-content-between"><p>' + sport_name  +   ' | ' + gender + ' | ' + round_name+ /*'<span class="gray-batch ml-2">Game 2</span>*/'</p><a class="live-link" href="#"><i class="fas fa-circle"></i> <span class="align-middle">'+status+'</span> </a></div>' +

                            '<div class="d-flex justify-content-between">'+
                               '<div>'+
                                 '<p><img width="20" class="mr-2" src="https://olympics.sportswizzleague.biz/images/flags/'+contestant_a1_nationality_code+'.png" alt="">  <span>'+contestant_a1_matchname+'</span> , <span>'+contestant_a2_matchname+'</span> </p>'+
                                 '<p>'+
                                 '<img width="20" class="mr-2" src="https://olympics.sportswizzleague.biz/images/flags/'+contestant_b1_nationality_code+'.png" alt="">  <span>'+contestant_b1_matchname +'</span> , <span>'+contestant_b2_matchname +'</span></p>'+
                               '</div>'+
                               '<div>'+
                                    '<p class="score-list">';

                                     $(set).each(function(i, result){

                                            length = result.score_a.length;
                                            
                                            if(length == 1){

                                                score = 0+result.score_a;
                                            }else{
                                                score = result.score_a;

                                            }
                                            html += '<span>'+score+'</span> &nbsp;';
                                        }); 

                                    html +='</p>'+
                                    '<p class="score-list">';
                                        $(set).each(function(i, result){

                                            length = result.score_b.length;
                                            
                                            if(length == 1){

                                                score = 0+result.score_b;
                                            }else{
                                                score = result.score_b;

                                            }
                                            html += '<span>'+score+'</span> &nbsp;';
                                        }); 
                                    html +='</p>'+

                               '</div>'+

                            '</div>';    
                    
                            $("#main").empty();
                            $("#main").html(html);


                    }        
                });

            }else if(docu == "table_tennis"){

                db.collection("match_data").doc("table_tennis").onSnapshot(function(doc)
                {
                    var data    = doc.data();
                    var type    = data.type;

                    if(type == 'Mixed Doubles'){
                        
                        var contestant_a1_matchname           = data.contestant_a1_matchname;
                        var contestant_a1_nationality_code    = data.contestant_a1_nationality_code;

                        var contestant_a2_matchname           = data.contestant_a2_matchname;
                        var contestant_a2_nationality_code    = data.contestant_a2_nationality_code;
                        
                        var contestant_b1_matchname           = data.contestant_b1_matchname;
                        var contestant_b1_nationality_code    = data.contestant_b1_nationality_code;

                        var contestant_b2_matchname           = data.contestant_b2_matchname;
                        var contestant_b2_nationality_code    = data.contestant_b2_nationality_code;


                        var gender                            = data.gender;
                        var round_name                        = data.round_name;
                        
                        var status                            = data.status;
                        var sport_name                        = data.sport_name;
                        var set                               = data.set;

                        if(gender == 'male'){
                            gender = 'Male';
                        }else if(gender == 'male'){
                            gender = 'Female';
                        }else if(gender == 'mixed'){
                            gender = 'Mixed';
                        }

                        if(status == 'Playing'){
                        status = 'Live';
                        
                        var change = document.getElementById('sid');
                         var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'Watch Now';
                            change.href = 'https://watch.tatasky.com/sportzinteractive';
                        }

                        }else if(status == 'Break'){
                    
                        status = 'Break';
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                    
                        }else if(status == 'Played'){
                        status = 'Played';
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        
                        }else if(status == 'Fixture'){
                        status = 'Fixture'
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        
                        }else if(status == 'Postponed'){
                        status = 'Postponed';
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        
                        }else if(status == 'Awarded'){
                        status = 'Awarded'; 
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        
                        }else if(status == 'Cancelled'){
                        
                        status = 'Cancelled';
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        }

                        var html = '<div class="d-flex justify-content-between"><p>' + sport_name  +   ' | ' + gender + ' | ' + round_name+'</p><a class="live-link" href="#"><i class="fas fa-circle"></i> <span class="align-middle">'+status+'</span> </a></div>' +

                            '<div class="d-flex justify-content-between">'+
                               '<div>'+
                                 '<p><img width="20" class="mr-2" src="https://olympics.sportswizzleague.biz/images/flags/'+contestant_a1_nationality_code+'.png" alt="">  <span>'+contestant_a1_matchname+'</span> , <span>'+contestant_a2_matchname+'</span> </p>'+
                                 '<p>'+
                                 '<img width="20" class="mr-2" src="https://olympics.sportswizzleague.biz/images/flags/'+contestant_b1_nationality_code+'.png" alt="">  <span>'+contestant_b1_matchname +'</span> , <span>'+contestant_b2_matchname +'</span></p>'+
                               '</div>'+
                               '<div>'+
                                    '<p class="score-list">';

                                     $(set).each(function(i, result){

                                        length = result.score_a.length;
                                            
                                            if(length == 1){

                                                score = 0+result.score_a;
                                            }else{
                                                score = result.score_a;

                                            }
                                            html += '<span>'+score+'</span> &nbsp;';
                                        }); 

                                    html +='</p>'+
                                    '<p class="score-list">';
                                        $(set).each(function(i, result){
                                            length = result.score_b.length;
                                            
                                            if(length == 1){

                                                score = 0+result.score_b;
                                            }else{
                                                score = result.score_b;

                                            }
                                            html += '<span>'+score+'</span> &nbsp;';
                                        }); 
                                    html +='</p>'+

                               '</div>'+

                            '</div>';    
                    
                            $("#main").empty();
                            $("#main").html(html);
                    }
                    else{

                        var contestant_a_match_name        = data.contestant_a_match_name;
                        var contestant_a_nationality_code  = data.contestant_a_nationality_code;
                        
                        var contestant_b_match_name         = data.contestant_b_match_name;
                        var contestant_b_nationality_code  = data.contestant_b_nationality_code;
                        
                        var gender                         = data.gender;
                        var round_name                     = data.round_name;
                        var score_a                        = data.score_a;
                        var score_b                        = data.score_b;
                        var status                         = data.status;
                        var sport_name                     = data.sport_name;
                        var set                            = data.set;

                        if(gender == 'male'){
                            gender = 'Male';
                        }else if(gender == 'male'){
                            gender = 'Female';
                        }else if(gender == 'mixed'){
                            gender = 'Mixed';
                        }
                        if(status == 'Playing'){
                        status = 'Live';
                        
                        var change = document.getElementById('sid');
                         var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'Watch Now';
                            change.href = 'https://watch.tatasky.com/sportzinteractive';
                        }

                    }else if(status == 'Break'){
                    
                        status = 'Break';
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                    
                    }else if(status == 'Played'){
                        status = 'Played';
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        
                    }else if(status == 'Fixture'){
                        status = 'Fixture'
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        
                    }else if(status == 'Postponed'){
                        status = 'Postponed';
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        
                    }else if(status == 'Awarded'){
                        status = 'Awarded'; 
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        
                    }else if(status == 'Cancelled'){
                        
                        status = 'Cancelled';
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                    }


                        var html = '<div class="d-flex justify-content-between"><p>' + sport_name  +   ' | ' + gender + ' | ' + round_name+ /*'<span class="gray-batch ml-2">Game 2</span>*/'</p><a class="live-link" href="#"><i class="fas fa-circle"></i> <span class="align-middle">'+status+'</span> </a></div>' +

                            '<div class="d-flex justify-content-between">'+
                               '<div>'+
                                 '<p><img width="20" class="mr-2" src="https://olympics.sportswizzleague.biz/images/flags/'+contestant_a_nationality_code+'.png" alt="">  <span>'+contestant_a_match_name+'</span></p>'+
                                 '<p>'+
                                 '<img width="20" class="mr-2" src="https://olympics.sportswizzleague.biz/images/flags/'+contestant_b_nationality_code+'.png" alt="">  <span>'+ contestant_b_match_name+'</span></p>'+
                               '</div>'+
                               '<div>'+
                                    '<p class="score-list">';

                                     $(set).each(function(i, result){

                                        length = result.score_a.length;
                                            
                                            if(length == 1){

                                                score = 0+result.score_a;
                                            }else{
                                                score = result.score_a;

                                            }
                                            html += '<span>'+score+'</span> &nbsp;';
                                        }); 

                                    html +='</p>'+

                                    '<p class="score-list">';

                                     $(set).each(function(i, result){
                                            length = result.score_b.length;
                                            
                                            if(length == 1){

                                                score = 0+result.score_b;
                                            }else{
                                                score = result.score_b;

                                            }

                                            html += '<span>'+score+'</span> &nbsp;';
                                        }); 

                                    html +='</p>'+
                                    

                               '</div>'+

                            '</div>';    
                    
                            $("#main").empty();
                            $("#main").html(html);
                    }


                           
                });


            }else if(docu == "badminton"){

                db.collection("match_data").doc("badminton").onSnapshot(function(doc)
                {
                    var data    = doc.data();
                    var type    = data.type;

                    if(type == 'Doubles'){

                        var contestant_a1_matchname           = data.contestant_a1_matchname;
                        var contestant_a1_nationality_code    = data.contestant_a1_nationality_code;
                        var contestant_a2_matchname           = data.contestant_a2_matchname;
                        var contestant_a2_nationality_code    = data.contestant_a2_nationality_code;
                        
                        var contestant_b1_matchname           = data.contestant_b1_matchname;
                        var contestant_b1_nationality_code    = data.contestant_b1_nationality_code;
                        var contestant_b2_matchname           = data.contestant_b2_matchname;
                        var contestant_b2_nationality_code    = data.contestant_b2_nationality_code;
                        var gender                            = data.gender;
                        var round_name                        = data.round_name;
                        var score_a                           = data.score_a;
                        var score_b                           = data.score_b;
                        var status                            = data.status;
                        var sport_name                        = data.sport_name;


                        if(gender == 'male'){
                            gender = 'Male';
                        }else if(gender == 'male'){
                            gender = 'Female';
                        }else if(gender == 'mixed'){
                            gender = 'Mixed';
                        }
                        if(status == 'Playing'){
                        status = 'Live';
                        
                        var change = document.getElementById('sid');
                         var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'Watch Now';
                            change.href = 'https://watch.tatasky.com/sportzinteractive';
                        }

                    }else if(status == 'Break'){
                    
                        status = 'Break';
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                    
                    }else if(status == 'Played'){
                        status = 'Played';
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        
                    }else if(status == 'Fixture'){
                        status = 'Fixture'
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        
                    }else if(status == 'Postponed'){
                        status = 'Postponed';
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        
                    }else if(status == 'Awarded'){
                        status = 'Awarded'; 
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        
                    }else if(status == 'Cancelled'){
                        
                        status = 'Cancelled';
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                    }

                        var html = '<div class="d-flex justify-content-between"><p><strong>'+           sport_name+'</strong> | ' + gender + ' | '+ round_name +'           </p><a class="live-link" href="#"><i class="fas             fa-circle"></i> <span class="align-middle">'+ status +'</span> </a></div>' +

                                    '<div class="d-flex justify-content-between"><p><img width="20" class="mr-2" src="https://olympics.sportswizzleague.biz/images/flags/'+contestant_a1_nationality_code+'.png" alt="">  <span>'+contestant_a1_matchname+'</span><br><br><span style="padding-left: 32px;">'+contestant_a2_matchname+'</span></p><p class="score-bord mb-1">'+score_a+':'+score_b+'  </p><p><img width="20" class="mr-2" src="https://olympics.sportswizzleague.biz/images/flags/'+contestant_b1_nationality_code+'.png" alt="">  <span>'+contestant_b1_matchname+'</span><br><br><span style="padding-left: 32px;">'+contestant_b2_matchname+'</span></p></div>';                 
                    
                            $("#main").empty();
                            $("#main").html(html);
                    }else{
                        
                        var contestant_a1_matchname           = data.contestant_a_match_name;
                        var contestant_a1_nationality_code    = data.contestant_a_nationality_code;
                        
                        var contestant_b1_matchname           = data.contestant_b_match_name;
                        var contestant_b1_nationality_code    = data.contestant_b_nationality_code;
                        var gender                            = data.gender;
                        var round_name                        = data.round_name;
                        var score_a                           = data.score_a;
                        var score_b                           = data.score_b;
                        var status                            = data.status;
                        var sport_name                        = data.sport_name;


                        if(gender == 'male'){
                            gender = 'Male';
                        }else if(gender == 'male'){
                            gender = 'Female';
                        }else if(gender == 'mixed'){
                            gender = 'Mixed';
                        }
                        if(status == 'Playing'){
                        status = 'Live';
                        
                        var change = document.getElementById('sid');
                         var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'Watch Now';
                            change.href = 'https://watch.tatasky.com/sportzinteractive';
                        }

                    }else if(status == 'Break'){
                    
                        status = 'Break';
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                    
                    }else if(status == 'Played'){
                        status = 'Played';
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        
                    }else if(status == 'Fixture'){
                        status = 'Fixture'
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        
                    }else if(status == 'Postponed'){
                        status = 'Postponed';
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        
                    }else if(status == 'Awarded'){
                        status = 'Awarded'; 
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                        
                    }else if(status == 'Cancelled'){
                        
                        status = 'Cancelled';
                        var change = document.getElementById('sid');
                        var urlSearchParams = new URLSearchParams(window.location.search);
                        var params = Object.fromEntries(urlSearchParams.entries());

                        if(params?.sportco){
                        
                            change.innerHTML = 'Explore Now';
                            
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }else{
                            
                            change.innerHTML = 'View Arena';
                            change.href = 'https://olympics.sportswizzleague.biz/widget/view-matches';
                        }
                    }

                        var html = '<div class="d-flex justify-content-between"><p><strong>'+           sport_name+'</strong> | ' + gender + ' | '+ round_name +'           </p><a class="live-link" href="#"><i class="fas             fa-circle"></i> <span class="align-middle">'+ status +'</span> </a></div>' +

                                    '<div class="d-flex justify-content-between"><p><img width="20" class="mr-2" src="https://olympics.sportswizzleague.biz/images/flags/'+contestant_a1_nationality_code+'.png" alt="">  <span>'+contestant_a1_matchname+'</span></p><p class="score-bord mb-1">'+score_a+':'+score_b+'  </p><p><img width="20" class="mr-2" src="https://olympics.sportswizzleague.biz/images/flags/'+contestant_b1_nationality_code+'.png" alt=""><span>'+contestant_b1_matchname+'</span></p></div>';                 
                            $("#main").empty();
                            $("#main").html(html);


                    }        
                });



            }


            




























            });

            
            

        });
         
         
      </script>
      



















































</body>


</html>




