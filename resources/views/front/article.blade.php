@extends('front.master.main')
@section("title", $data->meta_title)
@section("meta_description", $data->meta_description)
@section("meta_keyword", $data->meta_keyword)
@section("meta_image", $data->media_url)

@section("head_extra")

    <meta name="csrf_token" content="{{ csrf_token() }}"/>

    <style type="text/css">

        .quiz-img{
            position: relative;
        }
        .quiz-img-link{
            position: absolute;
            width: 264px;
            height: 80px;
            /*background: red;*/
            z-index: 2;
            right: 0;
            bottom: 0;
            padding: 0rem 1rem;

        }
        .quiz-img-link .btn{
            background-color: #d2b160;
            padding: .3rem 1rem;
            margin : 1rem 0rem;
        }
        
    </style>

@endsection

@section('content')

    <!-- Share -->
    @php $currentUrl = url()->current(); @endphp

    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.2&appId=1175110762591231';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    
@if(isset($limit))

    <div class="row py-5 text-center">
                
        <div class="col-10 text-center key-benefits">
            <h2 class="heading font-weight-bold mb-5"> key benefits of sportsco+</h2>

            <div class="row  justify-content-around mb-5">
                
                <div class="col-md-6 col-lg-5 py-5">
                    <div class="key-benefits-list">
                        <h3 class="heading mb-5"> Guest </h3>
                        <ul class="list-unstyled mb-0 check-list">
                            <li>1 Featured Article/Day</li>
                            <li>1 Free Quies/day</li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-5 py-5">
                    <div class="key-benefits-list bg-blue">
                        <span class="key-benefits-tag">Early bird Offer</span>

                        <h3 class="heading mb-5 text-white check-icon"> Member  </h3>
                        <ul class="list-unstyled mb-0 check-list">
                            <li> Access to feature Articles</li>
                            <li> Unlimited sportco Quizzes</li>
                            <li> Writing and posting articles</li>
                            <li> Commenting on posts</li>
                            <li> Access to all older articles</li>
                            <li> 50% to discounts on E-books</li>
                            <li> Access to Editor's Desk</li>
                            <li> Euro 2021 Live sccres standings, schedules polls</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-10">
            <div class="end-line"></div>
            <a class="btn btn-lg btn-primary" href="#">Continue</a>
        </div>

    </div>



@else   
    {{-- <div id="topWidget">
        <aside class="widget" id="olympics" style="padding: 3px;height: 500px;">
        
            <iframe id="iframe" src="https://fbwidget.gamapp.tech/sportco" style="width: 100%;border: none;height: 100%;"></iframe>
        </aside>
        
    </div> --}}
        <!-- Breadcrumbs -->
        <div class="container">
            <ul class="breadcrumbs">
                <li class="breadcrumbs__item">
                    <a href="{{ url('/') }}" class="breadcrumbs__url">Home</a>
                </li>
                @if(!empty($data->cat_id))
                <li class="breadcrumbs__item">
                    <a href="{{ categoryUrl(returnConfig('editor desk')) }}"
                        class="breadcrumbs__url">{{ $data->cat_name }}</a>
                </li>
                @endif
                <li class="breadcrumbs__item breadcrumbs__item--current">
                    <a href="{{ sportsUrl($data->sports_name) }}" class="breadcrumbs__url">{{ $data->sports_name }}</a>
                </li>
            </ul>
        </div>
    <div class="main-container container" id="main-container">
        <!-- Entry Image -->
        <div class="entry__img-holder detail-image mb-40">
            <div class="inner-container">
                <img src="{{$data->media_url}}" alt="" class="entry__img">
            </div>
        </div>
        <!-- Content -->
        <div class="row">
            <!-- Post Content -->
            <div class="col-lg-8 blog__content mb-72">
                <div class="content-box content-box--top-offset">
                    <!-- standard post -->
                    <article class="entry mb-0">
                        <div class="single-post__entry-header entry__header">
                            <ul class="entry__meta">
                                <li class="entry__meta-category">
                                    <a href="{{ sportsUrl($data->sports_name) }}">{{$data->sports_name}}</a>
                                </li>
                                <li class="entry__meta-date">
                                    {{$data->date}}
                                </li>
                            </ul>
                            <h1 class="single-post__entry-title">
                                {{ $data->title }}
                            </h1>
                            <div class="entry__meta-holder">
                                <ul class="entry__meta">
                                    <li class="entry__meta-author">
                                        <span>by</span>
                                        <a href="{{ url("profile") }}/{{ $data->user_id }}">{{$data->user_name}}</a>
                                    </li>
                                </ul>
                                <ul class="entry__meta">
                                    <li class="entry__meta-views">
                                        <i class="ui-eye"></i>
                                        <span>{{$data->views ?? 0}}</span>
                                    </li>
                                    <li class="entry__meta-comments">
                                        <a href="#respond">
                                        <i class="ui-chat-empty"></i><span class="fb-comments-count"
                                            data-href="{{ $currentUrl }}"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- end entry header -->
                        <div class="entry__article-wrap">
                            <div class="entry__share">
                                <div class="sticky-col">
                                    <div class="socials socials--rounded socials--large">
                                        <a class="social social-facebook"
                                            href="http://www.facebook.com/sharer.php?u={{ $currentUrl }}"
                                            title="facebook" target="_blank" aria-label="facebook">
                                        <i class="ui-facebook"></i>
                                        </a>
                                        <a class="social social-twitter"
                                            href="http://twitter.com/share?text={{ $data->title }}&url={{ $currentUrl }}"
                                            title="twitter" target="_blank" aria-label="twitter">
                                        <i class="ui-twitter"></i>
                                        </a>
                                        <a class="social social-google-plus"
                                            href="https://plus.google.com/share?url={{ $currentUrl }}" title="google"
                                            target="_blank" aria-label="google">
                                        <i class="ui-google"></i>
                                        </a>
                                        <a class="social social-pinterest"
                                            href="//pinterest.com/pin/create/%20button?url=={{ $currentUrl }}&amp;media={{ $data->media_url }}&amp;description={{ $data->title }}"
                                            data-pin-do="buttonPin" data-pin-custom="true" title="pinterest"
                                            target="_blank" aria-label="pinterest">
                                        <i class="ui-pinterest"></i>
                                        </a>
                                        <hr/>
                                        @if(auth()->check() == false || auth()->user()->type == returnConfig("user"))
                                        <a class="social btn-dark favPost @auth @if(!empty($data->ifav)) fill @endif @endauth"
                                            href="javascript:void(0)" title="Favorite" aria-label="pinterest"
                                            @guest data-toggle="modal" data-target="#loginModal" @endguest>
                                        <i class="far fa-heart"></i>
                                        </a>
                                        <a class="social social-instagram likePost @auth @if(!empty($data->iliked)) fill @endif @endauth"
                                            href="javascript:void(0)" title="Like" aria-label="pinterest"
                                            @guest data-toggle="modal" data-target="#loginModal" @endguest>
                                        <i class="far fa-thumbs-up"></i>
                                        <span class="socail_badge">{{ $data->likes ?? 0 }}</span>
                                        </a> @endif
                                    </div>
                                </div>
                            </div>
                            
                            


                            <!-- share -->
                            <div class="entry__article">

                                


                                <p>{!! $data->description !!}</p>
                                @if(!empty($data->tag_name))
                                <!-- tags -->
                                <div class="entry__tags">
                                    <i class="ui-tags"></i>
                                    <span class="entry__tags-label">Tags role:</span>
                                    @php $tags = explode(",",$data->tag_name); @endphp
                                    @foreach ($tags as $tag)
                                    <a href="javascript:void(0);" rel="tag">{{ $tag }}</a>
                                    @endforeach
                                </div>
                                <!-- end tags -->
                                @endif
                                @if(!empty($data->temp_name))
                                <div class="entry__tags">
                                    <i class="ui-tags"></i>
                                    <span class="entry__tags-label">Suggested Tags:</span>
                                    @php $temp_tags = explode(",",$data->temp_name); @endphp
                                    @foreach ($temp_tags as $temp_tag)
                                    <a href="javascript:void(0);" rel="tag">{{ $temp_tag }}</a>
                                    @endforeach
                                </div>
                                <!-- end tags -->
                                @endif
                            </div>
                            <!-- end entry article -->
                        </div>
                        <!-- end entry article wrap -->
                        <!-- Prev / Next Post -->
                        <div class="quiz-img">
                            <div class="quiz-img-link d-flex justify-content-between">
                                <span><a href="" class="btn">register</a></span>
                                <span><a href="" class="btn">login</a></span>
                            </div>

                                <img src="{{ asset('img/quiz-mid2.png') }}">
                        </div>

                        <nav class="entry-navigation">
                            <div class="clearfix">
                                @if(!empty($previous[0]->prev) || !empty($previous[1]->prev))
                                    <div class="entry-navigation--left">
                                        <i class="ui-arrow-left"></i>
                                        <span class="entry-navigation__label">
                                        @if($previous[0]->type == returnConfig("type") )
                                            <a href="{{ url("article") }}/{{$previous[0]->prev ?? $previous[1]->prev }}"> Previous Post </a></span>
                                        @elseif($previous[0]->type == returnConfig("sportsgramtype") )
                                            <a href="{{ url("sportsgram") }}/{{$previous[0]->prev ?? $previous[1]->prev }}">
                                            Previous Post </a></span>
                                        @endif
                                        <div class="entry-navigation__link">
                                            {{$previous[0]->title ?? $previous[0]->title}}
                                        </div>
                                    </div>
                                @endif

                                @if(!empty($previous[1]->next) || !empty($previous[0]->next))
                                    <div class="entry-navigation--right">
                                        <span class="entry-navigation__label">
                                        @if(!empty($previous[1]) && !empty($previous[0]))
                                        @if($previous[1]->type == returnConfig("type") )
                                        <a href="{{ url("article") }}/{{$previous[1]->next ?? $previous[0]->next}}">Next Post</a></span>
                                        @elseif($previous[1]->type == returnConfig("sportsgramtype") )
                                        <a href="{{ url("sportsgram") }}/{{$previous[1]->next ?? $previous[0]->next}}">Next
                                        Post</a></span>
                                        @endif
                                        @else
                                        @if($previous[0]->type == returnConfig("type") )
                                        <a href="{{ url("article") }}/{{$previous[0]->next}}">Next
                                        Post</a></span>
                                        @elseif($previous[1]->type == returnConfig("sportsgramtype") )
                                        <a href="{{ url("sportsgram") }}/{{$previous[0]->next}}">Next
                                        Post</a></span>
                                        @endif
                                        @endif
                                        <i class="ui-arrow-right"></i>
                                        <div class="entry-navigation__link">
                                            {{$previous[1]->title ?? $previous[0]->title}}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </nav>
                        <!-- Author -->
                        <div class="entry-author clearfix">
                            <img alt="" height="100" width="100"
                                data-src="{{ authorPic($data->user_pic) }}"
                                src="{{ authorPic($data->user_pic) }}"
                                class="avatar lazyload">
                            <div class="entry-author__info">
                                <h6 class="entry-author__name">
                                    <a href="{{ url("profile") }}/{{ $data->user_id }}">{{$data->user_name}}</a>
                                </h6>
                                <p class="mb-0">{{ $data->user_desc }}</p>
                            </div>
                        </div>
                        
                        @if(!empty($related->count()))
                            <!-- Related Posts -->
                            <section class="section related-posts mt-40 mb-0">
                                <div class="title-wrap title-wrap--line title-wrap--pr">
                                    <h3 class="section-title">Related Articles</h3>
                                </div>
                                <!-- Slider -->
                                <div id="owl-posts-3-items" class="owl-carousel owl-theme owl-carousel--arrows-outside">
                                    @foreach ($related as $post)
                                    <article class="entry thumb thumb--size-1">
                                        <div class="entry__img-holder thumb__img-holder"
                                            style="background-image: url('{{$post->media_url}}');">
                                            <div class="bottom-gradient"></div>
                                            <div class="thumb-text-holder">
                                                <h2 class="thumb-entry-title">
                                                    <a href="{{ url("article") }}/{{ $post->slug  }}">{{$post->title}}</a>
                                                </h2>
                                            </div>
                                            <a href="{{ url("article") }}/{{ $post->slug }}" class="thumb-url"></a>
                                        </div>
                                    </article>
                                    @endforeach
                                </div>
                                <!-- end slider -->
                            </section>
                            <!-- end related posts -->
                        @endif

                        @if(!empty($quizs))
                            <section class="section related-posts mt-40 mb-0">
                                <div class="title-wrap title-wrap--line title-wrap--pr">
                                    <h3 class="section-title">Play</h3>
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
                                                <a href="{{ url("play/game/detail",[$quiz->slug ]) }}"
                                                class="thumb-url"></a>
                                            </div>
                                        </article>
                                    </div>
                                    @endforeach
                                </div>
                            </section>
                            <!-- end Play -->
                        @endif
                    </article>
                    <!-- end standard post -->
                    <!-- Comment Form -->
                    <div id="respond" class="comment-respond">
                        <div class="title-wrap">
                            <h5 class="comment-respond__title section-title">Leave a Reply</h5>
                        </div>
                        <div class="title-wrap title-wrap--line">
                            <div class="fb-comments" data-width="100%" data-href="{{ $currentUrl }}"
                                data-numposts="5"></div>
                        </div>
                    </div>
                    <!-- end comment form -->
                </div>
                <!-- end content box -->
                <div class="stop-scroller"></div>
            </div>
            <!-- end post content -->
            @include("front.partials.right_sidebar")
        </div>
        <!-- end content -->
    </div>
    <!-- end main container -->
    <div id="back-to-top">
        <a href="#top" aria-label="Go to top"><i class="ui-arrow-up"></i></a>
    </div>
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe src="https://ie.sportswizzleague.biz/" id="ie_frame" height="900px" width="100%" frameborder="0"></iframe>
                    {{--<iframe src="http://localhost/web_ie_widget/public/" id="ie_frame" height="900px" width="100%" frameborder="0"></iframe>--}}
                </div>
            </div>
        </div>
    </div>

@endif

    @guest
        @include("front.partials.login_modal")
    @endguest

@endsection
@section('script_extra')

    <script type="text/javascript">

        $(function () {
            $(window).scroll(moveScroller);
            moveScroller();
        });

        $(document).ready(function () {

            @auth

            $(document).on("click", ".likePost", function () {

                if ($('.likePost').hasClass('.fill')) {

                } else {
                    $('.likePost i').removeClass("far fa-thumbs-up");
                    $('.likePost i').addClass("fas fa-spinner fa-spin");
                }

                var $type = 0;

                var $this = $(this);

                if ($this.hasClass("fill")) {

                    $type = 1;

                }

                $.ajax({
                    "type": "POST",
                    "data": {"ajax": 1, "type": $type},
                    "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    "success": function (response) {

                        if (response.status == 1) {
                            $('.likePost i').addClass("far fa-thumbs-up");
                            $('.likePost i').removeClass("fas fa-spinner fa-spin");

                            if ($type == 1) {

                                $this.removeClass("fill");

                                $this.find("span").html(parseInt($this.find("span").html()) - 1);
                            } else {

                                $this.addClass("fill");

                                $this.find("span").html(parseInt($this.find("span").html()) + 1);
                            }


                        }

                    }
                });

            });

            $(document).on("click", ".favPost", function () {


                if ($('.favPost').hasClass('.fill')) {
                    alert("asdfasfd");
                } else {
                    $('.favPost i').removeClass("far fa-heart");
                    $('.favPost i').addClass("fas fa-spinner fa-spin");
                }
                var $type = 0;

                var $this = $(this);

                if ($this.hasClass("fill")) {

                    $type = 1;

                }

                $.ajax({
                    "type": "POST",
                    "data": {"ajax": 2, "type": $type},
                    "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    "success": function (response) {

                        if (response.status == 1) {
                            $('.favPost i').addClass("far fa-heart");
                            $('.favPost i').removeClass("fas fa-spinner fa-spin");

                            if ($type == 1) {

                                $this.removeClass("fill");

                            } else {

                                $this.addClass("fill");

                            }

                        }

                    }
                });

            });

            @endauth

            $("oembed").each(function (key, value) {

                var oembed = $(this).attr("url");
                var url = "https://publish.twitter.com/oembed?url=" + oembed;
                var twitter = "twitter.com";
                var facebook = "facebook.com";
                var instagramMatches = oembed.match(/(?:(?:http|https):\/\/)?(?:www.)?(?:instagram.com|instagr.am)\/[p]\/([A-Za-z0-9-_]*)\//g);
                var media = $(this).parent();

                if (oembed.indexOf(twitter) != -1) {


                    $.ajax({
                        url: url,
                        type: 'GET',
                        crossDomain: true,
                        dataType: 'jsonp',
                        success: function (result) {
                            var html = result.html;
                            media.html(html);
                        },
                        error: function () {
                        },
                        beforeSend: setHeader
                    });

                    function setHeader(xhr) {
                        xhr.setRequestHeader('Authorization', '@csrf');
                    }

                }else if (instagramMatches != null ){

                    //var url1 = "https://api.instagram.com/oembed/?maxwidth=400&callback=?&url="+matches[0] ;
                    fetch("https://api.instagram.com/oembed/?url=" + instagramMatches[0])
                        .then(function(response){

                            return response.json()
                        })
                        .then(function(json){
                            var html = json.html;
                            media.html(html);
                        })


                }
                else if(oembed.indexOf(facebook) != -1){
                        $(this).parent().html('<div class="fb-video" data-href="'+oembed+'" data-allowfullscreen="true" data-width="500"></div>');
                }
                else{

                    $(this).parent().html('<iframe width="560" height="315" src="https://www.youtube.com/embed/' +
                        $(this).attr("url").split("=")[1] + '" frameborder="0" ' +
                        'allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>' +
                        '</iframe>');

                }




            });


        });

    </script>

    <script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>
@endsection
