

    @foreach ($data as $d)
        <article class="entry card post-list l_post">




            <div class="entry__img-holder post-list__img-holder card__img-holder lazy" data-src="@if (empty($d->sportsgram_url))  {{$d->media_url}} @else {{$d->sportsgram_url}} @endif">
                @if (empty($d->sportsgram_url))
                    <a href="{{ url("article") }}/{{ $d->slug }}" class="thumb-url"></a>
                @else
                    <a href="{{ url("sportsgram") }}/{{ $d->slug }}" class="thumb-url"></a>
                @endif

                <img data-src="@if (empty($d->sportsgram_url))  {{$d->media_url}} @else {{$d->sportsgram_url}} @endif" alt="" src="{{asset('img/empty.png')}}" class="entry__img d-none">
            </div>

            <div class="entry__body post-list__body card__body">
                <div class="entry__header">
                    <h2 class="entry__title">
                        @if (empty($d->sportsgram_url))
                            <a href="{{ url("article") }}/{{ $d->slug }}">{{$d->title}}</a>
                        @else

                            <a href="{{ url("sportsgram") }}/{{ $d->slug }}">{{$d->title}}</a>
                        @endif

                    </h2>
                    <ul class="entry__meta">
                        <li class="entry__meta-author">
                            <span>by</span>
                            <a href="{{ url("profile") }}/{{ $d->user_id }}">{{$d->user_name}}</a>
                        </li>
                        <li class="entry__meta-date">
                            {{ $d->publish_utc  }}

                        </li>
                    </ul>
                </div>
                <div class="entry__excerpt">

                    <p>{!! articleLimiter($d->description) !!}</p>
                </div>
            </div>
        </article>
    @endforeach



    <div id="c_nav" >
        {{ $data->links() }}
    </div>