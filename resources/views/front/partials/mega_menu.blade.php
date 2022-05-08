{{--
@php
    $sportsTotal = getSports();
    $sports = $sportsTotal->slice(0, 4);
@endphp
@foreach($sports as $sport)
    <li class="nav__dropdown">
        <a href="#">{{ $sport->name }}</a>
        <ul class="nav__dropdown-menu nav__megamenu">
            <li>
                <div class="nav__megamenu-wrap">
                    <div class="row">

                        @php $posts = menuPosts($sport->id) @endphp

                        @forelse($posts as $post)
                            <div class="col nav__megamenu-item">
                                <article class="entry">
                                    <div class="entry__img-holder">
                                        <a href="{{ url("article") }}/{{ $post->slug }}">
                                            <img src="{{$post->media_url}}" alt=""
                                                 class="entry__img">
                                        </a>
                                        <a href="{{ sportsUrl($post->sports_name) }}"
                                           class="entry__meta-category entry__meta-category--label entry__meta-category--align-in-corner entry__meta-category--violet">{{ $post->sports_name }}</a>
                                    </div>

                                    <div class="entry__body">
                                        <h2 class="entry__title">
                                            <a href="{{ url("article") }}/{{ $post->slug }}">{{ $post->title }}</a>
                                        </h2>
                                    </div>
                                </article>
                            </div>
                        @empty
                            <center>No content available!</center>
                        @endforelse

                    </div>
                </div>
            </li>
        </ul> <!-- end megamenu -->
    </li>
@endforeach
@php $remainings = $sportsTotal->slice(4, $sportsTotal->count()); @endphp
@if(!empty($remainings->count()))
    <li class="nav__dropdown">
        <a href="#">More Sports</a>
        <ul class="nav__dropdown-menu">
            @foreach($remainings as $remaining)
                <li><a href="{{ sportsUrl($remaining->name) }}">{{ $remaining->name }}</a></li>
            @endforeach
        </ul>
    </li>
@endif--}}
{!! menuOptionsFetch() !!}