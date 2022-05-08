@extends('front.master.main')
@section("title", "SportCo| Sportsgram")
@section("meta_description", "Sportsgram is an extensive collection of pictures of sports stars across the globe. Join the SportCo network and share your amazing sports celebrity encounters with the entire world.")

@section('head_extra')
@endsection

@section('content')

    <div class="container">
        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="{{ url('/') }}" class="breadcrumbs__url">Home</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="{{ route("sportsgram") }}" class="breadcrumbs__url">Sportsgram</a>
            </li>


        </ul>
    </div>
    <div class="container">
        <h1 class="page-title">Sportsgram</h1>
        <div class="row">
            <div class="col-lg-8 blog__content mb-72">
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-md-6">
                        <article class="entry card ratio4-3">
                            <div class="entry__img-holder card__img-holder">
                                <a href="{{ url("sportsgram") }}/{{$post->slug}}">
                                    <div class="thumb-container">
                                        <img data-src="{{$post->media_url}}" src="img/empty.png" class="entry__img lazyload" alt="" />
                                    </div>
                                </a>
                                <a href="{{sportsUrl($post->s_name)}}" style="top: 11px;bottom:auto"
                                   class="entry__meta-category entry__meta-category--label entry__meta-category--align-in-corner entry__meta-category--green">{{$post->s_name}}</a>
                                <a href="" style="top: 11px;bottom:auto;right:10px;left:auto"
                                   class="entry__meta-category text-white entry__meta-category--align-in-corner">@if ($post->media_count != 1)<i class="far fa-images"></i> {{$post->media_count}} @endif</a>

                            </div>

                            <div class="entry__body card__body">
                                <div class="entry__header">

                                    <h2 class="entry__title">
                                       {{-- <a href="{{ url("sportsgram") }}/{{$post->slug}}">{{$post->title}}</a>--}}
                                        <a href="{{ url("sportsgram") }}/{{$post->slug}}">{{substr($post->title, 0, 68 )}}</a>
                                    </h2>
                                    <ul class="entry__meta">
                                        <li class="entry__meta-author">
                                            <span>by</span>
                                            <a href="{{ url("profile") }}/{{$post->nickname}}">{{$post->name}}</a>
                                        </li>
                                        <li class="entry__meta-date">
                                            {{ $post->publish_utc  }}
                                        </li>
                                    </ul>
                                </div>
                                <div class="entry__excerpt">
                                    <p>{!! articleLimiter($post->description,80) !!}</p>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>

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


            </div>
            @include("front.partials.right_sidebar")
        </div>
    </div>
@endsection

@section('script_extra')


@endsection
