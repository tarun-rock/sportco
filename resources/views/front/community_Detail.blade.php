@extends('front.master.main')
@section('content')

    <main class="main oh pt-40 pb-80" id="main">

        <div class="main-container container" id="main-container">

            <div class="row">
                    <!-- Posts -->
                    <div class="col-lg-8 blog__content mb-72">
                        <h1 class="page-title">RCB Fan Club </h1>

                        <div class="row card-row">
                            @if(!empty($posts->count()))
                            @foreach($posts as $post)
                            <div class="col-md-6">
                                <article class="entry card ratio4-3">
                                    <div class="entry__img-holder card__img-holder">
                                        @if($post->type == returnConfig("sportsgramtype"))
                                            <a href="{{ url("sportsgram") }}/{{$post->slug}}">
                                                @else
                                                    <a href="{{ url("article") }}/{{$post->slug}}">
                                                        @endif
                                            <div class="thumb-container">

                                                <img data-src="@if(empty($post->sportsgram_url)) {{$post->media_url}}@else{{$post->sportsgram_url}}@endif" src="img/empty.png" class="entry__img lazyload" alt="" />
                                            </div>
                                        </a>
                                        <a href="{{ url("sport") }}/{{$post->sports_name }}" class="entry__meta-category entry__meta-category--label entry__meta-category--align-in-corner entry__meta-category--violet">{{$post->sports_name}}</a>
                                    </div>

                                    <div class="entry__body card__body">
                                        <div class="entry__header">

                                            <h2 class="entry__title">

                                                @if($post->type == returnConfig("sportsgramtype"))
                                                    <a href="{{ url("sportsgram") }}/{{$post->slug}}">{{$post->title}} {{$post->type}}</a>
                                                @else
                                                    <a href="{{ url("article") }}/{{$post->slug}}">{{$post->title}}</a>
                                                @endif
                                            </h2>
                                            <ul class="entry__meta">
                                                <li class="entry__meta-author">
                                                    <span>by</span>
                                                    <a href="{{ url("profile") }}/{{$post->user_id}}">{{$post->user_name}}</a>
                                                </li>
                                                <li class="entry__meta-date">
                                                    {{$post->publish_utc}}
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="entry__excerpt">
                                            <p> {!! articleLimiter($post->description,80) !!}</p>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            @endforeach
                                @else
                               <div class="col-12"></div>

                            @endif
                        </div>


                        <!-- Pagination -->

                        @php               // config
$link_limit = 7; // maximum number of links (a little bit inaccurate, but will be ok for now)
                        @endphp
                        @if ($posts->lastPage() > 1)
                            <nav class="pagination d-flex justify-content-center">
                                <ul class="pagination">
                                    <li class="pagination__page {{ ($posts->currentPage() == 1) ? ' disabled' : '' }}">
                                        <a class="pagination__page pagination__icon pagination__page--next" href="{{ $posts->url(1) }}"><i class="ui-arrow-left"></i></a>
                                    </li>
                                    @for ($i = 1; $i <= $posts->lastPage(); $i++)
                                        <?php
                                        $half_total_links = floor($link_limit / 2);
                                        $from = $posts->currentPage() - $half_total_links;
                                        $to = $posts->currentPage() + $half_total_links;
                                        if ($posts->currentPage() < $half_total_links) {
                                            $to += $half_total_links - $posts->currentPage();
                                        }
                                        if ($posts->lastPage() - $posts->currentPage() < $half_total_links) {
                                            $from -= $half_total_links - ($posts->lastPage() - $posts->currentPage()) - 1;
                                        }
                                        ?>
                                        @if ($from < $i && $i < $to)
                                            <li class="pagination__page {{ ($posts->currentPage() == $i) ? ' active' : '' }}">
                                                <a class="pagination__page {{ ($posts->currentPage() == $i) ? ' pagination__page--current' : '' }}" href="{{ $posts->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endif

                                    @endfor
                                    <li class="pagination__page pagination__icon pagination__page--next {{ ($posts->currentPage() == $posts->lastPage()) ? ' disabled' : '' }}">
                                        <a class="pagination__page pagination__icon pagination__page--next" href="{{ $posts->url($posts->lastPage()) }}"><i class="ui-arrow-right"></i></a>
                                    </li>
                                </ul>
                            </nav>
                        @endif
                    </div> <!-- end posts -->

                    <!-- Sidebar -->
                @include("front.partials.right_sidebar")

            </div>


        </div>
    </main> <!-- end main container -->





@endsection