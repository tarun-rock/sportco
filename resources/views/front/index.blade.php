@extends("front.master.main")
@section('head_extra')

    <!-- Owl Carousel Assets -->
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
@endsection
@section("title", "SportCo - One-stop Digital Platform for Diehard Sports Fans.")
@section("meta_description", "Delivering great digital sport experiences and bringing enthusiastic sports lovers on a single platform. Create sports content, play games and make money from your love for sports.")

@section("content")

{{-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- sportco-ad-1200x150 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6239837178715306"
     data-ad-slot="2124243802"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script> --}}
    @php $time = dateTime() @endphp
    <!-- Trending Now -->

    <div class="container">
        @auth
            <div class="col">
                <br/>
            </div>
            @if(empty($userpost))
                <div class="homebanner_outer homebanner2" style="background:url({{url('/images/banner2.jpg')}});">
                    <div class="text-uppercase align-self-center b2-slide">
                        <h1 class="mb-0" style="color:#00adef">Write More.&nbsp;&nbsp;Earn More.&nbsp;&nbsp;Enjoy
                            More.</h1>
                        <h4 class="text-white mb-4">Publish your post & earn sportco tokens</h4>
                        <a href="{{ url('post') }}" class="btn btn-color-primary text-uppercase ">
                            <img src="{{url('images/icon-05.png')}}" width="15" class="align-middle"/>
                            <strong class="align-middle">New Post</strong>
                        </a>
                    </div>
                </div>
            @endif

            @if(!empty($userpost))

                <div class="homebanner_outer homebanner3" style="background:url({{url('/images/banner3.jpg')}});">
                    <div class="row">
                        <div class="col-md-4 bn3-slide1">
                            <h4 class="text-white text-uppercase">Share Articles on your Favorite sport</h4>
                            <a href="{{ url('post') }}" class="btn btn-color-primary btn-sm text-uppercase">New Post</a>
                        </div>
                        <div class="col-md-4 bn3-slide2">
                            <h4 class="text-white text-uppercase">Live the virtual sports life</h4>
                            <a href="{{ route('play-game') }}"
                               class="btn btn-color-primary btn-sm text-uppercase">play</a>
                        </div>
                        <div class="col-md-4 bn3-slide3">
                            <h4 class="text-white text-uppercase">Buy exclusive sports merchandise</h4>
                            <a href="{{ route('store') }}" class="btn btn-color-primary btn-sm text-uppercase">Store</a>
                        </div>
                    </div>
                </div>
            @endif
        @endauth
        @guest
            <div class="col">

                <br/>
            </div>
            <div class="homebanner_outer" style="background:url({{url('/images/bg.jpg')}});">
                <div class="d-none d-md-block d-lg-none d-lg-block">
                    <div class="homebanner d-flex animated slideInLeft">
                        <div class="animated slideInRight slides">
                            <img src="{{url('images/bannerslide-1.png')}}" alt="Los Angeles" width="450" height="600">
                        </div>
                        <div class="animated fadeIn delay-1s faster slides slides-2">
                            <img src="{{url('images/bannerslide-2.png')}}" alt="Chicago" width="450" height="600">
                        </div>
                        <div class="animated delay-2s faster fadeInRight slides slides-3">
                            <img src="{{url('images/bannerslide-3.png')}}" alt="New York" width="450" height="600">
                        </div>
                        <div class="animated fadeIn slides slides-4 align-self-stretch">
                            <div class="banner-text">
                                <div class="animated fadeIn delay-1s fadeOut firstslide"><h1>Step 1</h1></div>
                            </div>
                            <div class="banner-text">
                                <div class="animated delay-1s faster fadeIn secondslide"><h1>Step 2</h1></div>
                            </div>
                            <div class="banner-text thirdslide">
                                <div class="animated delay-2s faster fadeIn"><h1>Step 3</h1></div>
                            </div>
                            <div class="banner-text last-slide">
                                <div class="animated text-uppercase" style="opacity: 0;">
                                    <h1>Join the First ever Digital Sports hub now!</h1>
                                    <div class="justify-content-between">
                                        <a href="{{ route('register') }}" class="btn btn-color"><i
                                                    class="fas fa-user-edit"></i> Register</a>
                                        <a href="{{ route('login') }}" class="btn btn-color"><i
                                                    class="fas fa-sign-in-alt"></i> Login</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="mobilebanner hidden-lg d-block d-sm-block d-md-none">
                    <div class="d-flex justify-content-between mobileslide">
                        <h2><img src="{{url('/images/bannericon.png')}}" width="70"/> Write Articles</h2>
                        <h2><img src="{{url('/images/bannericon2.png')}}" width="70"/> Play Games</h2>
                    </div>
                    <div class="d-flex justify-content-center mobileslide">
                        <h2><img src="{{url('/images/bannericon3.png')}}" width="70"/> Earn SportCo Tokens</h2>
                    </div>
                    <div class="d-flex justify-content-between mobileslide">
                        <h2><img src="{{url('/images/bannericon4.png')}}" width="70"/> Withdraw Tokens to Wallet</h2>
                        <h2><img src="{{url('/images/bannericon5.png')}}" width="70"/> Redeem Tokens for Merchandise
                        </h2>
                    </div>
                    <div class="text-center p-2">
                        <h1 class="text-uppercase">Join the first ever digital sports hub now!</h1>
                        <div class="">
                            <a href="{{ route('register') }}" class="btn btn-color btn-sm"><i
                                        class="fas fa-user-edit"></i> Register</a>
                            <a href="{{ route('login') }}" class="btn btn-color btn-sm"><i
                                        class="fas fa-sign-in-alt"></i> Login</a>
                        </div>
                    </div>
                </div>

            </div>

        @endguest

        {{-- <div class="text-center mt-4">
             <a target="_blank"
                href="@auth javascript:void(0);  @endauth @guest {{url('register')}} @endguest"><img
                         src="{{url('img/content/sportco-superpowers-banner.jpg')}}" alt=""></a>
         </div>--}}
        <div class="trending-now">
            <span class="trending-now__label">
              <i class="ui-flash"></i>
              <span class="trending-now__text d-lg-inline-block d-none">Just In!</span>
            </span>
            <div class="newsticker">
                <ul class="newsticker__list">
                    @foreach ($data as $d)
                        <li class="newsticker__item"><a href="{{ url("article") }}/{{ $d->slug }}"
                                                        class="newsticker__item-url">{{ $d->title }} <i>
                                    by {{ $d->user_name }}</i></a></li>
                    @endforeach
                </ul>
            </div>
            <div class="newsticker-buttons">
                <button class="newsticker-button newsticker-button--prev" id="newsticker-button--prev"
                        aria-label="next article"><i class="ui-arrow-left"></i></button>
                <button class="newsticker-button newsticker-button--next" id="newsticker-button--next"
                        aria-label="previous article"><i class="ui-arrow-right"></i></button>
            </div>
        </div>
    </div>
    <div class="main-container container pt-24" id="main-container">
    <!-- Ad Banner 728 -->
    <div class="text-center mb-5 mt-4">
        <a href="javascript:void(0)">
            <img data-src="{{asset('img/addbanner.png')}}" src="{{asset('images/addbanner.png')}}" class="lazy" alt="">
        </a>

    </div>
    </div>
    <!-- Featured Posts Grid -->
    <section class="featured-posts-grid">
        <div class="container">
            <div class="row row-8">
                <div id="feature-left" class="col-lg-6">


                    <div class="featured-posts-grid__item featured-posts-grid__item--sm">
                        <article class="entry card post-list featured-posts-grid__entry">
                            <div class="entry__img-holder post-list__img-holder card__img-holder lazy" data-src="">
                                <div class="animated-background"></div>

                            </div>

                            <div class="entry__body post-list__body card__body">
                                <h2 class="h10 position-relative ">
                                    <div class="animated-background"></div>
                                </h2>
                                <br>
                                <h2 class="h10 position-relative ">
                                    <div class="animated-background"></div>
                                </h2>
                                <br>
                            </div>
                        </article>
                    </div>
                    <div class="featured-posts-grid__item featured-posts-grid__item--sm">
                        <article class="entry card post-list featured-posts-grid__entry">
                            <div class="entry__img-holder post-list__img-holder card__img-holder lazy" data-src="">
                                <div class="animated-background"></div>

                            </div>

                            <div class="entry__body post-list__body card__body">
                                <h2 class="h10 position-relative ">
                                    <div class="animated-background"></div>
                                </h2>
                                <br>
                                <h2 class="h10 position-relative ">
                                    <div class="animated-background"></div>
                                </h2>
                                <br>
                            </div>
                        </article>
                    </div>
                    <div class="featured-posts-grid__item featured-posts-grid__item--sm">
                        <article class="entry card post-list featured-posts-grid__entry">
                            <div class="entry__img-holder post-list__img-holder card__img-holder lazy" data-src="">
                                <div class="animated-background"></div>

                            </div>

                            <div class="entry__body post-list__body card__body">
                                <h2 class="h10 position-relative ">
                                    <div class="animated-background"></div>
                                </h2>
                                <br>
                                <h2 class="h10 position-relative ">
                                    <div class="animated-background"></div>
                                </h2>
                                <br>
                            </div>
                        </article>
                    </div>


                </div>
                <div id="feature-right" class="col-lg-6">


                    <div class="featured-posts-grid__item featured-posts-grid__item--lg">
                        <article class="entry card featured-posts-grid__entry">
                            <div class="entry__img-holder post-list__img-holder card__img-holder lazy" data-src="">
                                <div class="animated-background"></div>
                            </div>

                            <div class="entry__body post-list__body card__body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="position-relative" style="height: 40px">
                                            <div class="animated-background"></div>
                                        </h2>
                                        <h2 class="position-relative" style="height: 20px">
                                            <div class="animated-background"></div>
                                        </h2>
                                    </div>

                                    <div class="col-md-8 mt-3">
                                        <h2 class="h10 position-relative ">
                                            <div class="animated-background"></div>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>

                </div>

                {{--       <div class="col-lg-6">
                         @foreach($featured_posts as $key => $featured_post)
                         @if($key == 3)
                          @break
                         @endif
                         <!-- Small post -->
                         <div class="featured-posts-grid__item featured-posts-grid__item--sm">
                           <article class="entry card post-list featured-posts-grid__entry">
                             <div class="entry__img-holder post-list__img-holder card__img-holder lazy" data-src="{{$featured_post->media_url}}">
                               <a href="{{ url("article") }}/{{ $featured_post->slug }}" class="thumb-url"></a>
                               <img data-src="{{$featured_post->media_url}}" src="{{asset('img/empty.png')}}" alt="" class="entry__img d-none">
                               <a href="{{ sportsUrl($featured_post->sports_name) }}" class="entry__meta-category entry__meta-category--label entry__meta-category--align-in-corner entry__meta-category--violet">{{$featured_post->sports_name}}</a>
                             </div>

                             <div class="entry__body post-list__body card__body">
                               <h2 class="entry__title">
                                 <a href="{{ url("article") }}/{{ $featured_post->slug }}">{{$featured_post->title}}</a>
                               </h2>
                               <ul class="entry__meta">
                                 <li class="entry__meta-author">
                                   <span>by</span>
                                   <a href="{{ url("profile") }}/{{ $featured_post->user_id }}">{{ $featured_post->user_name}}</a>
                                 </li>
                                 <li class="entry__meta-date">
                                         {{ parsePostDate($featured_post->publish_utc, $time)  }}
                                 </li>
                               </ul>
                             </div>
                           </article>
                         </div> <!-- end post -->
                         @endforeach

                       </div> <!-- end col -->--}}

                {{--<div class="col-lg-6">
                  @if(!empty($featured_posts[3]))
                  <!-- Large post -->
                  <div class="featured-posts-grid__item featured-posts-grid__item--lg">
                    <article class="entry card featured-posts-grid__entry">
                      <div class="entry__img-holder card__img-holder">
                        <a href="{{ url("article") }}/{{ $featured_posts[3]->slug}}">

                          <img data-src="{{$featured_posts[3]->media_url}}" src="{{asset('img/empty.png')}}" alt="" class="entry__img lazy">
                        </a>
                        <a href="{{ sportsUrl($featured_posts[3]->sports_name) }}" class="entry__meta-category entry__meta-category--label entry__meta-category--align-in-corner entry__meta-category--green">{{ $featured_posts[3]->sports_name }}</a>
                      </div>

                      <div class="entry__body card__body">
                        <h2 class="entry__title">
                          <a href="{{ url("article") }}/{{ $featured_posts[3]->slug }}">{{$featured_posts[3]->title}}</a>
                        </h2>
                        <ul class="entry__meta">
                          <li class="entry__meta-author">
                            <span>by</span>
                            <a href="{{ url("profile") }}/{{ $featured_posts[3]->user_id }}">{{ $featured_posts[3]->user_name}}</a>
                          </li>
                          <li class="entry__meta-date">
                                  {{ parsePostDate($featured_posts[3]->publish_utc, $time)  }}
                          </li>
                        </ul>
                      </div>
                    </article>
                  </div> <!-- end large post -->
                  @endif
                </div>--}}

            </div>
        </div>
    </section> <!-- end featured posts grid -->

    <div class="main-container container pt-24" id="main-container">
<style>
    .sportsgramm-cards{
        position: relative;
    }
    .sportsgramm-cards .full-link{
        position: absolute;
        width: 100%;
        height:100%;
        display: block;
        z-index: 3;
    }
    .sportsgramm-cards .entry__meta-category--label{
        z-index: 4;
    }

</style>

    {{--sportsgram section start here--}}
    <!-- Featured Albums -->
        @if(($sportsgram != '[]'))
        <section class="section mb-0">
            <div class="title-wrap title-wrap--line">
                <h3 class="section-title">Sportsgram</h3>
                <a href="{{ route('sportsgram') }}" class="all-posts-url">View All</a>
            </div>
            <div class="row" id="sportsgram">
                @foreach($sportsgram as $sportsgramdata)
                    <div class="col-md-3">
                        <article class="entry thumb thumb--size-2 pb-4 mb-0 sportsgramm-cards">
                            <div class="entry__img-holder thumb__img-holder"
                                 style="background-image:url('{{$sportsgramdata->media_url}}')">
                                <a class="full-link" href="{{url('sportsgram').'/'.$sportsgramdata->slug}}"></a>
                                <a href="{{sportsUrl($sportsgramdata->s_name)}}" style="top: 11px;bottom:auto"
                                   class="entry__meta-category entry__meta-category--label entry__meta-category--align-in-corner entry__meta-category--green">{{$sportsgramdata->s_name}}</a>
                                <a href="" style="top: 11px;bottom:auto;right:10px;left:auto"
                                   class="entry__meta-category text-white entry__meta-category--align-in-corner">@if ($sportsgramdata->media_count != 1)<i class="far fa-images"></i> {{$sportsgramdata->media_count}} @endif</a>
                                <div class="bottom-gradient"></div>
                                <div class="thumb-text-holder">
                                    <h2 class="thumb-entry-title">
                                        {{substr( $sportsgramdata->title, 0, 30 )}}
                                    </h2>
                                </div>
                            </div>
                        </article>
                    </div>
                        @endforeach
                <div class="col-md-3">
                    <article class="entry thumb thumb--size-2 pb-4  viewwall mb-0">
                        <div class="entry__img-holder thumb__img-holder"
                             style="background-image: url('{{url('/images/viewall.jpg')}}');">

                            <a href="{{url('sportsgram')}}"></a>
                            <div class="bottom-gradient"></div>

                        </div>

                    </article>
                </div>
            </div>
        </section> <!-- end featured albums -->
        @endif
    {{--sportsgram section end here--}}

    <!-- Slider -->

    @if(!empty($livecontests->count()))

        <!-- Featured Albums -->
            <section class="section mb-0">
                <div class="title-wrap title-wrap--line title-wrap--pr">
                    <h3 class="section-title">NEW ON SPORTCO PLAY</h3>
                </div>

                <!-- Slider -->
                <div id="play" class="owl-carousel owl-theme owl-carousel--arrows-outside">

                    @foreach($livecontests as $key =>$livecontest)



                        <article class="entry thumb thumb--size-2 pb-4 mb-0 ">
                            <div class="entry__img-holder thumb__img-holder"
                                 style="background-image: url('{{$livecontest->media_url}}');">
                                <a href="#" style="top: 11px;bottom:auto"
                                   class="entry__meta-category entry__meta-category--label entry__meta-category--align-in-corner entry__meta-category--green">{{ $livecontest->sport }}</a>

                                <div class="bottom-gradient"></div>
                                <div class="thumb-text-holder">
                                    <h2 class="thumb-entry-title">
                                        <a href="{{url('play/game/detail/').'/'.$livecontest->slug}}">{{$livecontest->name}}
                                            <br/>
                                            <strong class="small">@if($livecontest->entry != "0.00") {{ $livecontest->entry }}
                                                Tokens @else Play for free @endif</strong><br/>


                                        </a>
                                    </h2>
                                </div>
                            </div>

                            <small class="mt-2 d-block"><i
                                        class="far fa-play-circle mr-1"></i> {{ $livecontest->playcount ?? 0 }}</small>

                        </article>
                        @if ($key === 2)
                            @break
                        @endif
                    @endforeach
                    <article class="entry thumb thumb--size-2 pb-4  viewwall mb-0">
                        <div class="entry__img-holder thumb__img-holder"
                             style="background-image: url('{{url('/images/viewall.jpg')}}');">

                            <a href="{{url('play')}}"></a>
                            <div class="bottom-gradient"></div>

                        </div>

                    </article>

                </div> <!-- end slider -->

            </section> <!-- end featured albums -->

    @endif
    <!-- Ad Banner 728 -->
        {{-- <div class="text-center mb-5 mt-4">
            <a href="https://teespring.com/stores/sportco-store-2" target="_blank">
            <img data-src="{{asset('img/store.png')}}" src="{{asset('images/store.png')}}" class="lazy" alt="">
            </a>

        </div> --}}


        <!-- Content -->
        <div class="row">

            <!-- Posts -->
            <div class="col-lg-8 blog__content">

                <!-- Latest News -->
                <section class="section tab-post mb-16">
                    <div class="title-wrap title-wrap--line">
                        <h3 class="section-title">Editor's Choice</h3>
                        <a href="{{ sectionsUrl(returnConfig('editors_choice')) }}" class="all-posts-url">View All</a>
                    </div>
                    <div class="row" id="editorChoice">
                        @for($i = 0; $i < 2; $i++)
                            <div class="col-md-6">
                                <article class="entry card ratio4-3">
                                    <div class="entry__img-holder card__img-holder">
                                        <div class="timeline-item thumb-container">
                                            <div class="animated-background"></div>
                                        </div>
                                    </div>

                                    <div class="entry__body card__body">
                                        <div class="entry__header">
                                            <h2 class="entry__title h10 position-relative">
                                                <div class="animated-background"></div>
                                            </h2>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h2 class="h10 position-relative ">
                                                        <div class="animated-background"></div>
                                                    </h2>
                                                    <br/>
                                                </div>
                                                <div class="col-md-12">
                                                    <h2 class="h10 position-relative ">
                                                        <div class="animated-background"></div>
                                                    </h2>
                                                    <h2 class="h10 position-relative ">
                                                        <div class="animated-background"></div>
                                                    </h2>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </article>


                                {{--   <article class="entry card ratio4-3 d-none">
                                     <div class="entry__img-holder card__img-holder">
                                       <a href="{{// url("article") }}/{{ $editor_choice->slug }}">
                                         <div class="thumb-container">
                                         <img data-src="{{$editor_choice->media_url}} " src="{{asset('img/empty.png')}}" class="entry__img lazy img-responsive" alt=""  />
                                         </div>
                                       </a>
                                       <a href="{{ sportsUrl($editor_choice->sports_name) }}" class="entry__meta-category entry__meta-category--label entry__meta-category--align-in-corner entry__meta-category--green">{{$editor_choice->sports_name}}</a>
                                     </div>

                                     <div class="entry__body card__body">
                                       <div class="entry__header">

                                         <h2 class="entry__title">
                                           <a href="{{ url("article") }}/{{ $editor_choice->slug }}">{{articleLimiter($editor_choice->title,34)}}</a>
                                         </h2>
                                         <ul class="entry__meta">
                                           <li class="entry__meta-author">
                                             <span>by</span>
                                             <a href="{{ url("profile") }}/{{ $editor_choice->user_id }}">{{$editor_choice->user_name}}</a>
                                           </li>
                                           <li class="entry__meta-date">
                                               {{ parsePostDate($editor_choice->publish_utc, $time)  }}
                                           </li>
                                         </ul>
                                       </div>
                                       <div class="entry__excerpt">
                                         <p>{!! articleLimiter($editor_choice->description) !!}</p>
                                       </div>
                                     </div>
                                   </article>--}}
                            </div>
                        @endfor

                    </div>


                </section> <!-- end latest news -->

            </div> <!-- end posts -->

            <!-- Sidebar -->
            <aside class="col-lg-4 sidebar sidebar--right">

            {{--@if(//!empty($most_populars->count()))--}}
            <!-- Widget Trending Posts -->

                <aside class="widget widget-popular-posts">
                    <h4 class="widget-title">Trending</h4>
                    <ul class="post-list-small" id="trending">

                        <li class="post-list-small__item">
                            <article class="post-list-small__entry clearfix">
                                <div class="post-list-small__img-holder">
                                    <div class="thumb-container ">
                                        <div class="animated-background"></div>
                                    </div>
                                </div>
                                <div class="post-list-small__body mt-3">
                                    <h3 class="post-list-small__entry-title h10 position-relative">
                                        <div class="animated-background"></div>
                                    </h3>
                                    <div class="h10 position-relative mt-3">
                                        <div class="animated-background"></div>
                                    </div>

                                </div>
                            </article>
                        </li>


                        {{--<li class="post-list-small__item d-none">
                          <article class="post-list-small__entry clearfix">
                            <div class="post-list-small__img-holder">
                              <div class="thumb-container">
                                <a href="{{ url("article") }}/{{ $value->slug }}">
                                  <img data-src="{{$value->media_url}}" src="{{asset('img/empty.png')}}" alt="" class="post-list-small__img--rounded lazy">
                                </a>
                              </div>
                            </div>
                            <div class="post-list-small__body">
                              <h3 class="post-list-small__entry-title">
                                <a href="{{ url("article") }}/{{ $value->slug }}">{{$value->title}}</a>
                              </h3>
                              <ul class="entry__meta">
                                <li class="entry__meta-author">
                                  <span>by</span>
                                  <a href="{{ url("profile") }}/{{ $value->user_id }}">{{$value->user_name}}</a>
                                </li>
                                <li class="entry__meta-date">
                                      {{ parsePostDate($value->publish_utc, $time)  }}
                                </li>
                              </ul>
                            </div>
                          </article>
                        </li>--}}


                    </ul>
                </aside> <!-- end widget popular posts -->
            {{--@endif--}}




            <!-- Widget Socials -->
                <aside class="widget widget-socials">
                    <h4 class="widget-title">Let's hang out on social</h4>
                    <div class="socials socials--wide socials--large">
                        <div class="row row-16">
                            <div class="col">
                                <a class="social social-facebook" href="javascript:void(0)"
                                   title="facebook" aria-label="facebook">
                                    <i class="ui-facebook"></i>
                                    <span class="social__text">Facebook</span>
                                </a>
                                <a class="social social-twitter" href="javascript:void(0)" title="twitter" aria-label="twitter">
                                    <i class="ui-twitter"></i>
                                    <span class="social__text">Twitter</span>
                                </a>

                                {{--<a class="social social-slack" href="http://sportcoworkspace.slack.com/"
                                   target="_blank"><i class="fab fa-slack-hash"></i>
                                    <span class="social__text">Slack</span>
                                </a>--}}
                            </div>
                            <div class="col">
                                {{--<a class="social social-medium" href="https://medium.com/@social_72044" target="_blank"><i
                                            class="fab fa-medium-m"></i>
                                    <span class="social__text">Medium</span>
                                </a>--}}
                                <a class="social social-youtube" href="javascript:void(0)" title="youtube" aria-label="youtube">
                                    <i class="ui-youtube"></i>
                                    <span class="social__text">Youtube</span>
                                </a>
                                <a class="social social-linkedin" href="javascript:void(0)">
                                    <i class="fab fa-linkedin-in"></i>
                                    <span class="social__text">Linked in</span>
                                </a>

                                <a class="social" href="javascript:void(0)"><i
                                            class="fab fa-telegram-plane"></i>
                                    <span class="social__text">Telegram</span>
                                </a>

                            </div>
                        </div>
                    </div>
                </aside> <!-- end widget socials -->

            </aside> <!-- end sidebar -->

        </div> <!-- end content -->

    {{--@if(empty($sportsgrams->count()) && false)--}}
    {{--<!-- Carousel posts -->--}}
    {{--<section class="section mb-0">--}}
    {{--<div class="title-wrap title-wrap--line title-wrap--pr">--}}
    {{--<h3 class="section-title">Sportsgram</h3>--}}
    {{--<a href="{{ url("category") }}/{{returnConfig('sportsgram')}}" class="all-posts-url">View All </a> --}}
    {{--</div>--}}
    {{----}}
    {{--<!-- Slider -->--}}
    {{--<div id="owl-posts" class="owl-posts owl-carousel owl-theme owl-carousel--arrows-outside">--}}
    {{--@foreach ($sportsgrams as $sportsgram)              --}}
    {{--<article class="entry thumb thumb--size-1">--}}
    {{--<div class="entry__img-holder thumb__img-holder lazy" data-src="{{ $sportsgram->media_url }}">--}}
    {{--<div class="bottom-gradient"></div>--}}
    {{--<div class="thumb-text-holder">   --}}
    {{--<h2 class="thumb-entry-title">--}}
    {{--<a href="{{ url("article") }}/{{ $sportsgram->slug }}">{{ $sportsgram->title }}</a>--}}
    {{--</h2>--}}
    {{--</div>--}}
    {{--<a href="{{ url("article") }}/{{ $sportsgram->slug }}" class="thumb-url"></a>--}}
    {{--</div>--}}
    {{--</article>--}}

    {{--@endforeach--}}
    {{----}}
    {{----}}
    {{--</div> <!-- end slider -->--}}
    {{----}}
    {{--</section> <!-- end carousel posts -->--}}
    {{--@endif--}}

    {{--        @if(!empty($people_choices[0]) || !empty($editordesks[0]))--}}
    <!-- Posts from categories -->
        <section class="section mb-0">
            <div class="row">
            {{--          @if(!empty($people_choices[0]))--}}
            <!-- Technology -->
                <div class="col-md-6">
                    <div class="title-wrap title-wrap--line">
                        <h3 class="section-title">People's Choice</h3>
                        <a href="{{ sectionUrl(returnConfig('orderBy')) }}" class="all-posts-url">View All</a>
                    </div>
                    <div class="row">
                        <div class="col-lg-6" id="peoplechoice-left">
                            {{--@for($i=0; $i<1; $i++)--}}
                            {{--@if(!empty($people_choices[$i]))--}}
                            <article class="entry thumb thumb--size-2">
                                <div class="entry__img-holder thumb__img-holder lazy">
                                    <div class="animated-background"></div>

                                </div>
                            </article>


                            {{-- <article class="entry thumb thumb--size-2 d-none">
                               <div class="entry__img-holder thumb__img-holder lazy" data-src="{{$people_choices[0]->media_url}}">
                                 <div class="bottom-gradient"></div>
                                 <div class="thumb-text-holder thumb-text-holder--1">
                                   <h2 class="thumb-entry-title">
                                     <a href="{{ url("article") }}/{{ $people_choices[0]->slug }}">{{$people_choices[0]->title}}</a>
                                   </h2>
                                   <ul class="entry__meta">
                                     <li class="entry__meta-author">
                                       <span>by</span>
                                       <a href="{{ url("profile") }}/{{ $people_choices[0]->user_id }}">{{$people_choices[0]->user_name}}</a>
                                     </li>
                                     <li class="entry__meta-date">
                                         {{ parsePostDate($people_choices[0]->publish_utc, $time)  }}
                                     </li>
                                   </ul>
                                 </div>
                                 <a href="{{ url("article") }}/{{ $people_choices[0]->slug }}" class="thumb-url"></a>
                               </div>
                             </article>--}}
                            {{--@endif--}}
                            {{--@endfor--}}
                        </div>
                        <div class="col-lg-6">
                            <ul id="peoplechoices"
                                class="post-list-small post-list-small--dividers post-list-small--arrows mb-24">
                                {{--@for($i=1 ; $i<=4; $i++)
                                  @if(empty($people_choices[$i]))
                                    @continue
                                  @endif--}}

                                <li class="post-list-small__item pt-1">
                                    <h3 class="post-list-small__entry-title position-relative h10">
                                        <div class="animated-background"></div>
                                    </h3>
                                </li>
                                <li class="post-list-small__item pt-3">
                                    <h3 class="post-list-small__entry-title position-relative h10">
                                        <div class="animated-background"></div>
                                    </h3>
                                </li>
                                <li class="post-list-small__item pt-3">
                                    <h3 class="post-list-small__entry-title position-relative h10">
                                        <div class="animated-background"></div>
                                    </h3>
                                </li>
                                <li class="post-list-small__item pt-3">
                                    <h3 class="post-list-small__entry-title position-relative h10">
                                        <div class="animated-background"></div>
                                    </h3>
                                </li>


                                {{--
                                                   <li class="post-list-small__item d-none">
                                                      <article class="post-list-small__entry">
                                                        <div class="post-list-small__body">
                                                          <h3 class="post-list-small__entry-title">
                                                            <a href="{{ url("article") }}/{{ $people_choices[$i]->slug }}">{{$people_choices[$i]->title}}</a>
                                                          </h3>
                                                        </div>
                                                      </article>
                                                    </li>
                                                    @endfor--}}


                            </ul>
                        </div>
                    </div>
                </div> <!-- end technology -->
            {{--@endif--}}
            {{--          @if(!empty($editordesks[0]))--}}
            <!-- Travel -->
                <div class="col-md-6">
                    <div class="title-wrap title-wrap--line">

                        <h3 class="section-title">Editor's Desk</h3>
                        <a href="{{ categoryUrl(returnConfig('editor desk')) }}" class="all-posts-url">View All</a>

                    </div>
                    <div class="row">
                        <div class="col-lg-6" id="editordesk-left">

                            {{--                        @if(!empty($editordesks[0]))--}}

                            <article class="entry thumb thumb--size-2">
                                <div class="entry__img-holder thumb__img-holder lazy">
                                    <div class="animated-background"></div>

                                </div>
                            </article>


                            {{--<article class="entry thumb thumb--size-2 d-none">
                              <div class="entry__img-holder thumb__img-holder lazy" data-src="{{$editordesks[0]->media_url}}">
                                <div class="bottom-gradient"></div>
                                <div class="thumb-text-holder thumb-text-holder--1">
                                  <h2 class="thumb-entry-title">
                                    <a href="{{ url("article") }}/{{ $editordesks[0]->slug }}">{{$editordesks[0]->title}}</a>
                                  </h2>
                                  <ul class="entry__meta">
                                    <li class="entry__meta-author">
                                      <span>by</span>
                                      <a href="{{ url("profile") }}/{{ $editordesks[0]->user_id }}">{{$editordesks[0]->user_name}}</a>
                                    </li>
                                    <li class="entry__meta-date">
                                        {{ parsePostDate($editordesks[0]->publish_utc)  }}
                                    </li>

                                  </ul>
                                </div>
                                <a href="{{ url("article") }}/{{ $editordesks[0]->slug }}" class="thumb-url"></a>
                              </div>
                            </article>--}}
                            {{--@endif--}}

                        </div>
                        <div class="col-lg-6">
                            <ul id="editordesk"
                                class="post-list-small post-list-small--dividers post-list-small--arrows mb-24">
                                {{--
                                                      @for($i=1 ; $i<=4; $i++)
                                                          @if(!empty($editordesks[$i]))
                                --}}

                                <li class="post-list-small__item pt-1">
                                    <h3 class="post-list-small__entry-title position-relative h10">
                                        <div class="animated-background"></div>
                                    </h3>
                                </li>
                                <li class="post-list-small__item pt-3">
                                    <h3 class="post-list-small__entry-title position-relative h10">
                                        <div class="animated-background"></div>
                                    </h3>
                                </li>
                                <li class="post-list-small__item pt-3">
                                    <h3 class="post-list-small__entry-title position-relative h10">
                                        <div class="animated-background"></div>
                                    </h3>
                                </li>
                                <li class="post-list-small__item pt-3">
                                    <h3 class="post-list-small__entry-title position-relative h10">
                                        <div class="animated-background"></div>
                                    </h3>
                                </li>


                                {{--<li class="post-list-small__item d-none">
                                   <article class="post-list-small__entry">
                                     <div class="post-list-small__body">
                                       <h3 class="post-list-small__entry-title">
                                           <a href="{{ url("article") }}/{{ $editordesks[$i]->slug }}">{{$editordesks[$i]->title}}</a>
                                       </h3>
                                     </div>
                                   </article>
                                 </li>--}}
                                {{--   @endif
                              @endfor--}}

                            </ul>
                        </div>
                    </div>
                </div> <!-- end travel -->
                {{--@endif--}}
            </div>
        </section> <!-- end posts from categories -->
    {{--@endif--}}

    <!-- Ad Banner 728 -->
    {{-- <div class="text-center pb-48">
      <a href="#">
        <img src="img/content/placeholder_728.jpg" alt="">
      </a>
    </div> --}}

    {{--@if(!empty($videos->count()) && false)--}}
    {{--<!-- Video posts -->--}}
    {{--<section class="section mb-24">--}}
    {{--<div class="title-wrap title-wrap--line">--}}
    {{--<h3 class="section-title">Videos</h3>--}}
    {{--<a href="{{ url("category") }}/{{returnConfig('videos')}}" class="all-posts-url">View All</a>--}}
    {{--</div>--}}
    {{--<div class="row card-row">--}}
    {{--@foreach($videos as $video)--}}
    {{--<div class="col-md-6">--}}
    {{--<article class="entry card">--}}
    {{--<div class="entry__img-holder card__img-holder">--}}
    {{--<a href="{{ url("article") }}/{{ $video->slug }}">--}}
    {{--<div class="thumb-container">--}}
    {{--<img data-src="{{$video->media_url}}" src="{{asset('img/empty.png')}}" class="entry__img lazy" alt="" />--}}
    {{--</div>--}}
    {{--</a>--}}
    {{--<a href="{{ sportsUrl($video->sports_name) }}" class="entry__meta-category entry__meta-category--label entry__meta-category--align-in-corner entry__meta-category--green">{{$video->sports_name}}</a>--}}
    {{----}}
    {{--</div>--}}
    {{----}}
    {{--<div class="entry__body card__body">--}}
    {{--<div class="entry__header">                  --}}
    {{--<h2 class="entry__title">--}}
    {{--<a href="{{ url("article") }}/{{ $video->slug }}">{{$video->title}}</a>--}}
    {{--</h2>--}}
    {{--<ul class="entry__meta">--}}
    {{--<li class="entry__meta-author">--}}
    {{--<span>by</span>--}}
    {{--<a href="{{ url("profile") }}/{{ $video->user_id }}">{{$video->user_name}}</a>--}}
    {{--</li>--}}
    {{--<li class="entry__meta-date">--}}
    {{--{{ parsePostDate($video->publish_utc, $time)  }}--}}
    {{--</li>--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--<div class="entry__excerpt">--}}
    {{--<p>{!! articleLimiter($video->description) !!}</p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</article>--}}
    {{--</div>--}}
    {{--@endforeach--}}

    {{--</div>--}}
    {{--</section> <!-- end video posts -->--}}
    {{----}}
    {{--@endif--}}
    <!-- Ad Banner 728 -->
        <div class="clearfix"></div>
        <div class="text-center pb-5 row">
            {{-- <div class="col-sm p-0">
                <a href="{{ route("play-game") }}"><img class="img-fluid" src="{{url('img/content/banner-ad4.jpg')}}"
                                                        alt=""></a>
            </div> --}}
            {{-- <div class="col-sm p-0">
                <a href="@auth {{ route('my.profile',[auth()->id()]) }} @endauth @guest {{ route('login', ['redirect'=> "my.profile"]) }} @endguest"><img
                            class="img-fluid" src="{{url('img/content/banner-ad5.jpg')}}" alt=""></a>
            </div> --}}

        </div>

    @if(!empty($data->count()))
        <!-- Content Secondary -->
            <div class="row">


                <!-- Posts -->
                <div class="col-lg-8 blog__content mb-72">

                    <!-- Worldwide News -->
                    <section class="section">
                        <div class="title-wrap title-wrap--line">
                            <h3 class="section-title">Latest Post</h3>
                            <a href="{{ sectionUrl(returnConfig('orderByLatest')) }}" class="all-posts-url">View All</a>
                        </div>
                        <div id="load"></div>
                        <div id="latestpost">
                            @include('front.latestpost')
                        </div>

                        {{--{{ $data->links() }}--}}
                        {{--@include('front.partials.pagination')--}}

                    </section> <!-- end worldwide news -->


                </div> <!-- end posts -->

                <!-- Sidebar 1 -->
                <div id="newsletter" class="col-lg-4 sidebar sidebar--1">
                    <!-- Widget Newsletter -->
                    <div class="widget widget_mc4wp_form_widget mb-0">
                        <h4 class="widget-title">Newsletter</h4>

                        <p class="newsletter__text">
                            <i class="ui-email newsletter__icon"></i>
                            Subscribe for our daily news
                        </p>
                        <form class="mc4wp-form newsletter" method="post">
                            <br/>
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Name" required="">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Email" required="">
                            </div>
                            <div class="form-group">
                                <input type="submit" id="alertsclick" class="btn btn-lg btn-color" value="Sign Up">
                            </div>

                        </form>

                    </div> <!-- end widget newsletter -->


                    <!-- Widget Ad 300 -->
                {{--<aside class="widget widget_media_image">
                    <a href="#">
                        <img data-src="img/content/placeholder_336.jpg" src="{{asset('img/empty.png')}}" alt="" class="lazy">
                    </a>
                </aside>--}}
                <!-- end widget ad 300 -->

                    <!-- Widget Categories -->
                    {{--<aside class="widget widget_categories">--}}
                    {{--<h4 class="widget-title">Categories</h4>--}}
                    {{--<ul>--}}
                    {{----}}
                    {{----}}
                    {{--@foreach ($sports as $key => $sport)--}}
                    {{--@if($key == 6)--}}
                    {{--@break--}}
                    {{--@endif--}}
                    {{--<li><a href="{{ sportsUrl($sport->name) }}">{{$sport->name}}</a></li>--}}


                    {{--@endforeach--}}
                    {{--</ul>--}}
                    {{--</aside> <!-- end widget categories -->--}}
                    <div id="quiz-widget">
                        <br/>
                        <br/>
                        <br/>
                        <div class="widget pl-0 pr-0 pt-0 pb-0">
                        @if(!empty(isProd()))
                            <iframe src="https://sportsqwizz.com/sportco_demo_widget/public/" height="690" width="100%" frameborder="0"></iframe>
                        @else
                            <iframe src="http://localhost/sportco_widget/public/login" height="690" width="100%" frameborder="0"></iframe>
                        @endif
                        </div>
                    </div>
                </div> <!-- end sidebar 1 -->



            </div> <!-- content secondary -->

    @endif
    <!-- Ad Banner 728 -->
    {{-- <div class="text-center pb-48">
      <a href="#">
        <img src="img/content/placeholder_728.jpg" alt="">
      </a>
    </div> --}}
    {{--@if(!empty($fans->count()))--}}
    <!-- Carousel posts -->
        <section class="section mb-0 havepost fanscorner" style="display: none;">
            <div class="title-wrap title-wrap--line title-wrap--pr">
                <h3 class="section-title">FANS CORNER</h3>
                {{--<a href="{{ sectionUrl(returnConfig('type')) }}" class="all-posts-url">View All</a>--}}
            </div>
            <!-- Slider -->
            <div id="owl-posts" class="owl-carousel owl-theme owl-carousel--arrows-outside">
            </div>
               {{-- @for($i = 0; $i <= 15; $i++)
                    <article  class="entry thumb thumb--size-1">
                        <div class="entry__img-holder thumb__img-holder">
                            <div class="animated-background"></div>
                        </div>
                    </article>
                @endfor--}}
                <div id="slider-content"></div>

                {{--@foreach($fans as $fan)
              <article class="entry thumb thumb--size-1 d-none">
                    <div class="entry__img-holder thumb__img-holder lazy" data-src="{{ $fan->media_url }}">
                      <div class="bottom-gradient"></div>
                      <div class="thumb-text-holder">
                        <h2 class="thumb-entry-title">
                          <a href="{{ url("article") }}/{{ $fan->slug }}">{{ $fan->title }}</a>
                        </h2> @include('front.partials.pagination')
                      </div>
                      <a href="{{ url("article") }}/{{ $fan->slug }}" class="thumb-url"></a>
                    </div>
                  </article>
              @endforeach--}}
             <!-- end slider -->

        </section> <!-- end carousel posts -->
        {{--@endif--}}
    </div> <!-- end main container -->

@endsection
@section('script_extra')

    <script>
        $(document).ready(function () {
            {{-- @auth --}}
            
            {{-- @else --}}
                
                // $("#started").modal('show');

            {{-- @endauth --}}
            
            @auth
            @if(Session::has('verified_email'))

            ga('send', {
                hitType: 'event',
                eventCategory: 'Register',
                eventAction: 'Account Verified',
                eventLabel: 'Register Account Verified'
            });
            {{session()->remove('verified_email')}}
            @endif

            @if(Session::has('joinedviarefferal'))
                ga('send', {
                    hitType: 'event',
                    eventCategory: 'User Referral',
                    eventAction: 'Joined via Referral',
                    eventLabel: 'User Joined via Referral'
                });
            @endif
            @endauth




            /*            $(".l_post .entry__meta-date").each(function(){

                                $(this).html(moment($(this).html().trim()).fromNow());
                            });*/
            $(window).ready(function () {
                setInterval(function () {
                    //$('.secondslide').fadeOut("slow");
                    $('.secondslide').css('opacity', 0).css('animation', '1s');

                }, 2000);
                setInterval(function () {
                    $('.thirdslide div').fadeOut("");
                    $('.last-slide div').addClass('fadeIn');
                }, 2400);

            });
            $("#play").owlCarousel({
                center: false,
                loop: false,
                nav: true,
                dots: false,
                margin: 30,
                lazyLoad: true,
                navSpeed: 500,
                responsive: {
                    1100: {
                        items: 4
                    },
                    1024: {
                        items: 2,

                    },
                    200: {
                        items: 1,

                    }
                }

            });


            $(function () {
                $('body').on('click', '#c_nav li a', function (e) {
                    e.preventDefault();

                    //$('#load a').css('color', '#dfecf6');
                    // $('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="{{url('/images/loading.gif')}}" />');
                    $('#c_nav li').removeClass('active');
                    $(this).parent('li').addClass('active');


                    var url = $(this).attr('href');
                    getArticles(url);
                    window.history.pushState("", "", url);
                });

                function getArticles(url) {
                    $.ajax({
                        url: url,
                        type: "GET",
                    }).done(function (data) {
                        //console.log(data);
                        $('#latestpost').html(data);
                        lazyload();

                    }).fail(function () {
                        alert('Articles could not be loaded.');
                    });
                }
            });

            function lazyload() {
                $('.lazy').lazy({
                    effect: "fadeIn",
                    effectTime: 500,
                    threshold: 0
                });
            }

        })

        var globalData = "";
        $.ajax({
            url: '{{ url('/home-background') }}',
            type: "GET",
            success: function (data) {

                globalData = data;
                AjaxDataSuccess(data);

            },
            error: function (textStatus, errorThrown) {
                // console.log(textStatus);
            }
        });

        function AjaxDataSuccess(data) {
            var featurepost = "";
            var featurepostmain = "";
            var trending = "";
            var editorChoices = ""
            var peoplechoices = "";
            var peoplechoiceleft = "";
            var editordeskleft = "";
            var editordesk = "";
            $.each(data.featured_posts, function (key, value) {


                var media_url = value.media_url;
                var title = value.title;
                var slug = value.slug;
                var publish_date = value.publish_utc;

                var username = value.user_name;
                var user_id = value.user_id;
                var sportname = value.sports_name.toLowerCase();


                featurepost += "<div class=\"featured-posts-grid__item featured-posts-grid__item--sm\">\n" +
                    "  <article class=\"entry card post-list featured-posts-grid__entry\">\n" +
                    "    <div class=\"entry__img-holder post-list__img-holder card__img-holder lazy\" data-src=" + media_url + ">\n" +
                    "      <a href='{{ url('article') }}/" + slug + "' class=\"thumb-url\"></a>\n" +
                    "      <img data-src='\" + media_url + \"' src=\"{{asset('img/empty.png')}}\" alt=\"\" class=\"entry__img d-none\">\n" +
                    "      <a href='{{sportsUrl("")}}" + sportname + "' class=\"entry__meta-category entry__meta-category--label entry__meta-category--align-in-corner entry__meta-category--violet\">" + sportname + "</a>\n" +
                    "    </div>\n" +
                    "\n" +
                    "    <div class=\"entry__body post-list__body card__body\">  \n" +
                    "      <h2 class=\"entry__title\">\n" +
                    "        <a href='{{ url('article') }}/" + slug + "'>" + title + "</a>\n" +
                    "      </h2>\n" +
                    "      <ul class=\"entry__meta\">\n" +
                    "        <li class=\"entry__meta-author\">\n" +
                    "          <span>by</span>\n" +
                    "          <a href='{{ url("profile") }}/" + user_id + "'>" + username + "</a>\n" +
                    "        </li>\n" +
                    "        <li class=\"entry__meta-date\">\n" +
                    "             <time class=\"timeago\">" + publish_date + "</time>\n" +
                    "        </li>\n" +
                    "      </ul>\n" +
                    "    </div>\n" +
                    "  </article>\n" +
                    "</div>\n"

                return key < 2
            });


            if (data.featured_posts[3] != undefined) {


                featurepostmain += "<div class=\"featured-posts-grid__item featured-posts-grid__item--lg\">\n" +
                    "  <article class=\"entry card featured-posts-grid__entry\">\n" +
                    "    <div class=\"entry__img-holder card__img-holder\">\n" +
                    "      <a href='{{ url('article') }}/" + data.featured_posts[3].slug + " ' >\n" +
                    "\n" +
                    "        <img data-src='" + data.featured_posts[3].media_url + "' src=\"{{asset('img/empty.png')}}\" alt=\"\" class=\"entry__img lazy\">\n" +
                    "      </a>\n" +
                    "      <a href='{{sportsUrl("")}}" + data.featured_posts[3].sports_name.toLowerCase() + "' class=\"entry__meta-category entry__meta-category--label entry__meta-category--align-in-corner entry__meta-category--green\">" + data.featured_posts[3].sports_name + "</a>\n" +
                    "    </div>\n" +
                    "\n" +
                    "    <div class=\"entry__body card__body\">\n" +
                    "      <h2 class=\"entry__title\">\n" +
                    "        <a href='{{ url('article') }}/" + data.featured_posts[3].slug + " '>" + data.featured_posts[3].title + "</a>\n" +
                    "      </h2>\n" +
                    "      <ul class=\"entry__meta\">\n" +
                    "        <li class=\"entry__meta-author\">\n" +
                    "          <span>by</span>\n" +
                    "          <a href='{{ url("profile") }}/" + data.featured_posts[3].user_id + "'>" + data.featured_posts[3].user_name + "</a>\n" +
                    "        </li>\n" +
                    "        <li class=\"entry__meta-date\">\n" +
                    "               <time class='timeago'>" + data.featured_posts[3].publish_utc + " </time>\n" +
                    "        </li>\n" +
                    "      </ul>\n" +
                    "    </div>\n" +
                    "  </article>\n" +
                    "</div> <!-- end large post -->\n";

            }


            $("#feature-left").html(featurepost);
            $("#feature-right").html(featurepostmain);


            $.each(data.most_populars, function (key, value) {
                var spotsgram_url = value.sportsgram_url
                var article_url = value.media_url;
                var title = value.title;
                var slug = value.slug;
                var publish_date = value.publish_utc;
                var username = value.user_name;
                var user_id = value.user_id;
                var media_url = "";
                var url = "{{url('article')}}";

                if (spotsgram_url == null || spotsgram_url == ""){

                    media_url = article_url;

                }
                else {
                    media_url = spotsgram_url;
                    url= "{{url('sportsgram')}}";

                }


                trending += "<li class=\"post-list-small__item\">\n" +
                    "                    <article class=\"post-list-small__entry clearfix\">\n" +
                    "                      <div class=\"post-list-small__img-holder\">\n" +
                    "                        <div class=\"thumb-container\">\n" +
                    "                          <a href='"+ url + "/"  + slug + "'>\n" +
                    "                            <img data-src='" + media_url + "' src=\"{{asset('img/empty.png')}}\" alt=\"\" class=\"post-list-small__img--rounded lazy\">\n" +
                    "                          </a>\n" +
                    "                        </div>\n" +
                    "                      </div>\n" +
                    "                      <div class=\"post-list-small__body\">\n" +
                    "                        <h3 class=\"post-list-small__entry-title\">\n" +
                    "                          <a href='"+ url + "/"  + slug + "'>" + title + "</a>\n" +
                    "                        </h3>\n" +
                    "                        <ul class=\"entry__meta\">\n" +
                    "                          <li class=\"entry__meta-author\">\n" +
                    "                            <span>by</span>\n" +
                    "                            <a href='{{ url("profile") }}/" + user_id + "'>" + username + " </a>\n" +
                    "                          </li>\n" +
                    "                          <li class=\"entry__meta-date\">\n" +
                    "                               <time class=\"timeago\">" + publish_date + "</time>\n" +
                    "                          </li>\n" +
                    "                        </ul>\n" +
                    "                      </div>\n" +
                    "                    </article>\n" +
                    "                  </li>";

            });


            $("#trending").html(trending);

            $.each(data.people_choices, function (key, value) {
                //console.log(value)

                if (key === 0) {
                    return;
                }


                var title = value.title;
                var slug = value.slug;

                peoplechoices += " <li class=\"post-list-small__item\">\n" +
                    "                      <article class=\"post-list-small__entry\">\n" +
                    "                        <div class=\"post-list-small__body\">\n" +
                    "                          <h3 class=\"post-list-small__entry-title\">\n" +
                    "                            <a href='{{url("/article")}}/" + slug + "'>" + title + "</a>\n" +
                    "                          </h3>\n" +
                    "                        </div>                  \n" +
                    "                      </article>\n" +
                    "                    </li>";

                return key < 4;
            });

            peoplechoiceleft += "<article class=\"entry thumb thumb--size-2\">\n" +
                "                    <div class=\"entry__img-holder thumb__img-holder lazy\" data-src=" + data.people_choices[0].media_url + ">\n" +
                "                      <div class=\"bottom-gradient\"></div>\n" +
                "                      <div class=\"thumb-text-holder thumb-text-holder--1\">\n" +
                "                        <h2 class=\"thumb-entry-title\">\n" +
                "                          <a href='{{ url("article") }}/" + data.people_choices[0].slug + "'>" + data.people_choices[0].title + " </a>\n" +
                "                        </h2>\n" +
                "                        <ul class=\"entry__meta\">\n" +
                "                          <li class=\"entry__meta-author\">\n" +
                "                            <span>by</span>\n" +
                "                            <a href='{{ url("profile") }}/" + data.people_choices[0].user_id + "'>" + data.people_choices[0].user_name + "</a>\n" +
                "                          </li>\n" +
                "                          <li class=\"entry__meta-date\">\n" +
                "                              <time class=\"timeago\" >" + data.people_choices[0].publish_utc + "  </time> \n" +
                "                          </li>\n" +
                "                        </ul>\n" +
                "                      </div>\n" +
                "                      <a href='{{ url("article")}}/" + data.people_choices[0].slug + "' class=\"thumb-url\"></a>\n" +
                "                    </div>\n" +
                "                  </article>";


            $("#peoplechoices").html(peoplechoices);
            $("#peoplechoice-left").html(peoplechoiceleft);

            $.each(data.editordesks, function (key, value) {

                if (key === 0) {
                    return;
                }


                var title = value.title;
                var slug = value.slug;

                editordesk += " <li class=\"post-list-small__item\">\n" +
                    "                      <article class=\"post-list-small__entry\">\n" +
                    "                        <div class=\"post-list-small__body\">\n" +
                    "                          <h3 class=\"post-list-small__entry-title\">\n" +
                    "                            <a href='{{url("/article")}}/" + slug + "'>" + title + "</a>\n" +
                    "                          </h3>\n" +
                    "                        </div>                  \n" +
                    "                      </article>\n" +
                    "                    </li>";

                return key < 4;
            });

            if (data.editordesks[0] != undefined) {
                editordeskleft += "<article class=\"entry thumb thumb--size-2\">\n" +
                    "                    <div class=\"entry__img-holder thumb__img-holder lazy\" data-src=" + data.editordesks[0].media_url + ">\n" +
                    "                      <div class=\"bottom-gradient\"></div>\n" +
                    "                      <div class=\"thumb-text-holder thumb-text-holder--1\">\n" +
                    "                        <h2 class=\"thumb-entry-title\">\n" +
                    "                          <a href='{{ url("article") }}/" + data.editordesks[0].slug + "'>" + data.editordesks[0].title + " </a>\n" +
                    "                        </h2>\n" +
                    "                        <ul class=\"entry__meta\">\n" +
                    "                          <li class=\"entry__meta-author\">\n" +
                    "                            <span>by</span>\n" +
                    "                            <a href='{{ url("profile") }}/" + data.editordesks[0].user_id + "'>" + data.editordesks[0].user_name + "</a>\n" +
                    "                          </li>\n" +
                    "                          <li class=\"entry__meta-date\">\n" +
                    "                              <time class=\"timeago\">" + data.editordesks[0].publish_utc + "  </time> \n" +
                    "                          </li>\n" +
                    "                        </ul>\n" +
                    "                      </div>\n" +
                    "                      <a href='{{ url("article")}}/" + data.editordesks[0].slug + "' class=\"thumb-url\"></a>\n" +
                    "                    </div>\n" +
                    "                  </article>";

            }


            $("#editordesk").html(editordesk);
            $("#editordesk-left").html(editordeskleft);

            $.each(data.editor_choices, function (key, value) {
                var media_url = value.media_url;
                var title = value.title;
                var slug = value.slug;
                var publish_date = value.publish_utc;
                var username = value.user_name;
                var user_id = value.user_id;
                var descriptiondata = value.description;
                var sportname = value.sports_name.toLowerCase();
                var description = descriptiondata.substring(0, 75) + '...';

                editorChoices += "<div class='col-md-6'><article class=\"entry card ratio4-3\">\n" +
                    "                          <div class=\"entry__img-holder card__img-holder\">\n" +
                    "                            <a href='{{url("article")}}/" + slug + "'>\n" +
                    "                              <div class=\"thumb-container\">\n" +
                    "                              <img data-src=" + media_url + " src=\"{{asset('img/empty.png')}}\" class=\"entry__img lazy img-responsive\" alt=\"\"  />\n" +
                    "                              </div>\n" +
                    "                            </a>\n" +
                    "                            <a href='{{sportsUrl("")}}" + sportname + "' class=\"entry__meta-category entry__meta-category--label entry__meta-category--align-in-corner entry__meta-category--green\">" + sportname + "</a>\n" +
                    "                          </div>\n" +
                    "    \n" +
                    "                          <div class=\"entry__body card__body\">\n" +
                    "                            <div class=\"entry__header\">\n" +
                    "                              \n" +
                    "                              <h2 class=\"entry__title\">\n" +
                    "                                <a href={{ url('article') }}/" + slug + ">" + title + "</a>\n" +
                    "                              </h2>\n" +
                    "                              <ul class=\"entry__meta\">\n" +
                    "                                <li class=\"entry__meta-author\">\n" +
                    "                                  <span>by</span>\n" +
                    "                                  <a href='{{ url("profile") }}/" + user_id + "'>" + username + "</a></li>\n" +
                    "                                <li class=\"entry__meta-date\">\n" +
                    "                                    <time class=\"timeago\">" + publish_date + " </time>\n" +
                    "                                </li>\n" +
                    "                              </ul>\n" +
                    "                            </div>\n" +
                    "                            <div class=\"entry__excerpt\">\n" +
                    "                              <p>" + description + "</p>\n" +
                    "                            </div>\n" +
                    "                          </div>\n" +
                    "                        </article></div>";


            });


            $("#editorChoice").html(editorChoices);
            if (window.location.href.includes("newsletter")) {
                var newslettertop = $('#newsletter').offset().top - 70;

                $('html, body').animate({
                    scrollTop: newslettertop
                }, 'slow');
            }

            var content = "";

            //foreach(var i in data["fans"]){
            $.each(data.fans, function (key, value) {

                //$("#havepost").hide();



                var article_url = value.media_url;
                var sportsgram_url = value.sportsgram_url;

                var title = value.title;
                var slug = value.slug;
                var media_url = "";
                var url = "";
                if (sportsgram_url == null){
                    media_url = article_url;
                    url = "{{url('article')}}";
                }
                if (article_url == null){
                     media_url = sportsgram_url;
                    url = "{{url('sportsgram')}}";
                }






                content += "<article class=\"entry thumb thumb--size-1 \">\n" +
                    "                                <div class=\"entry__img-holder thumb__img-holder lazy\" style='background-image:url(" + media_url + ")' >\n" +
                    "                                  <div class=\"bottom-gradient\"></div>\n" +
                    "                                  <div class=\"thumb-text-holder\">\n" +
                    "                                    <h2 class=\"thumb-entry-title\">\n" +
                    "                                      <a href='"+ url+"/"+slug + "'>" + title + "</a>\n" +
                    "                                    </h2>\n" +
                    "                                  </div>\n" +
                    "                                  <a href='"+url + "/"+ slug +"' class=\"thumb-url\"></a>\n" +
                    "                                </div>\n" +
                    "                              </article>";
                $(".fanscorner").show();
            });

            var fixOwl = function(){
                var $stage = $('.owl-stage'),
                    stageW = $stage.width(),
                    $el = $('.owl-item'),
                    elW = 0;
                $el.each(function() {
                    elW += $(this).width()+ +($(this).css("margin-right").slice(0, -2))
                });
                if ( elW > stageW ) {
                    $stage.width( elW );
                };
            }
            //$("time.timeago").timeago();
            // var nodes = document.querySelectorAll('.timeago');
            // timeago.render(nodes, 'zh_CN');
            $('.lazy').lazy({
                effect: "fadeIn",
                effectTime: 500,
                threshold: 0
            });

            //
            $("#owl-posts").html(content);
            $("#owl-posts").owlCarousel({
                loop: true,
                nav: true,
                dots:false,
                items: 4,
                margin: 25,
                stagePadding:0,
                responsiveClass: true,
                navSpeed: 500,
                onInitialized: fixOwl,
                onRefreshed: fixOwl,
                navText: ['<i class="ui-arrow-left">','<i class="ui-arrow-right">'],
                responsive: {
                    0: {
                        items: 1,
                    },
                    600: {
                        items: 2,
                    },
                    768: {
                        items: 3,
                    },
                    1000: {
                        items: 4,
                    }
                }
            });



            //$("time.timeago").timeago();
            // jQuery.timeago.settings.strings = {
            //     prefixAgo: "",
            //     prefixFromNow: "dentro de",
            //     suffixAgo: "",
            //     suffixFromNow: "",
            //     seconds: "menos Seconds Ago",
            //     minute: "un Minute Ago",
            //   q  minutes: "unos %d Minutes Ago",
            //     hour: "una Hour Ago",
            //     hours: "%d Hours Ago",
            //     day: "un day Ago",
            //     days: "%d DAYS AGO",
            //     month: "un Month Ago",
            //     year: "un Year Ago",
            // };
            // var nodes = document.querySelectorAll('.timeago');
            // timeago.render(nodes, 'zh_CN');
            $('.lazy').lazy({
                effect: "fadeIn",
                effectTime: 500,
                threshold: 0
            });



        }


        $(function () {


            $('.lazy').lazy({
                effect: "fadeIn",
                effectTime: 500,
                threshold: 0
            });
        });

    </script>
    {{-- <script src="https://npmcdn.com/isotope-layout@3/dist/isotope.pkgd.js"></script> --}}
    {{-- <script>
    new GridScrollFx(document.getElementById('grid'), {
        viewportFactor: 0.4
    });
    </script> --}}
@endsection