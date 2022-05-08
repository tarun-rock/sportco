<?php
function siteurl()
{
    $path = "//".$_SERVER["SERVER_NAME"].dirname($_SERVER['PHP_SELF'])."/";
    return $path;
    /*$position = strrpos($path,'/') + 1;
    return $position;*/
}

$playURL = "//".$_SERVER["SERVER_NAME"]."/play/";
$mainURL = "//".$_SERVER["SERVER_NAME"];
?>
<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
          content="Blockchain, Cryptocurrency, Sportco, Sportco ICO, Sportco Token, Sportco Coin, Sportco Cryptocurrency, Sports Quiz, Sports Contests, Sports Apps">
    <meta name="author" content="">
    <link rel="icon" href="<?= siteurl(); ?>img/favicon.png" type="image/gif">
    <title>About Us - SportCo | New-age Digital Sports Ecosystem</title>
  <meta name="description" content="SportCo is a unique digital platform forming a network of sports fans from across the globe. Reward your love for sports with amazing gift cards and merchandise.">

    <!-- Bootstrap core CSS -->
    <!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" rel="stylesheet">-->
    <link href="<?= siteurl(); ?>css/bootstrap.css" rel="stylesheet">
    <link href="<?= siteurl(); ?>css/animate.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="<?= siteurl(); ?>vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?= siteurl(); ?>css/jquery.bxslider.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!--  <link href="css/style.css" rel="stylesheet"> -->
    <link href="<?= siteurl(); ?>css/style.css" rel="stylesheet">
    <script type="text/javascript" src="<?= siteurl(); ?>js/jquery-3.2.1.min.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-121447363-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-121447363-1');
    </script>
</head>

<body id="page-top">
<nav class="navbar navbar-toggleable-md navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </button>
        <a class="navbar-brand js-scroll-trigger" href="//<?= $_SERVER["SERVER_NAME"]; ?>"><img
                    src="<?= siteurl(); ?>img/logoheader.png" class="img-fluid"></a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            </ul>
            <ul class="navbar-nav text-uppercase">
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="<?php echo $mainURL; ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="<?php echo $playURL; ?>">Play</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="<?= siteurl(); ?>#ourtoken">Token</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="<?= siteurl(); ?>#why">Why</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="<?= siteurl(); ?>#team">Team</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" target="_blank" href="<?= siteurl(); ?>assets/whitepaper.pdf">Whitepaper</a>
                </li>

                


                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="<?= siteurl(); ?>#contactSection">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>