@extends('front.master.main')
@section("title", "SportCo Store - Win Sports Coins.")
@section("meta_description", "Make the most of every SportCo coin you earn at the SportCo store. Now your knowledge and passion for sports can get you amazing t-shirts, mugs, hoodies and lots more.")

@section('head_extra')
    <script>
        ga('send', {
            hitType: 'event',
            eventCategory: 'Merch',
            eventAction: 'Section Loaded',
            eventLabel: 'Merch Section Loaded'
        });
    </script>
@endsection
@section('content')

    <div class="thumb storelisting">
        <div class="entry__img-holder thumb__img-holder"
             style="background-image: url('img/content/single/store-banner2.jpg');">
        </div>
    </div>

    <main class="main oh" id="main">

        <div class="main-container container" id="main-container">
            {{--<h1 class="page-title">{{ ucfirst($name) ?? "" }}</h1>--}}

            <section class="section mb-16">

                <div class="row card-row product-listing">
                    @foreach($datas as $data)
                        <div class="col-md-4">
                            <article class="entry card card--1">
                                <div class="entry__img-holder card__img-holder">
                                    <a href="{{url('/store')}}/{{$data->id}}">
                                        <div class="thumb-container">
                                            <img data-src="{{$data->images[0]->src ?? ""}}"
                                                 src="{{$data->images[0]->src ?? 0}}" class="entry__img lazyloaded"
                                                 alt="">
                                        </div>
                                    </a>
                                </div>

                                <div class="entry__body card__body">
                                    <div class="entry__header">
                                        <ul class="entry__meta">
                                            <li class="entry__meta-category">
                                                @foreach($data->categories as $key => $cateogries)
                                                    <a href="javascript:void(0);">
                                                        {{ $cateogries->name ?? "All"}}
                                                    </a>
                                                    {{$loop->last ? '' : ', '}}
                                                @endforeach
                                            </li>
                                        </ul>
                                        <h2 class="entry__title mb-3">
                                            <a href="{{url('/store')}}/{{$data->id}}">{{$data->name}}</a>
                                        </h2>
                                        <div class="d-flex justify-content-between">
                                            {{--<div><strike>Rs.{{$data->regular_price}}</strike></div>--}}
                                            {{--<div><h6 style="color: #ec3709;">Rs.{{$data->price}}</h6></div>--}}
                                            <strong>Price : <span class="price-store"
                                                                  style="color: #716d6d;"> {!!$data->price_html!!}</span></strong>

                                            <small> @if($data->stock_quantity > 0){{$data->stock_quantity }} in
                                                Stock @else Out Of Stock @endif</small>

                                            {{--@if($data['attributes'][0]->name == "token")
                                                <h6 style="color: #716d6d;">{{$datas['attributes'][0]->options[0]}}
                                                    Tokens</h6>
                                            @elseif($datas['attributes'][0]->name == "price")
                                                <strike>Rs.{{$datas->regular_price}} </strike><br/>
                                                <h6 style="color: #ec3709;">Rs.{{$datas->price}}</h6>
                                            @endif--}}
                                        </div>
                                        <hr/>
                                        <div class="text-center">
                                            @if(!empty($data->attributes)  && $data->stock_quantity > 0)
                                                <div class="small mt-2 alert alert-warning">
                                                    Redeemable only in :
                                                    <span class="">
                                        @foreach($data->attributes[0]->options as $key => $items)
                                                            {{$items}}
                                                            {{$loop->last ? '' : ', '}}
                                                        @endforeach
                                            </span>
                                                </div>
                                            @endif
                                            <br/>
                                            {{--<h6>Stock {{$data->in_stock ?? 0}}</h6>--}}
                                            <a href="{{url('/store')}}/{{$data->id}}" class="btn btn-lg btn-color">See
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </section>

            <div class="text-center mb-5 mt-4">
                <a href="https://teespring.com/stores/sportco-store-2" target="_blank">
                    <img data-src="{{asset('img/store.png')}}" src="{{asset('images/store.png')}}" class="lazy" alt="">
                </a>

            </div>

        </div>
    </main> <!-- end main container -->
@endsection
@section('script_extra')


@endsection