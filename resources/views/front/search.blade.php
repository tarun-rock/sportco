@extends("front.master.main")

@section("content")

    <div class="main-container container pt-40" id="main-container">

        <!-- Content -->
        <div class="row">

            <!-- Posts -->
            <div class="col-lg-8 blog__content mb-72">
                <h1 class="page-title">Search results for: {{ $term }}</h1>


                @forelse($matches as $match)
                    <article class="entry card post-list">
                        <div class="entry__img-holder post-list__img-holder card__img-holder"
                             style="background-image: url(@if(empty($match['sportsgram_url']))   {{$match['media_url']}} @else {{$match['sportsgram_url']}}@endif)">
                            @if($match['type'] == returnConfig("sportsgramtype"))
                                <a href="{{ url("sportsgram") }}/{{ $match['slug'] }}" class="thumb-url"></a>
                            @else
                                <a href="{{ url("article") }}/{{ $match['slug'] }}" class="thumb-url"></a>
                                @endif
                            <img src="{{$match['media_url']}}" alt="" class="entry__img d-none">
                            <a href="{{ sportsUrl($match['sports_name']) }}"
                               class="entry__meta-category entry__meta-category--label entry__meta-category--align-in-corner entry__meta-category--blue">{{ $match['sports_name'] }}</a>

                        </div>

                        <div class="entry__body post-list__body card__body">
                            <div class="entry__header">
                                <h2 class="entry__title">

                                    @if(empty($match['type']))
                                        <a href="{{ url("play/game/detail") }}/{{ $match['slug'] }}">{{ $match['title'] }}</a>
                                    @elseif($match['type'] == returnConfig("sportsgramtype"))
                                        <a href="{{ url("sportsgram") }}/{{ $match['slug'] }}">{{ $match['title'] }}</a>
                                    @else
                                        <a href="{{ url("article") }}/{{ $match['slug'] }}">{{ $match['title'] }}</a>
                                    @endif

                                </h2>
                                <ul class="entry__meta">
                                    <li class="entry__meta-author">
                                        <span>by</span>
                                        <a href="{{ url("profile") }}/{{ $match['user_nickname'] ?? "1" }}">{{$match['user_name'] ?? 'Admin'}}</a>
                                    </li>
                                    <li class="entry__meta-date">
                                        {{ $match['publish_utc']}}
                                    </li>
                                </ul>
                            </div>
                            <div class="entry__excerpt">
                                <p>{!! articleLimiter($match['description']) !!}</p>
                            </div>
                            <br/>
                            @if(empty($match['type']))

                                <a href="{{ url("play/game/detail") }}/{{ $match['slug'] }}" class="mt-2 btn btn-lg entry__meta-category--green btn-sm">Play Now</a>
                            @endif
                        </div>
                    </article>
                @empty
                    <h3>No results found. Try again!</h3>
                @endforelse


                <?php
                // config
                $link_limit = 5; // maximum number of links (a little bit inaccurate, but will be ok for now)
                ?>

                @if ($matches->lastPage() > 1)
                    <nav class="pagination">
                        <ul class="pagination">
                            <li class="pagination__page {{ ($matches->currentPage() == 1) ? ' disabled' : '' }}">
                                <a class="pagination__page pagination__icon pagination__page--next"
                                   href="{{ $matches->url(1) }}"><i class="ui-arrow-left"></i></a>
                            </li>
                            @for ($i = 1; $i <= $matches->lastPage(); $i++)
                                <?php
                                $half_total_links = floor($link_limit / 2);
                                $from = $matches->currentPage() - $half_total_links;
                                $to = $matches->currentPage() + $half_total_links;
                                if ($matches->currentPage() < $half_total_links) {
                                    $to += $half_total_links - $matches->currentPage();
                                }
                                if ($matches->lastPage() - $matches->currentPage() < $half_total_links) {
                                    $from -= $half_total_links - ($matches->lastPage() - $matches->currentPage()) - 1;
                                }
                                ?>
                                @if ($from < $i && $i < $to)
                                    <li class="pagination__page {{ ($matches->currentPage() == $i) ? ' active' : '' }}">
                                        <a class="pagination__page {{ ($matches->currentPage() == $i) ? ' pagination__page--current' : '' }}"
                                           href="{{ $matches->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endif

                            @endfor
                            <li class="pagination__page pagination__icon pagination__page--next {{ ($matches->currentPage() == $matches->lastPage()) ? ' disabled' : '' }}">
                                <a class="pagination__page pagination__icon pagination__page--next"
                                   href="{{ $matches->url($matches->lastPage()) }}"><i class="ui-arrow-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                @endif


            </div> <!-- end posts -->

            @include("front.partials.right_sidebar")

        </div> <!-- end content -->
    </div> <!-- end main container -->


@endsection