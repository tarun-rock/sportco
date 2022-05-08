@extends('front.master.main')
@section("title", "SportCo - Trivia Games and Sports Quizzes | SportCo.")
@section("meta_description", "Play exciting trivia games and sports quizzes and reward your knowledge with SportCo coins. You can use these coins to buy sports merchandise, memorabilia, and even tickets to sporting events.")
@section("meta_image", url('/images/playimg.jpg'))
@section('head_extra')
    <script>
        ga('send', {
            hitType: 'event',
            eventCategory: 'Play',
            eventAction: 'Section Loaded',
            eventLabel: 'Play Section Loaded'
        });
    </script>
@endsection
@section('content')
    <main class="main oh" id="main" style="background:#171821">

        <!-- Hero Slider -->
        <section class="hero-slider-1">
            <div id="flickity-hero" class="carousel-main">
                @foreach($datas as $data)
                    <div class="carousel-cell hero-slider-1__item">
                        <article class="hero-slider-1__entry entry">
                            <div class="hero-slider-1__thumb-img-holder"
                                 style="background-image: url({{$data->media_url}})">
                                <div class="bottom-gradient"></div>
                            </div>
                            <div class="hero-slider-1__thumb-text-holder">
                                <div class="container">

                                    <h2 class="hero-slider-1__entry-title">
                                        <a href="{{ url("play/game/detail",[$data->slug]) }}">{{$data->name}} </a>
                                        <p class="white">{{$data->description}}</p>
                                        {{-- <a href="{{ url("play/game/detail",[$data->slug]) }}" class="btn btn-lg btn-color">Play Now</a>--}}

                                        {{--    @guest
                                                <a href="{{ url("login") }}" class="btn btn-lg btn-color">Login</a>
                                            @endguest--}}

                                        @if(!empty($data->participated))
                                            @if(!empty($game))
                                                @if(!empty($data->completed))
                                                    <a href="{{ url("play/game/detail",[$data->slug]) }}"
                                                       class="btn btn-lg btn-color">play again</a>

                                                @else
                                                    <a href="{{ url("play/game/detail",[$data->slug]) }}"
                                                       class="btn btn-lg btn-color">play now</a>
                                                @endif
                                            @else
                                                <a href="{{ url("play/game/detail",[$data->slug]) }}"
                                                   class="btn btn-lg btn-color">play now</a>
                                            @endif
                                        @else
                                            @if(!empty($data->played) &&  !empty($data->completecount) )
                                                <a href="{{ url("play/game/leaderboard",[$data->slug]) }}"
                                                   class="btn btn-lg btn-color playbtn">LeaderBoard</a>
                                                {{--<a href="{{ route("winnerlist",[$data->slug]) }}"
                                                   class="btn btn-lg btn-color playbtn">Winner LeaderBoard</a>--}}
                                                @else
                                                @if(!empty($game))
                                                    <a href="{{ url("play/game/detail",[$data->slug]) }}"
                                                       class="btn btn-lg btn-color playbtn">Play now</a>
                                                @else
                                                    <a href="{{ url("play/game/detail",[$data->slug]) }}" href="#"
                                                       class="btn btn-lg btn-color">Play now</a>
                                                @endif
                                            @endif

                                        @endif
                                        <p class="mt-2 white">
                                            <small>
                                                <i class="far fa-play-circle mr-1"></i>
                                                Played {{ $data->playcount ?? 0 }} times
                                            </small>
                                        </p>
                                    </h2>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach

            </div> <!-- end flickity -->

            <!-- Slider thumbs -->
            <div class="carousel-thumbs-holder">
                <div class="container">
                    <div id="flickity-thumbs" class="carousel-thumbs">
                        @foreach($datas as $data)
                            <div class="carousel-cell">
                                <div class="carousel-thumbs__item">
                                    <div class="carousel-thumbs__img-holder">
                                        <img src="{{$data->media_url}}" alt="">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section> <!-- end hero slider -->

        <div class="main-container container content-box content-box--pt-108" id="main-container">

        @if(!empty($upcomings->count()))
            <!-- Upcoming Events -->
                <section class="section mb-0 d-none">
                    <div class="title-wrap title-wrap--line title-wrap--pr">
                        <h3 class="section-title">Upcoming Events</h3>
                    </div>
                    <!-- Slider -->
                    <div id="upcoming" class="owl-carousel owl-theme owl-carousel--arrows-outside">

                        @foreach($upcomings as $upcoming)
                            <article class="entry card card--1 ratio4-3">
                                <div class="entry__img-holder card__img-holder">
                                    <a href="{{url('play/game/detail/').'/'.$upcoming->slug}}">
                                        <div class="thumb-container">
                                            <img data-src="{{$upcoming->media_url}}" src="{{$upcoming->media_url}}"
                                                 class="entry__img lazyload" alt=""/>
                                            <div class="entry-date-label">
                                                <div class="entry-date-label__weekday">{{date('D', strtotime($upcoming->start_utc))}}</div>
                                                <div class="entry-date-label__day">{{date('d', strtotime($upcoming->start_utc))}}</div>
                                                <div class="entry-date-label__month">{{date('M', strtotime($upcoming->start_utc))}}</div>

                                            </div>

                                        </div>
                                    </a>
                                </div>

                                <div class="entry__body card__body">
                                    <div class="entry__header">
                                        <ul class="entry__meta">
                                        </ul>
                                        <h2 class="entry__title">
                                            <a href="{{url('play/game/detail/').'/'.$upcoming->slug}}">{{$upcoming->name}}</a>
                                        </h2>
                                        <ul class="entry__meta">
                                            <li class="entry__meta-date">
                                                {{ date("d M Y H:i a", strtotime($upcoming->start_utc)) }}

                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </article>
                        @endforeach


                    </div> <!-- end slider -->

                </section> <!-- end upcoming events -->

        @endif
        {{--@if (Auth::check()) {
            asdf
    @endif--}}
        @if(!empty($recommendedgames))
            <!-- Featured Albums -->
                <section class="section mb-0">
                    <div class="title-wrap title-wrap--line title-wrap--pr">
                        <h3 class="section-title">Recommended Games</h3>
                    </div>

                    <!-- Slider -->
                    <div id="recommendedgames"
                         class="owl-carousel owl-slider-custom owl-theme owl-carousel--arrows-outside">

                        @foreach($recommendedgames as $key => $recommendedgame)




                            <article class="entry thumb thumb--size-2 pb-4  ">
                                <div class="entry__img-holder thumb__img-holder"
                                     style="background-image: url('{{$recommendedgame->media_url}}');">
                                    <a href="{{sportsUrl("")}}{{$recommendedgame->s_name}}"
                                       style="top: 11px;bottom:auto"
                                       class="entry__meta-category entry__meta-category--label entry__meta-category--align-in-corner entry__meta-category--green">{{ $recommendedgame->s_name }}</a>
                                    <a class="full--link"
                                       href="{{url('play/game/detail/').'/'.$recommendedgame->slug}}"> </a>
                                    <div class="bottom-gradient"></div>
                                    <div class="thumb-text-holder">
                                        <h2 class="thumb-entry-title">
                                            {{$recommendedgame->g_name}}
                                            <br/>
                                            <strong class="small">@if($recommendedgame->entry != "0.00") {{ $recommendedgame->entry }}
                                                Tokens @else Play for free @endif</strong><br/>

                                        </h2>
                                    </div>

                                </div>

                                <small class="mt-2 d-block"><i
                                            class="far fa-play-circle mr-1"></i> {{ $recommendedgame->playcount ?? 0 }}
                                </small>

                            </article>
                            @if ($key === 5)
                                @break
                            @endif
                        @endforeach

                    </div> <!-- end slider -->

                </section> <!-- end featured albums -->
        @endif


        @if(!empty($livecontests->count()))
            <!-- Featured Albums -->
                <section class="section mb-0">
                    <div class="title-wrap title-wrap--line title-wrap--pr">
                        <h3 class="section-title">Popular Games</h3>
                    </div>

                    <!-- Slider -->
                    <div id="owl-posts" class="owl-carousel owl-slider-custom owl-theme owl-carousel--arrows-outside">

                        @foreach($livecontests as $livecontest)




                            <article class="entry thumb thumb--size-2 pb-4  ">
                                <div class="entry__img-holder thumb__img-holder"
                                     style="background-image: url('{{$livecontest->media_url}}');">
                                    <a href="{{sportsUrl("")}}{{ $livecontest->sport }}" style="top: 11px;bottom:auto"
                                       class="entry__meta-category entry__meta-category--label entry__meta-category--align-in-corner entry__meta-category--green">{{ $livecontest->sport }}</a>
                                    <a class="full--link"
                                       href="{{url('play/game/detail/').'/'.$livecontest->slug}}"></a>
                                    <div class="bottom-gradient"></div>
                                    <div class="thumb-text-holder">
                                        <h2 class="thumb-entry-title">
                                            {{$livecontest->name}}
                                            <br/>
                                            <strong class="small">@if($livecontest->entry != "0.00") {{ $livecontest->entry }}
                                                Tokens @else Play for free @endif</strong><br/>
                                        </h2>
                                    </div>
                                </div>

                                <small class="mt-2 d-block"><i
                                            class="far fa-play-circle mr-1"></i> {{ $livecontest->playcount ?? 0 }}
                                </small>

                            </article>
                        @endforeach

                    </div> <!-- end slider -->

                </section> <!-- end featured albums -->

            @endif
            @if(!empty($myContest->count()))

                <section class="section mb-0">
                    <div class="title-wrap title-wrap--line title-wrap--pr">
                        <h3 class="section-title">Played</h3>
                    </div>

                    <!-- Slider -->
                    <div id="my-games" class="owl-carousel owl-theme owl-carousel--arrows-outside">

                        @foreach($myContest as $mine)
                            <article class="pb-4 entry thumb thumb--size-1">
                                <div class="entry__img-holder thumb__img-holder"
                                     style="background-image: url('{{$mine->media_url}}');">
                                    <a href="{{sportsUrl("")}}{{ $mine->sport }}" style="top: 11px;bottom:auto"
                                       class="entry__meta-category entry__meta-category--label entry__meta-category--align-in-corner entry__meta-category--green">{{ $mine->sport }}</a>
                                    <a class="full--link" href="{{url('play/game/detail/').'/'.$mine->slug}}"></a>
                                    <div class="bottom-gradient"></div>
                                    <div class="thumb-text-holder">
                                        <h2 class="thumb-entry-title">
                                            {{$mine->name}}
                                            <br/>
                                            <strong class="small">@if($mine->entry != "0.00") {{ $mine->entry }}
                                                Tokens @else Play for free @endif</strong>
                                        </h2>
                                    </div>
                                </div>
                                <small class="mt-2 d-block"><i
                                            class="far fa-play-circle mr-1"></i> {{ $mine->playcount ?? 0 }}</small>
                            </article>
                        @endforeach

                    </div> <!-- end slider -->

                </section>

            @endif

        </div> <!-- end main container -->
    </main> <!-- end main-wrapper -->




    {{--@auth
        @if(!empty($data->participated))

            @if(!empty($game))
                <a href="{{ route("playGameQuiz",[$data->id]) }}" class="btn btn-lg btn-color">play
                    now</a>
            @else
                <a href="{{ route("playContestQuiz",[$data->id]) }}" class="btn btn-lg btn-color">play
                    now</a>
            @endif
        @else

            @if(!empty($game))
                            <a href="{{ route("enterGame",[$data->id]) }}" href="#"
                               class="btn btn-lg btn-color">Play
                                now</a>
                        @else
                            <a href="{{ route("enterContest",[$data->id]) }}" href="#"
                               class="btn btn-lg btn-color">Play
                                now</a>
                        @endif
                    @endif
                @endauth--}}




@endsection
@section('script_extra')
    <script>
        $(document).ready(function () {

            /* $('.playbtn').click(function () {
                 var dataid = $(this).data("id");
                 var url =  '{{ url('play/game/enter') }}';
                                var datatoken = $(this).data("token");
                                $('#tokenreq').html(datatoken  + " Token")
                                $('#playnow').attr("href", url +"/" + dataid)
                            });*/

            $(".upcoming .entry__meta-date").each(function () {
                //$(this).html(moment($(this).html()).fromNow());
                var date = $(this).html().replace(/[\s\n\r]+/g, ' ');
                // var a = moment(date);
                // var b = moment();
                $(this).html(date);


            });

            $("#upcoming").owlCarousel({
                center: false,
                loop: false,
                nav: true,
                dots: false,
                lazyLoad: true,
                navSpeed: 500,
                navText: ['<i class="ui-arrow-left">', '<i class="ui-arrow-right">'],
                responsive: {
                    768: {
                        items: 3
                    },
                    540: {
                        items: 3
                    }
                }

            });


            // Posts Carousel

            $(".owl-slider-custom").owlCarousel({
                center: false,
                items: 1,
                loop: false,
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

            // Posts Carousel
            $("#my-games").owlCarousel({
                center: false,
                items: 1,
                loop: false,
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