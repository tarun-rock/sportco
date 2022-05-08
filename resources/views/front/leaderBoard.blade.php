@extends('front.master.main')
@section("title", "SportCo Play")
@section("meta_description", "Play quizzes, games and contests on your favourite sports. Win Sportco Tokens!")

@section('head_extra')
    @if(!empty(session()->has('first_game_finished')))
        <script>


            ga('send', {
                hitType: 'event',
                eventCategory: 'Play',
                eventAction: 'First Game Finished',
                eventLabel: 'Play First Game Finished'
            });
        </script>
        {{session()->forget('first_game_finished')}}
    @endif
@endsection
@section('content')
    @php
        $currentUrl = url('/play');
        $sharedata = "Can you beat my rank 5th point $gamestats->correct_ans_count and timing $gamestats->time. Challenge me now"
    @endphp

    <main class="main oh" id="main" style="background:#171821">

        <!-- Hero Slider -->
        <section class="hero-slider-1">
            <div id="flickity-hero" class="carousel-main">
                <div class="carousel-cell hero-slider-1__item">
                    <article class="hero-slider-1__entry entry">
                        <div class="hero-slider-1__thumb-img-holder"
                             style="background-image: url({{ $rankers->first()->media_url }})">
                            <div class="bottom-gradient"></div>
                        </div>
                        <div class="hero-slider-1__thumb-text-holder">
                            <div class="container">
                                <h2 class="hero-slider-1__entry-title">
                                    <a href="javascript:void(0);">{{ $rankers->first()->game_name }}</a>
                                    <p class="white">
                                        {{ $rankers->first()->game_description }}
                                    </p>
                                    <div class="mt-3">
                                        <p><strong class="text-white">Share On</strong>
                                            <a class="social social-facebook rounded-circle"
                                               href="http://www.facebook.com/sharer.php?u={{ $currentUrl }}&message={{ rawurlencode($sharedata) }}"
                                               title="facebook" target="_blank" aria-label="facebook">
                                                <i class="ui-facebook"></i>
                                            </a>
                                            <a class="social social-twitter rounded-circle"
                                               href="http://twitter.com/share?&text={{ rawurlencode($sharedata) }}&url={{ $currentUrl }}"
                                               title="twitter" target="_blank" aria-label="twitter"><i
                                                        class="ui-twitter"></i></a>
                                            <a class="social social-google-plus rounded-circle"
                                               href="https://plus.google.com/share?url={{ $currentUrl }}"
                                               title="google" target="_blank" aria-label="google"><i
                                                        class="ui-google"></i></a>
                                            <a class="social social-pinterest rounded-circle"
                                               href="//pinterest.com/pin/create/%20button?url=={{ $currentUrl }}&amp;media={{$rankers->first()->media_url}}&amp;description={{ rawurlencode($sharedata) }}"
                                               data-pin-do="buttonPin" data-pin-custom="true" title="pinterest"
                                               target="_blank" aria-label="pinterest"><i
                                                        class="ui-pinterest"></i></a>
                                        </p>
                                    </div>

                                </h2>
                            </div>
                        </div>
                    </article>
                </div>



            </div> <!-- end flickity -->


        </section> <!-- end hero slider -->

        <div class="main-container container content-box content-box--pt-90" id="main-container">

            <ul class="row lateststats">
                <li class="col-md-2 col-sm-6">
                    <img src="{{asset(url('/images/Questions.svg'))}}"/>
                    <span>Questions Played</span>
                    <h5>{{$gamestats->ques_count ?? 0}}</h5>
                </li>
                <li class="col-md-2 col-sm-6">
                    <img src="{{asset(url('/images/right.svg'))}}"/>
                    <span>Answers Correct</span>
                    <h5>{{$gamestats->correct_ans_count}}</h5>
                </li>
                <li class="col-md-2 col-sm-6">
                    <img src="{{asset(url('/images/wrong.svg'))}}"/>
                    <span>Answers Wrong</span>
                    <h5>{{($gamestats->ques_count - $gamestats->correct_ans_count )}}</h5>
                </li>
                <li class="col-md-2 col-sm-6">
                    <img src="{{asset(url('/images/time.svg'))}}"/>
                    <span>Total Time</span>
                    <h5 class="timeinfo">{{$gamestats->time}}<br/>

                    </h5>
                </li>
                <li class="col-md-2 col-sm-6">
                    <img src="{{asset(url('/images/points.svg'))}}"/>
                    <span>Points</span>
                    <h5>{{$gamestats->correct_ans_score}}</h5>
                </li>
                <li class="col-md-2 col-sm-6">
                    <img src="{{asset(url('/images/rank.svg'))}}"/>
                    <span>Rank</span>
                    <h5 class="saverank"></h5>
                </li>

            </ul>
            <br/>


            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between">
                        <div><h3 class="scrolldiv text-uppercase">LeaderBoard</h3></div>
                        {{--<div>@if(!empty($gameID)) <a href="{{ url('/play/game/leaderboard') }}" class="btn btn-primary btn-color btn-sm">Overall</a> @endif</div>--}}
                    </div>
                </div>

                {{--<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>--}}
                <div class="table-wrapper-scroll-y customtable table-responsive">
                    <table class="table mt-3">
                        <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Name</th>
                            <th>Score</th>
                            <th>Time</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                    </table>

                    <table class="table mt-3 ranktable">

                        <tbody>
                        <?php $found = 0; ?>
                        @foreach($rankers as $key => $rank)
                            <tr @if($key < 3) style="color: black;" @endif>
                                <td>{{ $key + 1 }}
                                    @if(( $rank->id  == Auth::user()->id ) && (empty($found)) && empty($rcbUser))
                                        <?php $found = 1; ?>
                                        <label class="badge badge-primary">Top</label>
                                    @endif
                                    @if((!empty($latestplay)) && $latestplay['updated_at'] == $rank->updated_at  && !empty($rcbUser))
                                        <label class="text-danger" id="lastestrank" data-id="{{ $key + 1 }}">*</label>
                                    @endif
                                    @if((!empty($latestplay)) && $latestplay['updated_at'] == $rank->updated_at  && empty($rcbUser))
                                        <label class="badge badge-primary" id="lastestrank" data-id="{{ $key + 1 }}">Latest </label>
                                    @endif
                                </td>
                                <td>{{ $rank->name }}</td>
                                <td>{{ $rank->score }} Pts</td>
                                <td>{{ $rank->time }} secs</td>
                                <td>{{ date("d M Y H:i:s",strtotime($rank->updated_at)) }}</td>
                            </tr>
                        @endforeach
                        @if($latestplayadd == 1 )

                            <tr>
                                <td>
                                    {{ $key + 2}}
                                    @if(empty($rcbUser)) <label class="badge badge-primary">Latest</label>@endif
                                    @if($sameentry == 1 && empty($rcbUser))<label class="badge badge-primary">Top</label>@endif
                                    @if(!empty($rcbUser))
                                        <label class="text-danger" id="lastestrank" data-id="{{ $key + 1 }}">*</label>
                                    @endif
                                </td>
                                <td>{{ $latestplay['name'] }}</td>
                                <td>{{ $latestplay['score'] }} Pts</td>
                                <td>{{ $latestplay['time'] }} secs</td>
                                <td>{{ date("d M Y H:i:s",strtotime($latestplay['updated_at'])) }}</td>

                            </tr>
                        @endif
                        @if($topscoreactive == 1 /*&& $sameentry == 1*/)
                            <tr>
                                <td>{{ $key + 3}} @if(empty($rcbUser))<label class="badge badge-primary">Top</label>@endif</td>
                                <td>{{ $topscore['name'] }} </td>
                                <td>{{ $topscore['score'] }} Pts</td>
                                <td>{{ $topscore['time'] }} secs</td>
                                <td>{{ date("d M Y H:i:s",strtotime($topscore['updated_at'])) }}</td>
                            </tr>
                        @endif


                        </tbody>
                    </table>
                </div>
            </div>


            <section class="section related-posts mt-40 mb-0">
                <div class="title-wrap title-wrap--line title-wrap--pr">
                    <h3 class="section-title">Play More</h3>
                </div>
                <div class="row">
                    @foreach ($quizs as $quiz)
                        <div class="col-md-4">
                            <article class="entry thumb thumb--size-1">
                                <div class="entry__img-holder thumb__img-holder"
                                     style="background-image: url('{{$quiz->media_url}}');">
                                    <div class="bottom-gradient"></div>
                                    <div class="thumb-text-holder">
                                        <h2 class="thumb-entry-title">
                                            <a href="{{ url("play/game/detail",[$quiz->slug ]) }}">{{$quiz->name}}</a>
                                        </h2>
                                    </div>
                                    <a href="{{ url("play/game/detail",[$quiz->slug ]) }}" class="thumb-url"></a>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>


            </section> <!-- end Play -->


        </div> <!-- end main container -->
    </main> <!-- end main-wrapper -->




@endsection
@section('script_extra')
    <script>

        @if (session()->has('onetime_play_tokens'))
        /*swal({
            title: "Congratulations",
            text: "you have earned  {{--{{$rankers->first()->completion_token}} --}}tokens to play this game",
            type: "success",
        })*/
        {{session()->forget('onetime_play_tokens')}}

        @endif
        $(window).on('load', function () {
            $('html,body').animate({
                    scrollTop: $(".scrolldiv").offset().top
                },
                '1000');
        });
        $(window).bind("load", function () {
            /*.ranktable*/
            $rank = $("#lastestrank").data("id");
            $('.saverank').html($rank)
        });
        $(document).ready(function () {
            $('#flickity-hero').flickity({
                cellAlign: 'left',
                contain: true,
                pageDots: false,
                prevNextButtons: false,
                draggable: false
            });
            // Posts Carousel
            $("#owl-posts").owlCarousel({
                center: false,
                items: 1,
                loop: true,
                nav: true,
                dots: false,
                margin: 30,
                lazyLoad: true,
                navSpeed: 500,
                navText: ['<i class="ui-arrow-left">', '<i class="ui-arrow-right">'],
                responsive: {
                    768: {
                        items: 4
                    },
                    540: {
                        items: 3
                    }
                }
            });
        })


    </script>

@endsection