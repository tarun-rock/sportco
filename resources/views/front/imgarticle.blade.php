@extends('front.master.main')
@section("title", $post->meta_title)
@section("meta_description", $post->meta_description)
@section("meta_keyword", $post->meta_keyword)
@section("meta_image", $mediaUrl[0])
@section('head_extra')
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" type="text/css" href="{{url('css/sportsgram.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('/css/jquery.fancybox.min.css')}}"/>
    {{--<script src="{{url('js/modernizr.custom.js')}}"></script>--}}
@endsection

@section('content')
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
    <div class="container">
        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="{{ url('/') }}" class="breadcrumbs__url">Home</a>
            </li>

            <li class="breadcrumbs__item">
                <a href="{{ route("sportsgram") }}" class="breadcrumbs__url">Sportsgram</a>
            </li>

            <li class="breadcrumbs__item breadcrumbs__item--current">
                <a href="{{ sportsUrl($post->sports_name) }}" class="breadcrumbs__url">{{$post->sports_name}}</a>
            </li>
        </ul>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 blog__content mb-72">
                <div class="content-box">
                    <div class="entry mb-0">
                        <div class="single-post__entry-header entry__header">
                            <ul class="entry__meta">
                                <li class="entry__meta-category">
                                    <a href="{{ sportsUrl($post->sports_name) }}">{{$post->sports_name}}</a>
                                </li>
                                <li class="entry__meta-date">

                                    {{--{{ parsePostDate($post->created_at)  }}--}}
                                    {{ $post->date  }}
                                </li>
                            </ul>
                            <h1 class="single-post__entry-title">{{$post->title}}

                            </h1>
                            <div class="entry__meta-holder">
                                <ul class="entry__meta">
                                    <li class="entry__meta-author">
                                        <span>by</span>
                                        <a href="{{ url("profile") }}/{{ $post->user_id }}">{{$post->user_name}}</a>
                                    </li>
                                </ul>
                                <ul class="entry__meta">
                                    <li class="entry__meta-views">
                                        <i class="ui-eye"></i>
                                        <span>{{$post->views ?? 0}}</span>
                                    </li>
                                    <li class="entry__meta-comments">
                                        <a href="#respond">
                                            <i class="ui-chat-empty"></i><span class="fb-comments-count" data-href="{{ $currentUrl }}"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="entry__article-wrap">
                            <div class="entry__share" style="max-width: 50px">
                                <div class="sticky-col">
                                    <div class="socials socials--rounded socials--large">
                                        <a class="social social-facebook" href="http://www.facebook.com/sharer.php?u={{ $currentUrl }}"
                                           title="facebook" target="_blank" aria-label="facebook">
                                            <i class="ui-facebook"></i>
                                        </a>
                                        <a class="social social-twitter" href="http://twitter.com/share?text={{ $post->title }}&url={{ $currentUrl }}" title="twitter" target="_blank" aria-label="twitter">
                                            <i class="ui-twitter"></i>
                                        </a>
                                        <a class="social social-google-plus" href="https://plus.google.com/share?url={{ $currentUrl }}" title="google" target="_blank" aria-label="google">
                                            <i class="ui-google"></i>
                                        </a>
                                        <a class="social social-pinterest" href="//pinterest.com/pin/create/%20button?url=={{ $currentUrl }}&amp;media={{ $mediaUrl[0]   }}&amp;description={{ $post->title }}" data-pin-do="buttonPin" data-pin-custom="true"  title="pinterest" target="_blank" aria-label="pinterest">
                                            <i class="ui-pinterest"></i>
                                        </a>
                                        <hr/>
                                        @if(auth()->check() == false || auth()->user()->type == returnConfig("user"))
                                            <a class="social btn-dark favPost @auth @if(!empty($post->ifav)) fill @endif @endauth" href="javascript:void(0)" title="Favorite" aria-label="pinterest" @guest data-toggle="modal" data-target="#loginModal" @endguest>
                                                <i class="far fa-heart"></i>
                                            </a>
                                            <a class="social social-instagram likePost @auth @if(!empty($post->iliked)) fill @endif @endauth" href="javascript:void(0)" title="Like" aria-label="pinterest" @guest data-toggle="modal" data-target="#loginModal" @endguest>
                                                <i class="far fa-thumbs-up"></i>
                                                <span class="socail_badge">{{ $post->likes ?? 0 }}</span>
                                            </a> @endif
                                    </div>
                                </div>
                            </div>
                            <div class="entry__article" style="width: 100%">
                                <ul class="grid effect-1 p-0" id="griddddd">
                                    @foreach($mediaUrl as $media)
                                        <li><a class="thumbnail fancybox" rel="ligthbox" href="{{$media}}"><img
                                                        src="{{$media}}"></a></li>
                                    @endforeach

                                </ul>
                            </div>
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
                                                <a href="{{ url("sportsgram") }}/{{$previous[0]->prev ?? $previous[1]->prev }}"> Previous Post </a></span>
                                            @endif

                                        <div class="entry-navigation__link">
                                            {{$previous[0]->title ?? $previous[0]->title}}
                                        </div>
                                    </div>
                                @endif
                                @if(!empty($previous[1]->next) || !empty($previous[0]->next))
                                    <div class="entry-navigation--right">
                                        <span class="entry-navigation__label">

                                            @if($previous[1]->type == returnConfig("type") )
                                                <a href="{{ url("article") }}/{{$previous[1]->next ?? $previous[0]->next}}">Next Post</a></span>
                                        @elseif($previous[1]->type == returnConfig("sportsgramtype") )
                                                <a href="{{ url("sportsgram") }}/{{$previous[1]->next ?? $previous[0]->next}}">Next Post</a></span>

                                        @endif



                                        <i class="ui-arrow-right"></i>
                                        <div class="entry-navigation__link">
                                            {{$previous[1]->title ?? $previous[0]->title}}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </nav>

                        <div class="entry-author clearfix">
                            <img alt="" height="100" width="100"
                                 data-src="{{ authorPic($post->user_pic) }}"
                                 src="{{ authorPic($post->user_pic) }}"
                                 class="avatar lazyload">
                            <div class="entry-author__info">
                                <h6 class="entry-author__name">
                                    <a href="{{ url("profile") }}/{{ $post->user_id }}">{{$post->user_name}}</a>
                                </h6>
                                <p class="mb-0">{{ $post->user_desc }}</p>
                            </div>
                        </div>

                        <!-- Comment Form -->
                        <div id="respond" class="comment-respond">
                            <div class="title-wrap">
                                <h5 class="comment-respond__title section-title">Leave a Reply</h5>
                            </div>
                            <div class="title-wrap title-wrap--line">
                                <div class="fb-comments" data-width="100%" data-href="{{ $currentUrl }}"
                                     data-numposts="5"></div>

                            </div>
                        </div> <!-- end comment form -->
                    </div>
                </div>
            </div>
            @include("front.partials.right_sidebar")
        </div>
    </div>
    @guest
        @include("front.partials.login_modal")
    @endguest
@endsection

@section('script_extra')

    <script src="{{url('js/masonry.pkgd.min.js')}}"></script>
    <script src="{{url('js/imagesloaded.js')}}"></script>
    <script src="{{url('js/classie.js')}}"></script>
    <script src="{{url('js/AnimOnScroll.js')}}"></script>
    <script src="{{url('js/jquery.fancybox.min.js')}}"></script>


    <script>
        $(".fancybox").fancybox({
            /*openEffect: "none",
            closeEffect: "none"*/
            'transitionIn': 'fade',
            'transitionOut': 'fade',
            'speedIn': 600,
            'speedOut': 200,
            'overlayShow': false

        });
        new AnimOnScroll(document.getElementById('griddddd'), {
            minDuration: 0.4,
            maxDuration: 0.7,
            viewportFactor: 0.2
        });

        $(document).ready(function () {
            @auth

            $(document).on("click",".likePost", function () {

                if ($('.likePost').hasClass('.fill')){

                }
                else{
                    $('.likePost i').removeClass("far fa-thumbs-up");
                    $('.likePost i').addClass("fas fa-spinner fa-spin");
                }

                var $type = 0;

                var $this = $(this);

                if($this.hasClass("fill"))
                {

                    $type = 1;

                }

                $.ajax({
                    "type":"POST",
                    "data": {"ajax": 1, "type" : $type},
                    "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    "success":function(response){

                        if(response.status == 1)
                        {
                            $('.likePost i').addClass("far fa-thumbs-up");
                            $('.likePost i').removeClass("fas fa-spinner fa-spin");

                            if($type == 1)
                            {

                                $this.removeClass("fill");

                                $this.find("span").html(parseInt($this.find("span").html()) - 1);
                            }
                            else
                            {

                                $this.addClass("fill");

                                $this.find("span").html(parseInt($this.find("span").html()) + 1);
                            }


                        }

                    }
                });

            });

            $(document).on("click",".favPost", function () {


                if ($('.favPost').hasClass('.fill')){
                    alert("asdfasfd");
                }
                else{
                    $('.favPost i').removeClass("far fa-heart");
                    $('.favPost i').addClass("fas fa-spinner fa-spin");
                }
                var $type = 0;

                var $this = $(this);

                if($this.hasClass("fill"))
                {

                    $type = 1;

                }

                $.ajax({
                    "type":"POST",
                    "data": {"ajax": 2, "type" : $type},
                    "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    "success":function(response){

                        if(response.status == 1)
                        {
                            $('.favPost i').addClass("far fa-heart");
                            $('.favPost i').removeClass("fas fa-spinner fa-spin");

                            if($type == 1)
                            {

                                $this.removeClass("fill");

                            }
                            else
                            {

                                $this.addClass("fill");

                            }

                        }

                    }
                });

            });
            @endauth

        });

    </script>
    <!-- For the demo ad -->

@endsection
