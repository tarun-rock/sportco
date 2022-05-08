@extends('front.master.main')
@section('content')
    <style>
        @if(strlen($datas->short_description) > 600)
.readmoretoggle.active{
            overflow: visible;
            display:block;
            -webkit-line-clamp:inherit;
            -webkit-box-orient: inherit;
            -webkit-transition:1s; /* Safari */
            transition:1s;
            max-height:inherit;
        }
        .readmoretoggle{

            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            margin-bottom: 10px;
            -webkit-transition:1s; /* Safari */
            transition:1s;
            max-height: 99px;
        }
        @endif
    </style>

    <main class="main oh" id="main">
        <!-- Breadcrumbs -->
        <div class="container">
            <ul class="breadcrumbs">
                <li class="breadcrumbs__item">
                    <a href="{{ url('/') }}" class="breadcrumbs__url">Home</a>
                </li>
                <li class="breadcrumbs__item breadcrumbs__item--current">
                    <a href="{{ route('store') }}" class="breadcrumbs__url">Store</a>
                </li>
            </ul>
        </div>
        <div class="main-container container" id="main-container">
            {{--<h1 class="page-title">{{ ucfirst($name) ?? "" }}</h1>--}}

            <section class="section mb-2">

                <div class="row product-detial">
                    <div class="col-md-12">
                        <article class="d-flex justify-content-between row">

                            {{--<div class="row">
                                <div class="col-md-5">
                                    <img class="xzoom"
                                         src="https://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/01_b_car.jpg"
                                         style="width:400px;"
                                         xoriginal="https://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/01_b_car.jpg"
                                    />
                                    <div class="xzoom-thumbs">
                                        <a href="https://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/01_b_car.jpg">
                                            <img class="xzoom-gallery" width="80"
                                                 src="https://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/01_b_car.jpg"
                                                 xpreview="https://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/01_b_car.jpg">
                                        </a>
                                        <a href="https://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/02_o_car.jpg">
                                            <img class="xzoom-gallery" width="80"
                                                 src="https://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/02_o_car.jpg">
                                        </a>
                                        <a href="https://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/03_r_car.jpg">
                                            <img class="xzoom-gallery" width="80"
                                                 src="https://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/03_r_car.jpg">
                                        </a>
                                        <a href="https://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/04_g_car.jpg">
                                            <img class="xzoom-gallery" width="80"
                                                 src="https://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/04_g_car.jpg">
                                        </a>
                                    </div>
                                </div>
                            </div>--}}

                            <div class="col-md-5">
                            <div class="entry__img-holder">
                                <img class="xzoom w-100" src="{{$datas->images[0]->src ?? 0}}"
                                     style="" xoriginal="{{$datas->images[0]->src ?? 0}}"/>

                                {{--<div class="xzoom-thumbs d-none">
                                    <a href="{{$datas->images[0]->src}}">
                                        <img class="xzoom-gallery" width="80" src="{{$datas->images[0]->src}}"
                                             xpreview="{{$datas->images[0]->src}}">
                                    </a>

                                </div>--}}
                                {{--<a href=" " class="d-none">
                                    <div class="thumb-container">
                                        <img data-src="{{$datas->images[0]->src}}" src="{{$datas->images[0]->src}}"
                                             class="entry__img lazyloaded" alt="">
                                    </div>
                                </a>--}}

                            </div>

                                <div class="mt-2">
                                    @if(count($datas->attributes) > 1 && $datas->stock_quantity > 0)

                                        <div class="mb-2 alert alert-warning text-center">
                                            Redeemable only in :

                                            <span class="">
                                        @foreach($datas->attributes[1]->options as $key => $items)
                                                    {{$items}}
                                                    {{$loop->last ? '' : ', '}}
                                                @endforeach
                                            </span>

                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="entry__body col-md-7">
                                <div class="entry__header">
                                    <div class="title-wrap mb-2">
                                        <h3 class="section-title">{{$datas->name}}</h3>
                                    </div>
                                    <ul class="entry__meta mb-4">
                                        <li class="entry__meta-category">
                                            @foreach($datas->categories as $key => $cateogries)
                                                <a href="javascript:void(0);">
                                                    {{ $cateogries->name ?? "All"}}
                                                </a>
                                                {{$loop->last ? '' : ', '}}
                                            @endforeach
                                        </li>

                                    </ul>

                                    <div class="description-out">
                                        @if(!empty($datas->short_description))
                                            <div class="readmoretoggle">
                                                {!! $datas->short_description !!}

                                            </div>
                                            @if(strlen($datas->short_description) > 600)
                                                <u><a href="javascript:void(0);" class="" id="myBtn">See More Product Detail</a></u>
                                            @endif
                                        @else
                                            <i class="text-muted"> No Description</i>
                                        @endif
                                        <br/>

                                    </div>
                                    <br/>
                                    <div class="d-flex justify-content-between">

                                        {{-- @if($datas->attributes[0]->name == "token")
                                             <h6 style="color: #ec3709;">{{$datas->attributes[0]->options[0]}}
                                                 Tokens</h6>
                                         @elseif($datas->attributes[0]->name == "price")
                                         <strike>Rs.{{$datas->regular_price}} </strike><br/>
                                             <h6 style="color: #ec3709;">Rs.{{$datas->price}}</h6>
                                         @endif--}}



                                            <strong>Price : <span class="price-store"
                                                                  style="color: #716d6d;"> {!!$datas->price_html!!}</span></strong>


                                        <small> @if($datas->stock_quantity > 0){{$datas->stock_quantity }} in Stock @else Out Of Stock @endif</small>

                                        {{--<h6 style="color: #ec3709;">Rs.{{$datas->price}}</h6>--}}
                                    </div>


                                    {{--{{$datas->attributes}}--}}
                                    <hr/>

                                    @if($datas->stock_quantity > 0)
                                        <form id="addtocart" method="POST">
                                            <div class="row">
                                                <div class="col-md-3">


                                                    <div class="input-group mb-3 quantity">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text minus">-</span>
                                                        </div>
                                                        <input type="text" name="qty" id="qty"
                                                               class="form-control count text-center" value="1">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text plus">+</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    {{--<a href="{{url('/store/products')}}/{{$datas->id}}" class="btn btn-lg btn-color">Add To Cart</a>--}}

                                                        <button type="submit" class="btn btn-lg btn-color">Add To Cart
                                                        </button>
                                                </div>
                                            </div>
                                        </form>
                                    @endif

                                </div>

                            </div>

                        </article>
                    </div>
                </div>
            </section>
            <hr/>
            <section class="section mb-16 mt-4 d-none">
                <div class="title-wrap">
                    <h3 class="section-title">Product Listing</h3>
                </div>
                <div class="row card-row product-listing">


                    <div class="col-md-4">
                        <article class="entry card card--1">
                            <div class="entry__img-holder card__img-holder">
                                <a href="http://192.168.2.22/web_sportco_publish/public/store/11">
                                    <div class="thumb-container">
                                        <img data-src="http://localhost/web_sportco_publish/public/wordpress/wp-content/uploads/2019/02/widget-hero.png"
                                             src="http://localhost/web_sportco_publish/public/wordpress/wp-content/uploads/2019/02/widget-hero.png"
                                             class="entry__img lazyloaded" alt="">
                                    </div>
                                </a>
                            </div>

                            <div class="entry__body card__body">
                                <div class="entry__header">
                                    <ul class="entry__meta">
                                        <li class="entry__meta-category">
                                            <a href="#">Trends</a>
                                        </li>
                                        <li class="entry__meta-date">
                                            5 Days Ago
                                        </li>
                                    </ul>
                                    <h2 class="entry__title mb-3">
                                        <a href="http://192.168.2.22/web_sportco_publish/public/store/11">CANTERBURY
                                            ddddd</a>
                                    </h2>

                                    <div class="d-flex justify-content-between">
                                        <div><strike>Rs.11899.00</strike></div>
                                        <div><h6 style="color: #716d6d;">Rs.11500.00</h6></div>
                                    </div>
                                    <hr>
                                    <div class="text-center">

                                        <a href="http://192.168.2.22/web_sportco_publish/public/store/11"
                                           class="btn btn-lg btn-color">Add To Cart</a>
                                    </div>


                                </div>

                            </div>
                        </article>
                    </div>


                    <div class="col-md-4">
                        <article class="entry card card--1">
                            <div class="entry__img-holder card__img-holder">
                                <a href="http://192.168.2.22/web_sportco_publish/public/store/9">
                                    <div class="thumb-container">
                                        <img data-src="http://localhost/web_sportco_publish/public/wordpress/wp-content/uploads/2019/02/red.png"
                                             src="http://localhost/web_sportco_publish/public/wordpress/wp-content/uploads/2019/02/red.png"
                                             class="entry__img lazyloaded" alt="">
                                    </div>
                                </a>
                            </div>

                            <div class="entry__body card__body">
                                <div class="entry__header">
                                    <ul class="entry__meta">
                                        <li class="entry__meta-category">
                                            <a href="#">Trends</a>
                                        </li>
                                        <li class="entry__meta-date">
                                            5 Days Ago
                                        </li>
                                    </ul>
                                    <h2 class="entry__title mb-3">
                                        <a href="http://192.168.2.22/web_sportco_publish/public/store/9">Redux Analogue
                                            Brown Dial Men's &amp; Boy's Watch RWS0200S</a>
                                    </h2>

                                    <div class="d-flex justify-content-between">
                                        <div><strike>Rs.1880.00</strike></div>
                                        <div><h6 style="color: #716d6d;">Rs.1800.00</h6></div>
                                    </div>
                                    <hr>
                                    <div class="text-center">

                                        <a href="http://192.168.2.22/web_sportco_publish/public/store/9"
                                           class="btn btn-lg btn-color">Buy Now</a>
                                    </div>


                                </div>

                            </div>
                        </article>
                    </div>


                </div>
            </section>

        </div>
    </main> <!-- end main container -->
@endsection
@section('script_extra')
    <script src="{{ asset('/js/products.js')}}"></script>
    <script>
        $(document).ready(function () {

            $("form#addtocart").submit(function (e) {
                e.preventDefault();

                var quantity = $("#qty").val();


                $.ajax({
                    url: '{{url('store/additemscart')}}',
                    type: "POST",
                    data: {
                        '_token': "{{csrf_token()}}",
                        "product_id": '{{$datas->id}}',
                        "quantity": quantity,
                        "tokenvalue": '{{$datas->price}}'
                    },
                    success: function (response) {
                        if (response == 1) {
                            swal({
                                title: "Done!",
                                text: "Item Added Successfully",
                                type: "success"
                            }).then((result) => {
                                window.location.href = "{{ url("store/cart/detail") }}"
                            });
                        }
                        else {
                            swal({
                                title: "Out Of Stock!",
                                type: "error"
                            })

                        }
                        /*if (response == 2) {

                            swal({
                                title: "Duplicate Item",
                                text: "Item is already in your Cart",
                                type: "warning"
                            }).then((result) => {
                                window.location.href = "{{ url("store/cart/detail") }}"
                            });

                        }*/


                    },
                    error: function (xhr, status, error) {
                        responseText = jQuery.parseJSON(xhr.responseText);

                        if (responseText.message == "Unauthenticated.") {

                            swal({
                                title: "Login Required",
                                type: "warning"
                            }).then((result) => {
                                window.location.href = "{{ url("login") }}"
                            });

                        }


                    }
                })

            });


            //$('.xzoom').xzoom({zoomWidth: 400, title: true, tint: '#333', Xoffset: 5});
            $('.xzoom, .xzoom-gallery').xzoom({
                position: 'lens',
                lensShape: 'circle',
                bg: true,
                sourceClass: 'xzoom-hidden'
            });


            $('.count').prop('readonly', true);
            $(document).on('click', '.plus', function () {

                $('.count').val(parseInt($('.count').val()) + 1);
                $inputvalue = $('.count').val();

                if ($inputvalue > "{{$datas->stock_quantity }}") {
                    swal({
                        title: "Error!",
                        text: "Dont have enough Stock !",
                        type: "error"
                    });
                    $('.count').val({{$datas->stock_quantity }})

                }
            });
            $(document).on('click', '.minus', function () {
                $('.count').val(parseInt($('.count').val()) - 1);
                if ($('.count').val() == 0) {
                    $('.count').val(1);
                }
            });
        });
        @if(!empty($datas->short_description))
        $(document).ready(function () {



        })

        $( window ).resize(function() {
            $("#myBtn").click(function () {
                var btnText = document.getElementById("myBtn");
                if (btnText.innerHTML === "See More Product Detail") {
                    $(".readmoretoggle").addClass("active");
                    btnText.innerHTML = "See Less Product Detail";

                } else {
                    btnText.innerHTML = "See More Product Detail";
                    $(".readmoretoggle").removeClass("active");

                }
            })
        });
        @endif
    </script>


@endsection