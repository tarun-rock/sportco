@extends('front.master.main')
@section("title", "SportCo Winner List")
@section('head_extra')
@endsection
@section('content')
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
                                    <a href="javascripit:void(0)">{{ $rankers->first()->game_name }}</a>
                                    <p class="white">
                                        {{ $rankers->first()->game_description }}
                                    </p>


                                </h2>
                            </div>
                        </div>
                    </article>
                </div>
            </div> <!-- end flickity -->
        </section> <!-- end hero slider -->
        <div class="main-container container content-box content-box--pt-90" id="main-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between">
                        <div><h3 class="scrolldiv text-uppercase">Winner LeaderBoard</h3></div>
                    </div>
                </div>
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
                                <td>{{ $key + 1 }}</td>
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
        </div> <!-- end main container -->
    </main> <!-- end main-wrapper -->
@endsection
@section('script_extra')

@endsection