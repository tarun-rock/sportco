<?php
$title = "$name | Sporto.io";
$description = "SportCo helps fans make money from their love of sports. You can create original content and play trivia games. In return for contributing to the SportCo ecosystem, you receive SportCo coins. You can use SportCo coins to  play more games, buy merchandise and memorabilia, and even tickets to sporting events. Join now, and reward your passion!";
$mediaurl = url('/images/img1.jpg');
$currentUrl  =url()->current();
?>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<meta property="fb:app_id" content="1175110762591231"/>
<meta property="og:url" content="{{  $currentUrl}}" />
<meta property="og:title" content="{{$title}}" />
<meta property="og:description" content="{{$description}}" />
<meta name="keywords" content=""/>
<meta property="og:image" content="{{$mediaurl}}" />
<meta property="og:type" content="website" />
<meta name="twitter:card" content="summary">
<meta name="twitter:url" content="{{$currentUrl}}">
<meta name="twitter:title" content="{{$title}}">
<meta name="twitter:description" content="{{$description}}">
<meta name="twitter:image" content="{{$mediaurl}}">
<link rel="canonical" href="{{$currentUrl}}">
<title>{{$title}}</title>
</head>
<body>
Redirecting...

<script type="text/javascript">
    window.location.href= "{{ url("register") }}?ref_id={{ $refID }}"
</script>
</body>


</html>