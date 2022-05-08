@extends('front.master.main')
@section("title", "SportCo Play")
@section("meta_description", "$data->description")
@section("meta_image", "$data->media_url")
@section("content")
    @php $currentUrl = url()->current(); @endphp
    <main class="main oh" id="main" style="background:#171821">

        <!-- Hero Slider -->
        <section class="hero-slider-1">
            <div id="flickity-hero" class="carousel-main">

                <div class="carousel-cell hero-slider-1__item">
                    <article class="hero-slider-1__entry entry">
                        <div class="hero-slider-1__thumb-img-holder"
                             style="background-image: url({{$data->media_url}})">
                            <div class="bottom-gradient"></div>
                        </div>
                        <div class="hero-slider-1__thumb-text-holder">
                            <div class="container">
                                <h2 class="hero-slider-1__entry-title">
                                    <a href="javascript:void(0);">{{ $data->name }}</a>
                                    <p class="white">{{ $data->description }}</p>
                                </h2>
                                @guest
                                    <a href="{{ url("login") }}" class="btn btn-lg btn-color">Login</a>
                                @endguest
                                @auth

                                    @if(!empty($detail))

                                        @if(!empty($data->participated))
                                        
                                            @if(!empty($game))
                                                @if(!empty($data->completed))
                                                    @if(!empty($data->played) &&  !empty($data->completed) )
                                                        <a href="{{ url("play/game/leaderboard",[$data->slug]) }}"
                                                           class="btn btn-lg btn-color playbtn">LeaderBoard</a>
                                                    @else
                                                        <a href="{{ route("playGameQuiz",[$data->slug]) }}"
                                                           class="btn btn-lg btn-color">play again</a>
                                                    @endif

                                                @else
                                                        <a onclick="ga('send', 'event', 'Play', 'Game Started', 'Play Game Started',{NonInteraction : 1})" href="{{ route("playGameQuiz",[$data->slug]) }}"
                                                           class="btn btn-lg btn-color">play now</a>

                                                @endif
                                            @else
                                                <a onclick="ga('send', 'event', 'Play', 'Game Started', 'Play Game Started',{NonInteraction : 1})" href="{{ route("playContestQuiz",[$data->slug]) }}"
                                                   class="btn btn-lg btn-color">play now</a>
                                            @endif
                                        @else
                                            @if(!empty($game))

                                                @if($data->start_utc < currentTime())
                                                    <a onclick="ga('send', 'event', 'Play', 'Game Started', 'Play Game Started',{NonInteraction : 1})" {{--href="{{ route("enterGame",[$data->id]) }}"--}}href="{{ route("enterGame",[$data->slug]) }}"
                                                       class="btn btn-lg btn-color playbtn">Play now </a>
                                                @else

                                                    {{--<a href="javascript:void(0)"
                                                       class="btn btn-lg btn-color playbtn disabled">Starts {{  \Carbon\Carbon::parse($data->start_utc)->diffForHumans() }}</a>--}}
                                                @endif
                                            @else
                                                <a onclick="ga('send', 'event', 'Play', 'Game Started', 'Play Game Started',{NonInteraction : 1})" href="{{ route("enterContest",[$data->slug]) }}" href="#"
                                                   class="btn btn-lg btn-color">Play now</a>
                                            @endif
                                        @endif
                                    @else
                                    
                                    @endif    
                                

                                @endauth
                                <div class="mt-3">
                                    <strong class="text-white">Share On</strong>
                                    <a class="social social-facebook rounded-circle"
                                       href="http://www.facebook.com/sharer.php?u={{ $currentUrl }}"
                                       title="facebook" target="_blank" aria-label="facebook">
                                        <i class="ui-facebook"></i>
                                    </a>
                                    <a class="social social-twitter rounded-circle"
                                       href="http://twitter.com/share?&text=SportCo Play&url={{ $currentUrl }}"
                                       title="twitter" target="_blank" aria-label="twitter"><i
                                                class="ui-twitter"></i></a>
                                    <a class="social social-google-plus rounded-circle"
                                       href="https://plus.google.com/share?url={{ $currentUrl }}"
                                       title="google" target="_blank" aria-label="google"><i
                                                class="ui-google"></i></a>
                                    <a class="social social-pinterest rounded-circle"
                                       href="//pinterest.com/pin/create/%20button?url=={{ $currentUrl }}&amp;media={{$data->media_url}}&amp;description=SportCo Play"
                                       data-pin-do="buttonPin" data-pin-custom="true" title="pinterest"
                                       target="_blank" aria-label="pinterest"><i
                                                class="ui-pinterest"></i></a>
                                </div>
                            </div>

                        </div>
                </div>
                </article>
            </div>
            </div> <!-- end flickity -->


        </section> <!-- end hero slider -->

        <div class="main-container container content-box " id="main-container">


            <div class="tabs">
                <ul class="tabs__list">
                    <li class="tabs__item tabs__item--active">
                        <a href="#tab-1" class="tabs__url tabs__trigger">About Game </a>
                    </li>

                    <li class="tabs__item">
                        <a href="#tab-2" class="tabs__url tabs__trigger">LeaderBoard
                        </a>
                    </li>

                </ul> <!-- end tabs -->
            </div>
            <!-- tab content -->
            <div class="tabs__content tabs__content-trigger">
                <div class="tabs__content-pane tabs__content-pane--active" id="tab-1">
                    <h2 class="text-uppercase">{{ $data->name }}</h2>
                    <p>{{ $data->description }}</p>
                    <br/>

                    <span class=""><i class="fas fa-angle-double-right"></i> Entry Fee - <b style="color: #000;">
                            @if($data->entry != "0.00") {{ $data->entry }} Tokens @else Play for free @endif</b>
                            </span>


                </div>

                <div class="tabs__content-pane" id="tab-2">

                    @if(Auth::check())
                        @if(empty($data->participated))
                            <div class="text-center pt-5 pb-5">
                                <h3>Your have to Enter Game First</h3>

                            </div>
                        @else

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between">
                                        <div><h3 class="scrolldiv">Leader Board </h3></div>
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

                                    <table class="table mt-3">

                                        <tbody>
                                        <?php $found = 0; ?>
                                        @foreach($rankers as $key => $rank)
                                            <tr @if($key < 3) style="color: black;" @endif>
                                                <td>{{ $key + 1 }}


                                                    @if(( $rank->id  == Auth::user()->id ) && (empty($found)))
                                                        <?php $found = 1; ?>
                                                        <label class="badge badge-primary">Top</label>
                                                    @endif
                                                    @if((!empty($latestplay['g_id'])) && $latestplay['g_id'] == $rank->g_id)
                                                        <label class="badge badge-primary">Latest</label>
                                                    @endif
                                                </td>
                                                <td>{{ $rank->name }}</td>
                                                <td>{{ $rank->score }} Pts</td>
                                                <td>{{ $rank->time }} secs</td>
                                                <td>{{ date("d M Y H:i:s",strtotime($rank->updated_at)) }}</td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif


                    @else

                        <div class="text-center pt-5 pb-5">
                            <h3>You need to Login to view leaderboard</h3>
                            <a href="{{ route('login') }}" class="btn btn-primary btn-color">Login</a>
                        </div>

                </div>

                @endif

            </div>
        </div> <!-- end main container -->
    </main> <!-- end main-wrapper -->
@endsection