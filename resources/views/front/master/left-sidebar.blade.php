<!-- Sidenav -->
<header class="sidenav" id="sidenav">

    <{{-- script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- sportco-ad-350x350 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6239837178715306"
     data-ad-slot="8926537442"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script> --}}

    <!-- close -->
    <div class="sidenav__close">
        <button class="sidenav__close-button" id="sidenav__close-button" aria-label="close sidenav">
            <i class="ui-close sidenav__close-icon"></i>
        </button>
    </div>

    <!-- Nav -->
    <nav class="sidenav__menu-container">
        <ul class="sidenav__menu" role="menubar">
            <li>
                <a href="{{ url("/") }}" class="sidenav__menu-url">Home</a>
            </li>
            <li>
                <a href="{{ route('play-game') }}" class="sidenav__menu-url">Play</a>
            </li>
            <li>
                <a href="{{ route('store') }}" class="sidenav__menu-url">Store <label class="badge badge-success">New</label></a>
            </li>
            <li>
                <a href="#" class="sidenav__menu-url">Sports</a>
                <button class="sidenav__menu-toggle" aria-haspopup="true" aria-label="Open dropdown"><i class="ui-arrow-down"></i></button>
                <ul class="sidenav__menu-dropdown">
                    @foreach(getSports() as $sport)
                        <li><a href="{{ sportsUrl($sport->name) }}" class="sidenav__menu-url">{{ $sport->name }}</a></li>
                    @endforeach
                </ul>
            </li>
            <!-- Categories -->
            <li>
                <a href="{{ sectionsUrl(returnConfig('editors_choice')) }}" class="sidenav__menu-url">Editor's Choice</a>
            </li>
            <li>
                <a href="{{ sectionUrl(returnConfig('orderBy')) }}" class="sidenav__menu-url">People's Choice</a>
            </li>
            <li>
                <a href="{{route('sportsgram')}}" class="sidenav__menu-url">Sportsgram <label class="badge badge-success">New</label></a>
                {{-- {{ url("category") }}/{{returnConfig('sportsgram')}} --}}
            </li>
            <li>
                <a href="javascript:void(0);" class="sidenav__menu-url">Videos <label class="badge badge-danger">Coming Soon</label></a>
                {{-- {{ url("category") }}/{{returnConfig('videos')}} --}}
            </li>
            
            <li>
                <a href="{{ categoryUrl(returnConfig('editor desk')) }}" class="sidenav__menu-url">Editor's Desk</a>
            </li>
            {{-- <li>
                    <a href="{{ url("post-listing") }}/{{returnConfig('type')}}" class="sidenav__menu-url">Fans Corner</a>
                </li> --}}
            <li>
                <a href="{{ url('about') }}" target="_blank" class="sidenav__menu-url">About</a>
            </li>
            @guest
            <li>
                <a href="{{ route('register') }}" class="sidenav__menu-url">Register</a>
            </li>
            <li>
                <a href="{{ route('login') }}" class="sidenav__menu-url">Login</a>
            </li>
            @endguest
            @auth
            @if(auth()->user()->type == returnConfig("user"))
            <li class="add-postlink"><a class="sidenav__menu-url" href="{{ url('profile') }}/{{ auth()->user()->nickname }}">Tokens: {{ userTokens(auth()->id()) }}</a></li>
            <li class="add-postlink"><a class="sidenav__menu-url" href="{{ url('post') }}">New Post</a></li>
            <li>
                <a href="{{ url('profile') }}/{{ auth()->user()->nickname }}" class="sidenav__menu-url">Profile</a>
            </li>
            @endif
            @if(auth()->user()->type == returnConfig("admin"))
            <li>
                <a href="{{ url('dashboard') }}" class="sidenav__menu-url">Dashboard <label class="badge badge-warning">Admin</label></a>
            </li>
            @endif
                <li>
                    <a class="sidenav__menu-url" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          style="display: none;">
                        @csrf
                    </form>
                </li>
            @endauth
        </ul>
    </nav>

    <div class="socials sidenav__socials">
        <a class="social social-facebook" href="javascript:void(0)" aria-label="facebook">
            <i class="ui-facebook"></i>
        </a>
        <a class="social social-twitter" href="javascript:void(0)" aria-label="twitter">
            <i class="ui-twitter"></i>
        </a>
        <a class="social social-medium" href="javascript:void(0)" aria-label="medium">
            <i class="fab fa-medium-m"></i>
        </a>
        <a class="social social-linkedin" href="javascript:void(0)" aria-label="linkedin">
            <i class="ui-linkedin"></i>
        </a>
        <a class="social social-slack" href="javascript:void(0)" aria-label="slack">
            <i class="ui-slack"></i>
        </a>
        <a class="social social-telegram" href="javascript:void(0)" aria-label="telegram">
            <i class="fab fa-telegram-plane"></i>
        </a>
    </div>
</header> <!-- end sidenav -->