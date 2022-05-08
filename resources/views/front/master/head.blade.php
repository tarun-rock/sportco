<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <meta property="fb:app_id" content="1175110762591231"/>
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:title" content="@yield("title","SportCo Publish")"/>
    <meta property="og:description" content="@yield("meta_description","Description")"/>
    <meta name="keywords" content="@yield("meta_keyword","")"/>
    <meta property="og:image" content="@yield("meta_image","")"/>
    <meta property="og:type" content="website"/>
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@Sportcoio" />
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="@yield("title","SportCo Publish")">
    <meta name="twitter:description" content="@yield("meta_description","Description")">
    <meta name="twitter:image" content="@yield("meta_image","")">
    <meta property="og:url" content="{{ url()->current() }}"/>
    <title>@yield("title","SportCo Publish")</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--fonts stylesheet-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900|Open+Sans:300,400,600,700,800|Overpass:100,200,300,400,600,700,800,900"
          rel="stylesheet">
    <link rel="apple-touch-icon" sizes="57x57" href="{{url('/images/favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{url('/images/favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{url('/images/favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{url('/images/favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{url('/images/favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{url('/images/favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{url('/images/favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{url('/images/favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{url('/images/favicon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{url('/images/favicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{url('/images/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{url('/images/favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('/images/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{url('/images/favicon/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{url('/images/favicon/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">


{{-- for adsense --}}
{{-- <script data-ad-client="ca-pub-6239837178715306" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> --}}

    @if(env("ISPROD",0))

        <link rel="stylesheet" href="{{mix('css/front.css')}}"/>

    @else
        <link rel="stylesheet" href="{{asset('css/front.css')}}"/>

    @endif
    <meta name="propeller" content="9282c78c295eef3407d34cf4aa5f842e">
    <meta name="description" content="@yield("meta_description","Description")"/>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-121447363-1"></script>
    {{-- <script type="text/javascript">
        atOptions = {
            'key' : '54b48945bbe3be2f8613d0bcb323a3d7',
            'format' : 'iframe',
            'height' : 250,
            'width' : 300,
            'params' : {}
        };
        document.write('<scr' + 'ipt type="text/javascript" src="http' + (location.protocol === 'https:' ? 's' : '') + '://www.displaynetworkprofit.com/54b48945bbe3be2f8613d0bcb323a3d7/invoke.js"></scr' + 'ipt>');
    </script> --}}
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
        @if(env("ISPROD",0))
        ga('create', 'UA-121447363-1', 'auto')
        @else
        ga('create', 'UA-121447363-4', 'auto')
        @endif
        ga('send', 'pageview');

    </script>

    {{-- <script type="text/javascript">
        window._mNHandle = window._mNHandle || {};
        window._mNHandle.queue = window._mNHandle.queue || [];
        medianet_versionId = "3121199";
    </script>
    <script src="https://contextual.media.net/dmedianet.js?cid=8CUJ1V685" async="async"></script> --}}


    {{-- <script data-ad-client="ca-pub-9777489141136302" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> --}}

    {{-- @if(env("ISPROD",1))

    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>



        <script>
        var OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
                appId: "{{ env("ONESIGNAL_APP_ID") }}",
            });
        });
    </script>
    @endif --}}
    @yield("head_extra")
</head>
