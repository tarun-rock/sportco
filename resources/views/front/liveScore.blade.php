@extends('front.master.main')
@section('head_extra')
    <link href="{{ asset('css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.theme.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">
    <style>
        #owl-posts .owl-item {
            display: block;
            margin: 0 5px;
            text-align: center;
        }
    </style>
    <script>
        var _token = '{{ csrf_token() }}';
    </script>
@endsection

@section('content')
    <br/>
    <br/>

   {{-- @php
        print_r($livematch);die;
    @endphp--}}
    {{--{{$data[]}}--}}
    <div class="container">
        <div class="owl-carousel owl-theme livescoreslider">
            @foreach($data as $item)
                <div class="item @if(in_array($item['cid'], $livematch))live-match @endif">

                    <a class="compititionid d-block" data-id="{{$item['cid']}}" href="javascript:void(0);">
                        <div class="matchlive">
                            <label class="badge badge-warning" style="display: none">Live</label>
                            <img src="@if(empty($item['logo'])) {{asset('images/image-icon.svg')}} @else {{$item['logo']}}@endif"/>
                            <h4> {{$item['cname']}}</h4></div>
                    </a>
                </div>
            @endforeach

            {{--<div class="item">
                <div class="matchlive"><img src="{{asset('images/livescore/img2.png')}}"/><h4>Bundesliga</h4></div>
            </div>
            <div class="item">
                <div class="matchlive"><img src="{{asset('images/livescore/img3.png')}}"/><h4>K league</h4></div>
            </div>
            <div class="item">
                <div class="matchlive"><img src="{{asset('images/livescore/img4.png')}}"/><h4>EPL</h4></div>
            </div>
            <div class="item">
                <div class="matchlive"><img src="{{asset('images/livescore/img5.png')}}"/><h4>PL</h4></div>
            </div>
            <div class="item">
                <div class="matchlive"><img src="{{asset('images/livescore/img6.png')}}"/><h4>UCL</h4></div>
            </div>
            <div class="item">
                <div class="matchlive"><img src="{{asset('images/livescore/img7.png')}}"/><h4>ISL</h4></div>
            </div>
            <div class="item">
                <div class="matchlive"><img src="{{asset('images/livescore/img8.png')}}"/><h4>UEFA</h4></div>
            </div>--}}
        </div>
    </div>
    <br/>
    <br/>

    <style>


    </style>
    <div class="container">
        <div class="bannerlive">
            <img src="{{asset('images/livescore/livebanner.png')}}" class="img-fluid"/>
            <div class="matachdetail">
            <div class="matachdetail-inner" id="livematchdetail">

            </div>
            </div>
        </div>
        <!--  Trivia start here -->
        <div class="trending-now">
        <span class="trending-now__label">
          <i class="ui-flash"></i>
          <span class="trending-now__text d-lg-inline-block d-none">Trivia</span>
        </span>
            <div class="newsticker">
                <div id="triviacontent" class="p-2"></div>
            </div>
            <div class="newsticker-buttons">
                <button class="newsticker-button newsticker-button--prev" id="newsticker-button--prev"
                        aria-label="next article"><i class="ui-arrow-left"></i></button>
                <button class="newsticker-button newsticker-button--next" id="newsticker-button--next"
                        aria-label="previous article"><i class="ui-arrow-right"></i></button>
            </div>
        </div>
        <!--  Trivia end here -->
        <br/>
        <br/>

        <div class="row">
            <div class="col-md-6">
                {{--<div class="container custom" id="liveFootBallScoresDiv">
                </div>--}}
                <h2 class="m-t-2 text-uppercase"> Fixtures</h2>
                <div class="overflowscroll">
                    <table class="table table-striped">
                        {{-- <thead class="thead-dark">
                         <tr>
                             <th colspan="2" scope="col">Previous Week</th>
                             <th colspan="2" class="text-center" scope="col">This Week</th>
                             <th scope="col" class="text-right">Next Week</th>
                         </tr>
                         </thead>--}}
                        <tbody class="fixturedata" id="fixturedata">


                        </tbody>
                    </table>
                </div>
                <br/>
                <br/>
                <div class="widget-game text-center">
                    <h2>
                        How Many consecutive league titles have Bayern Munich now won ?
                    </h2>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="options">
                                <button type="button" class="btn text-dark bg-white pt-2 pb-2 option">d</button>
                                <button type="button"
                                        class="btn text-dark bg-white btn-outline-primary pt-2 pb-2 option">d
                                </button>
                                <button type="button"
                                        class="btn text-dark bg-white btn-outline-primary pt-2 pb-2 option">d
                                </button>
                                <button type="button"
                                        class="btn text-dark bg-white btn-outline-primary pt-2 pb-2 option">d
                                </button>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
            <div class="col-md-6">
                <h2 class="m-t-2 text-uppercase">Point Table</h2>
                <table class="table table-striped" id="matchdataouter">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Team</th>
                        <th scope="col">W</th>
                        <th scope="col">L</th>
                        <th scope="col">PTS</th>
                        <th scope="col">DIFF</th>
                        <th scope="col">For</th>
                        <th scope="col">Against</th>
                        <th scope="col">Draw</th>
                    </tr>
                    </thead>
                    <tbody class="matchdata" id="matchdata">
                    </tbody>
                </table>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="awayHTMl-tab" data-toggle="tab" href="#awayHTMl" role="tab"
                           aria-controls="home" aria-selected="true">Away</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                           aria-selected="false">Home</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="total-tab" data-toggle="tab" href="#total" role="tab"
                           aria-controls="total" aria-selected="false">Total</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="awayHTMl" role="tabpanel" aria-labelledby="awayHTMl-tab">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Team</th>
                                <th scope="col">W</th>
                                <th scope="col">L</th>
                                <th scope="col">PTS</th>
                                <th scope="col">DIFF</th>
                                <th scope="col">For</th>
                                <th scope="col">Against</th>
                                <th scope="col">Draw</th>

                            </tr>
                            </thead>
                            <tbody class="awayteamdata" id="awayteamdata">


                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">

                        <table class="table table-striped">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Team</th>
                                <th scope="col">W</th>
                                <th scope="col">L</th>
                                <th scope="col">PTS</th>
                                <th scope="col">DIFF</th>
                                <th scope="col">For</th>
                                <th scope="col">Against</th>
                                <th scope="col">Draw</th>

                            </tr>
                            </thead>
                            <tbody class="awayteamdata" id="hometeamdata">


                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="total" role="tabpanel" aria-labelledby="total-tab">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Team</th>
                                <th scope="col">W</th>
                                <th scope="col">L</th>
                                <th scope="col">PTS</th>
                                <th scope="col">DIFF</th>
                                <th scope="col">For</th>
                                <th scope="col">Against</th>
                                <th scope="col">Draw</th>

                            </tr>
                            </thead>
                            <tbody class="awayteamdata" id="totalteamdata">


                            </tbody>
                        </table>
                    </div>
                </div>
                {{--<table class="table table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th colspan="2" scope="col">Previous Week</th>
                        <th colspan="2" class="text-center" scope="col">This Week</th>
                        <th scope="col" class="text-right">Next Week</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">Sat</th>
                        <td>30/05/20</td>
                        <td>Freiburg</td>
                        <td>0-1</td>
                        <td>Bayer Levrkusen</td>
                    </tr>

                    </tbody>
                </table>--}}
            </div>
        </div>


        <div class="row">
            <div class="col-lg-23 blog__content mb-72">


            </div>

        </div>
    </div>
@endsection

<!------------- firebase js file start ------------------------->
<script src="{{asset('/firestore/firebase-app.js')}}"></script>
<script src="{{asset('/firestore/firebase-firestore.js')}}"></script>
<!------------- firebase js file end ------------------------->
@section('script_extra')
    <script>

        var config = {
            apiKey: "{{ config("services.liveScore.apiKey") }}",
            authDomain: "{{ config("services.liveScore.authDomain") }}",
            databaseURL: "{{ config("services.liveScore.databaseURL") }}",
            projectId: "{{ config("services.liveScore.projectId") }}",
            storageBucket: "{{ config("services.liveScore.storageBucket") }}",
            messagingSenderId: "{{ config("services.liveScore.messagingSenderId") }}"

            /*apiKey: "NP8tlK02cXSdwyj2vr1CzwcBno12",
            authDomain: "firestore2-b17c4.firebaseapp.com",
            databaseURL: "https://firestore2-b17c4.firebaseio.com",
            projectId: "sportswidgets-31e41",
            storageBucket: "firestore2-b17c4.appspot.com",
            messagingSenderId: "413750519670"*/
        };
        firebase.initializeApp(config);
        const db = firebase.firestore();
        db.settings({
            timestampsInSnapshots: true
        });


        $(document).ready(function () {
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                center: true,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 8
                    }
                }
            })
            AjaxDataSuccess(71)
            $('.compititionid[data-id="71"]').parent().addClass("active-league")


            $('.compititionid').click(function () {
                $('.compititionid').parent().removeClass("active-league")
                $(this).parent().addClass("active-league")
                var compititionId = $(this).attr("data-id");
                AjaxDataSuccess(compititionId)
            })


            function AjaxDataSuccess(compititionId) {
                var spinner = "<h1 class=\"fa fa-spinner fa-spin\"></h1>"
                $('#livematchdetail').html("<h1 class=\"fa fa-spinner text-white fa-spin\"></h1>")
                $('#triviacontent').html("<i class=\"fa fa-spinner fa-spin\"></i>")
                $("#fixturedata").html(spinner);
               // $("#myTab").hide();
                //$("#hometeamdata").html(spinner);
                $("#matchdataouter").hide();

               /* swal({
                    title: 'Please Wait',
                    html: '<h1 class="mt-5 mb-5 fa fa-spinner fa-spin"></h1>',
                    showConfirmButton: false
                });*/
                var url = "{{url('/compititionmatch/')}}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'compititionId': compititionId,
                    },
                    success: function (response) {
                       // console.log(response.matchinfo['sentence'])
                        var livematchbanner,triviaHTMl = "";

                        if(response.matchinfo.length != 0){
                            var res = response.matchinfo

                            insertMatchinfo(res)
                        }else if(response.livematchinfo !=0){
                            var res = response.livematchinfo

                            getLiveMatch(res)

                        }

                        //swal.close();
                        var fixturedata = "";
                        var awayHTMl = "";
                        var totalHTMl = "";
                        var matchHTMl, homeHTMl = "";
                        var resultteamA, resultteamB, livematchTeamA, livematchTeamB = ""
                        var livematchbanner = ""
                        var insertdata;
                        var  matchdate = "";


                        $.each(response.matchfixture, function (key, value) {
                            //console.log(value)

                            var imgUrl1,imgUrl = "";
                            if (!value['teams']['home']['logo']) {
                                imgUrl = "{{asset('images/no-image1.png')}}";
                            }else{
                                imgUrl = value['teams']['home']['logo'];
                            }
                            if (!value['teams']['away']['logo']) {
                                imgUrl1 = "{{asset('images/no-image1.png')}}";
                            }else{
                                imgUrl1 = value['teams']['away']['logo'];
                            }

                            var status = "";
                            if (value['status'] == 1) {
                                matchdate = new Date(value['datestart'])
                                status += "<label class='badge badge-info'>Upcoming</label>"
                            } else if (value['status'] == 2) {

                                matchdate = new Date(value['datestart'])
                                status += "<label class='badge badge-danger'>Completed</label>"

                            } else if (value['status'] == 3) {
                                //$('.compititionid[data-id = '+value['competitionid']+']').addClass("live-match")
                                matchdate = "Today"
                                status += "<label class='badge badge-success'>Live</label>"

                            } else if (value['status'] == 5) {
                                matchdate = new Date(value['datestart'])
                                status += "<label class='badge badge-warning'>Canceled</label>"
                            } else {
                                status += "<label class='badge badge-secondary'>no data</label>"
                            }


                            //var date = new Date(value['datestart']);
                            //var newDate = date.toString('dd-MM-yy');

                            fixturedata += "<tr><td colspan=\"3\" align=\"center\">" + matchdate + "</td></tr><tr class=\"matchclick\" data-matchid="+value['mid']+" data-status="+value['status']+">\n" +
                                "                            <td scope=\"row\" align=\"right\">" + value['teams']['home']['tname'] + "<img width=\"28\" src=" + imgUrl + " /> </td>\n" +
                                "                            <td scope=\"row\" align=\"center\">" + status + "<br/>" + value['result']['home'] + " : " + value['result']['away'] + "</td>\n" +
                                "                            <td scope=\"row\" align=\"left\"><img width=\"28\" src=" + imgUrl1 + " /> " + value['teams']['away']['tname'] + " </td>\n" +
                                "                        </tr>\t"
                        })
                        /*  console.log(livematchbanner.length);
                         if(livematchbanner){
                             console.log("have data")
                         }{
                             console.log("no have data")
                         }*/
                        //console.log(livematchbanner)

                       /* $('.team-a span').html(livematchTeamA)
                        $('.team-b span').html(livematchTeamB)
                        $('.team-a .rank').html(resultteamA)
                        $('.team-b .rank').html(resultteamB)*/


                        $.each(response.matchespoint, function (key, value) {
                            if (value.tables['away']) {
                                insertdata = 1;
                                var away = value.tables['away']
                                var home = value.tables['home']
                                var total = value.tables['total']
                                $.each(away, function (key, value) {
                                    awayHTMl += "<tr><td><img width=\"28\" src=" + value['logo'] + " /> " + value['tname'] + "</td><td>" + value['wintotal'] + "</td><td>" + value['losstotal'] + "</td><td>" + value['pointstotal'] + "</td><td>" + value['goaldifftotal'] + "</td><td>" + value['goalsfortotal'] + "</td><td>" + value['goalsagainsttotal'] + "</td><td>" + value['drawtotal'] + "</td></tr>"
                                })
                                $.each(total, function (key, value) {
                                    totalHTMl += "<tr><td><img width=\"28\" src=" + value['logo'] + " /> " + value['tname'] + "</td><td>" + value['wintotal'] + "</td><td>" + value['losstotal'] + "</td><td>" + value['pointstotal'] + "</td><td>" + value['goaldifftotal'] + "</td><td>" + value['goalsfortotal'] + "</td><td>" + value['goalsagainsttotal'] + "</td><td>" + value['drawtotal'] + "</td></tr>"
                                })
                                $.each(home, function (key, value) {
                                    homeHTMl += "<tr><td><img width=\"28\" src=" + value['logo'] + " /> " + value['tname'] + "</td><td>" + value['wintotal'] + "</td><td>" + value['losstotal'] + "</td><td>" + value['pointstotal'] + "</td><td>" + value['goaldifftotal'] + "</td><td>" + value['goalsfortotal'] + "</td><td>" + value['goalsagainsttotal'] + "</td><td>" + value['drawtotal'] + "</td></tr>"
                                })
                            } else {
                                //console.log(value['name'])
                                $.each(value['tables'], function (key, value) {
                                    matchHTMl += "<tr><td><img width=\"28\" src=" + value['logo'] + " /> " + value['tname'] + "</td><td>" + value['wintotal'] + "</td><td>" + value['losstotal'] + "</td><td>" + value['pointstotal'] + "</td><td>" + value['goaldifftotal'] + "</td><td>" + value['goalsfortotal'] + "</td><td>" + value['goalsagainsttotal'] + "</td><td>" + value['drawtotal'] + "</td></tr>"
                                })
                            }

                        })
                        if (insertdata) {
                            $("#myTab,#myTabContent").show();
                            $("#awayteamdata").html(awayHTMl);
                            $("#hometeamdata").html(homeHTMl);
                            $("#totalteamdata").html(totalHTMl);
                            $("#matchdataouter").hide();
                            $("#matchdata").html("");

                        } else {
                            if (response.matchespoint.length >= 1) {
                                $("#matchdata").html(matchHTMl);
                            } else {
                                $("#matchdata").html("<tr><td colspan='8' align='center'><h2 class='p-3'>No Data Found</h2><tr></td>");
                            }
                            $("#matchdataouter").show();

                            $("#awayteamdata").html("");
                            $("#hometeamdata").html("");
                            $("#totalteamdata").html("");
                            $("#myTab,#myTabContent").hide();
                        }

                        $("#fixturedata").html(fixturedata);


                        //globalData = data;
                        //AjaxDataSuccess(data);

                    },
                    error: function (textStatus, errorThrown) {
                        // console.log(textStatus);
                    }
                });



            }


        })

        function insertMatchinfo(res) {
           // $('#livematchdetail').html("")
            //$('#triviacontent').html("")

            var triviaHTMl,livematchbanner,trivia = "";
            // console.log(res.trivia['sentence']);
            if(res.trivia['sentence']){
                trivia = res.trivia['sentence']
            }else{
                trivia = "No Trivia Found"
            }
            //console.log(res.venue['name'])
            var statusval= "";
            if(res.status == 2){
                statusval = "FT"
            }else if(res.status == 3){
                statusval = "live";
            }
            livematchbanner = "<h2 class=\"team-a\">\n" +
                "                    <span>"+res.home_team_name+"</span>\n" +
                "                    <div class=\"ranks\">"+res.home_goal+"</div>\n" +
                "                </h2><h2 class=\"matchtime\">"+statusval+"</h2>\n" +
                "                <h2 class=\"team-b\">\n" +
                "                    <div class=\"ranks\">"+res.away_goal+"</div>\n" +
                "                    <span>"+res.away_team_name+"</span>\n" +
                "                </h2>"



            triviaHTMl = "<span>"+trivia+"<span> Source:<i class='text-secondary small'>"+res.venue['name']+","+res.venue['location']+"</i></span></span>"
            $('#triviacontent').html(triviaHTMl)
            $('#livematchdetail').html(livematchbanner)

        }

        function getLiveMatch(res) {

            db.collection("footBallLiveScores").doc("matchID"+res.matchId)
                .onSnapshot(function (doc) {
                    var footBallData = doc.data();
                    liveScoreRender(footBallData);
                });
        }
        $(window).bind("load", function() {
            // code here
            $(".matchclick").click(function () {
                  var status = $(this).attr("data-status");
                  var matchid = $(this).attr("data-matchid");
                  if(status == 3){
                      db.collection("footBallLiveScores").doc("matchID"+matchid)
                          .onSnapshot(function (doc) {
                              var footBallData = doc.data();
                              liveScoreRender(footBallData);
                          });
                  }
            })
        });


        function liveScoreRender(footBallData) {
          // console.log(footBallData);
            $('#livematchdetail').html("")
            $('#triviacontent').html("")

            var livematchbanner = '';
            var home_team_name = footBallData.response.items.match_info[0].teams.home.tname;
            var away_team_name = footBallData.response.items.match_info[0].teams.away.tname;
            var home_goal = footBallData.response.items.match_info[0].result.home;
            var away_goal = footBallData.response.items.match_info[0].result.away;
            var status = footBallData.response.items.match_info[0].status;
            var commentary = footBallData.response.items.commentary;
            var venue =  footBallData.response.items.match_info[0].venue;
            var triviaarray = commentary.length-1
            var trivia = commentary[triviaarray];

            var triviaHTMl = "<span>"+trivia.sentence+"<span> Source:<i class='text-secondary small'>"+venue.name+","+venue.location+"</i></span></span>"

            var statusval= "";
            if(status == 2){
                statusval = "FT"
            }else if(status == 3){
                statusval = trivia.time
            }
            livematchbanner = "<h2 class=\"team-a\">\n" +
                "                    <span>"+home_team_name+"</span>\n" +
                "                    <div class=\"ranks\">"+home_goal+"</div>\n" +
                "                </h2><h2 class=\"matchtime\">"+statusval+"</h2>\n" +
                "                <h2 class=\"team-b\">\n" +
                "                    <div class=\"ranks\">"+away_goal+"</div>\n" +
                "                    <span>"+away_team_name+"</span>\n" +
                "                </h2>"



            $('#livematchdetail').html(livematchbanner)
            $('#triviacontent').html(triviaHTMl)

        }
    </script>
    {{--<script src="{{asset('/js/football/footBallLiveScores.js')}}"></script>--}}
@endsection
