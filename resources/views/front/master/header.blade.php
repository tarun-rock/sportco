{{-- <div class="modal result-container" id="started">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="row py-5 text-center">
                    <div class="col-12" id="model_div">

                      <div class="col-12 text-center">
                        <h2 class="heading"> Get Euro Features with Sportco Plus!</h2>
                        <p class="text-dark font-weight-semibold">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod libero amet, laborum qui nulla quae alias tempora. Placeat voluptatem eum numquam quas distinctio obcaecati quaerat,  doloribus! Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>

                        <a class="btn btn-lg btn-primary" href="{{ url('register') }}">Join Now</a>
                      </div>

                    </div>
                </div>
            </div>
        </div>
    </div> --}}

<main class="main oh modal-open" id="main">

    <!-- Top Bar -->
    <div class="top-bar d-none d-lg-block">
        <div class="container">
            <div class="row">

                <!-- Top menu -->
                <div class="col-lg-6">
                    <ul class="top-menu">
                        <li @if(empty($play_head) && empty($store)) class="active" @endif><a
                                    href="{{ url('/') }}">Publish @if(empty($play_head) && empty($store))
                                    <div class="arrow-down"></div> @endif</a></li>
                        <li @if(!empty($play_head)) class="active" @endif><a
                                    href="{{ route('play-game') }}">Play @if(!empty($play_head))
                                    <div class="arrow-down"></div> @endif </a></li>
                        {{-- <li @if(!empty($store)) class="active" @endif><a
                                    href="{{ route('store') }}">Store @if(!empty($store))
                                    <div class="arrow-down"></div> @endif </a></li> --}}


                        {{--<li><a href="https://tokensale.sportco.io">Token Sale</a></li>--}}
                        @auth
                            @if(auth()->user()->type == returnConfig("admin"))
                                <li class="hover"><a href="{{ url('dashboard') }}" class="">Dashboard &nbsp;<span
                                                class="blinking badge badge-warning">admin</span></a></li>
                            @endif
                            {{-- <li>
                                <a href="{{route('cartDetail')}}">
                                    <i class="fas fa-shopping-cart"></i> Cart
                                    @if(Cart::instance('default')->count() > 0)
                                        <span class="badge badge-success badge-pill">{{Cart::instance('default')->count()}}</span>
                                    @endif
                                </a>
                            </li> --}}
                        @endauth
                    </ul>
                </div>

                <!-- Socials -->
                <div class="col-lg-6">

                    <div class="socials nav__socials socials--nobase socials--white justify-content-end">
                            <a class="social" href="javascript:void(0)" style="width:78px">
                                Need help?
                            </a>

                        <a class="social social-facebook" href="javascript:void(0)"
                           aria-label="facebook">
                            <i class="ui-facebook"></i>
                        </a>
                        <a class="social social-twitter" href="javascript:void(0)" 
                           aria-label="twitter">
                            <i class="ui-twitter"></i>
                        </a>
                        <a class="social social-youtube" href="javascript:void(0)"
                           aria-label="youtube">
                            <i class="ui-youtube"></i>
                        </a>
                        {{--<a class="social social-medium" href="https://medium.com/@social_72044" target="_blank"><i
                                    class="fab fa-medium-m"></i></a>--}}
                        <a class="social" href="javascript:void(0)">
                            <i class="fab fa-linkedin-in"></i></a>
                        {{--<a class="social" href="http://sportcoworkspace.slack.com/" target="_blank"><i
                                    class="fab fa-slack-hash"></i></a>--}}

                        <a class="social" href="javascript:void(0)"><i
                                    class="fab fa-telegram-plane"></i></a>

                    </div>
                </div>

            </div>
        </div>
    </div> <!-- end top bar -->

    <!-- Navigation -->
    <header class="nav">

        <div class="nav__holder nav--sticky">
            <div class="container relative">
                <div class="flex-parent">

                    <!-- Side Menu Button -->
                    <button class="nav-icon-toggle" id="nav-icon-toggle" aria-label="Open side menu">
                    <span class="nav-icon-toggle__box">
                      <span class="nav-icon-toggle__inner"></span>
                    </span>
                    </button>

                    <!-- Logo -->
                    {{-- <a href="{{url('/')}}" class="logo">
                        <img class="logo__img" src="{{asset('images/sportco_black-01.svg')}}"
                              alt="logo">
                    </a> --}}

                    <!-- Nav-wrap -->
                    <nav class="flex-child nav__wrap d-none d-xl-block">
                        <ul class="nav__menu">
                            <li><a href="{{url('/')}}">Home</a></li>
                            {{--<li><a href="{{ route('index') }}/live-score">Live Score</a></li>--}}

                            @include("front.partials.mega_menu")
                            <li><a href="{{ route('play-game') }}">Play</a></li>

                        </ul> <!-- end menu -->
                    </nav> <!-- end nav-wrap -->

                    <!-- Nav Right -->
                    <div class="nav__right">
                        <ul class="nav__menu login-links">
                            <li>
                                <!-- Search -->
                                <div class="nav__right-item nav__search">
                                    <a href="#" data-toggle="tooltip" title="Search" class="nav__search-trigger"
                                       id="nav__search-trigger">
                                        {{-- <i class="ui-search nav__search-trigger-icon"></i> --}}
                                        <img src="{{asset('images/Icon-01.png')}}"/>
                                    </a>
                                    <div class="nav__search-box" id="nav__search-box">
                                        <form class="nav__search-form" action="{{ url('search') }}">
                                            <input type="text" required name="term" placeholder="Search an Article or Game"
                                                   class="nav__search-input">
                                            <button type="submit" class="search-button btn btn-lg btn-color btn-button">
                                                <i class="ui-search nav__search-icon"></i>
                                            </button>&nbsp;
                                        </form>
                                    </div>
                                </div>
                            </li>

                            @guest
                                <li><a data-toggle="tooltip" title="Register" href="{{ route('register') }}"><img
                                                src="{{asset('images/Icon-05.png')}}"/></a></li>
                                <li><a data-toggle="tooltip" title="Login" href="{{ route('login') }}"><img
                                                src="{{asset('images/Icon-04.png')}}"/></a></li>

                            @endguest
                            @auth

                                <li><a data-toggle="tooltip" title="Add Post" href="{{ url('post') }}"><img
                                                src="{{asset('images/Icon-02.png')}}"/></a></li>
                                <li>
                                    <a class="" data-toggle="tooltip" title="Logout" id="logout-btn"
                                       href="javascript:void(0);"
                                       onclick="">
                                        <img src="{{asset('images/Icon-03.png')}}"/>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </li>


                                @if(empty(auth()->user()->nickname))
                                    <li>
                                        <a style="line-height: 1" data-toggle="tooltip" title="Tokens"
                                           href="{{ url('profile')}}/{{strtolower(preg_replace('/\s+/', '',  auth()->user()->name ))}}"><span class="small"><i
                                                        class="fas fa-ticket-alt d-block"></i>{{  userTokens(auth()->id()) }} Tokens
                                        </span></a>
                                    </li>
                                    @else
                                    <li>

                                        <a style="line-height: 1" data-toggle="tooltip" title="Tokens"
                                           href="{{ url('profile') }}/{{strtolower(auth()->user()->nickname)}}"><span class="small"><i
                                                        class="fas fa-ticket-alt d-block"></i>{{  userTokens(auth()->id()) }} Tokens
                                        </span></a>
                                    </li>
                                @endif



                            @endauth

                        </ul>


                    </div> <!-- end nav right -->

                </div> <!-- end flex-parent -->
            </div> <!-- end container -->

        </div>
    </header> <!-- end navigation -->


    <!-- Modal -->
    <div id="overlaymodel"></div>
    <div class="modal fade show terms_full_body" id="profile-update" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Review our <a
                                href="https://play.sportco.io/terms" class="link-tos" target="_blank">Terms &
                            Conditions</a>, <a href="https://play.sportco.io/privacy" class="link-tos" target="_blank">Privacy
                            Policy</a> and <a href="https://play.sportco.io/privacy" class="link-tos" target="_blank">Cookie
                            Policy</a>.</h5>
                </div>
                <form action="" id="updateForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="terms_popup_abc">
                            <p class="terms-p-head">What do we use cookies for?</p>
                            <p class="terms-p">We use cookies and similar technologies to recognize your repeat visits
                                and preferences, as well as to measure the effectiveness of campaigns and analyze
                                traffic. To learn more about cookies, including how to disable them, view our <a
                                        href="https://play.sportco.io/privacy" class="link-tos" target="_blank">Cookie
                                    Policy</a>.</p>
                            <p class="terms-p">By clicking "I ACCEPT" on this banner or using our site, you consent to
                                the use of cookies unless you have disabled them.</p>

                        </div><!-- invite_popup_abc -->
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <input type="button" id="accept_this" value="i accept" class="sub2 btn btn-lg btn-color">
                    </div>

                </form>
            </div>
        </div>
    </div>