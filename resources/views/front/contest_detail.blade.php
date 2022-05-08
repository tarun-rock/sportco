@extends('front.master.main')
@section("title", "SportCo Play")
@section("meta_description", "$detail->contest_description")
@section("meta_image", "$detail->contest_image")

@section('head_extra')
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">

    @if(isset($count))

        @if($count == 0)
            <script>
                $(document).ready(function () {
                ga('send', {
                    hitType: 'event',
                    eventCategory: 'Play',
                        eventAction: 'First Game Started',
                    eventLabel: 'Play First Game Started'
                });
                });
            </script>
        @endif
        
    @endif
@endsection
@section('content')

    

        <main class="main oh" id="main" style="background:#171821">

            <!-- Hero Slider -->
            <section class="hero-slider-1">
                <div id="flickity-hero" class="carousel-main">
                    
                    <div class="carousel-cell hero-slider-1__item">
                        <article class="hero-slider-1__entry entry">
                            <div class="hero-slider-1__thumb-img-holder"
                                 style="background-image: url({{ $detail->contest_image }})">
                                <div class="bottom-gradient"></div>
                            </div>
                            <div class="hero-slider-1__thumb-text-holder">
                                <div class="container">
                                    <h2 class="hero-slider-1__entry-title">
                                        <a href="javascript:void(0)">{{ $detail->contest_name }}</a>
                                        <p class="white">{{ $detail->contest_description }}</p>
                                    </h2>
                                </div>
                            </div>
                        </article>
                    </div>
                </div> <!-- end flickity -->


            </section> <!-- end hero slider -->

            <div class="main-container container content-box " id="main-container">
                <div class="row">
                    <div class="col-md-4 order-md-1 text-center align-self-center">
                        <h5 style="color:#54555E">Next Question In</h5>

                        <div id="countdown" class="mb-4"></div>
                        <label class="badge badge-danger">POINTS - <span
                                    id="scored">{{ $detail->scored ?? 0 }}</span></label>

                    </div>
                    <div class="col-md-8">
                        <div class="text-center">
                            <p>QUESTION - <span id="answered">{{ $detail->answered + 1 }}</span> / <span
                                        id="total">{{ $detail->total_questions }}</span></p>
                            <input type="hidden" name="q_id" value="{{ $detail->question_id }}">

                            <div class="contest-container">
                                <div class="loader-outer" style="display: none;">
                                    <div class="ring">
                                    </div>
                                </div>
                                <div class="contest-inner first-slide">
                                    <h2 id="heading" class="mb-3 animated questionTitle">{{ $detail->question }}</h2>
                                    <div class="row justify-content-center">
                                        <div id="qstImg"
                                             class="col-md-7 col-sm-12 @if(empty($detail->question_image)) d-none @endif">
                                            <img src="{{ $detail->question_image ?? "" }}" class="img-fluid"/>
                                        </div>
                                        @if(!empty($detail->question_image))
                                            <div class="col-sm-12 d-md-none"><br/></div>
                                        @endif
                                        <div class="d-flex flex-column col-md-5 col-sm-7 optionBox">
                                            @php
                                                $optionIDs = explode(returnConfig("column_separator"), $detail->option_id);

                                                $optionIDsOrder = implode(',', $optionIDs);

                                                $options = DB::table('answers')
                                                            ->whereIn('id', $optionIDs)
                                                            ->orderByRaw(DB::raw("FIELD(id, " . $optionIDsOrder . " )"))
                                                            ->get('option');


                                                foreach ($options as $key => $value) {
                                                    $value->id = $optionIDs[$key];
                                                }

                                                /*dd($options);                
                                                            dd($optionIDs , $optionIDsOrder , $options);*/

                                                
                                            @endphp
                                            @foreach($options as $key => $optionData)
                                                
                                                <button data-id="{{ $optionData->id }}"
                                                        class="btn animated @if($key % 2 == 0) bounceInLeft
                                                        @else bounceInRight @endif btn-lg btn-color mb-3 questionOpt">
                                                    {{ $optionData->option }}
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        {{--<div class="d-flex justify-content-between">
                            <a href="#" class=""></a>
                        <a href="javascript:void(0);" class="btn btn-primary" id="save">Save</a>

                        </div>--}}


                    </div>
                </div>


            </div> <!-- end main container -->
        </main> <!-- end main-wrapper -->


@endsection

@section('script_extra')


    <script src="{{asset('/js/jquery-countdown360.min.js')}}"></script>

    <script>


        $(window).on('load', function () {
            $('html,body').animate({
                    scrollTop: $("#main-container").offset().top
                },
                '1000');
        });

        $(document).ready(function () {


            $('#flickity-hero').flickity({
                cellAlign: 'left',
                contain: true,
                pageDots: false,
                prevNextButtons: false,
                draggable: false,


            });


            if ($(window).width() < 767) {
                var countdown = $("#countdown").countdown360({
                    radius: 80,
                    seconds: 60,
                    strokeStyle: 'transparent',
                    fillStyle: "transparent",
                    fontColor: '#54555E',
                    strokeWidth: 5,
                    autostart: false,
                    onComplete: function () {

                        saveAnswer(countdown);

                    }

                });

            } else {

                var countdown = $("#countdown").countdown360({
                    radius: 80,
                    seconds: 60,
                    strokeStyle: '#D3AD6A',
                    fillStyle: "#fff",
                    fontColor: '#54555E',
                    strokeWidth: 5,
                    autostart: false,
                    onComplete: function () {



                        saveAnswer(countdown);

                    }
                });
            }

            countdown.start();

            $(".first-slide").addClass('showslide');


            $('#savequestion').click(function () {
                $("#heading").addClass('slideInRight')
                $("#btn-one").addClass('slideInRight')
                $("#btn-two").addClass('slideInLeft')
                $("#btn-three").addClass('slideInRight')
                $("#btn-four").addClass('slideInLeft')
            });

            $(document).on("click", ".questionOpt", function () {

                var $this = $(this);

                $(".selectOpt").removeClass("selectOpt")

                $this.addClass("selectOpt");

            });

            $(document).on("click", ".questionOpt", function (e) {

                countdown.stop();

                if ($(".selectOpt").length == 0) {


                    alert("No Option selected");

                    return;

                } else {
                    e.preventDefault();
                    $(".questionOpt").prop('disabled', true);

                    saveAnswer(countdown, $(".selectOpt").attr("data-id"));

                }

            });

            function saveAnswer(countdown, $answer = 0) {

                $.ajax({
                    url: "@if(!empty($type)) {{ route("saveGameAnswer") }} @else {{ route("saveContestAnswer") }} @endif",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "q_id": $("input[name='q_id']").val(),
                        "option_id": $answer,
                        "time": countdown.getElapsedTime(),
                        "contest_id": "{{ $detail->contest_id }}",
                        "id": "{{$id}}",
                        @if(!empty($type) && !empty($sessionID))
                        "session_id": "{{ $sessionID}}",
                        @endif
                    },
                    success: function (response) {
                        if(response.completed == 1){
                            var data = response.correct;
                             if (data == 1) {
                                $('.questionOpt[data-id=' + $answer + ']').addClass('btn-success');
                            } else {
                                $('.questionOpt[data-id=' + $answer + ']').addClass('btn-danger');
                            }
                            window.location.href = "{{ url('/play/game/leaderboard',[$id]) }}";
                        }
                        var data = response.correct;
                            if (data == 1) {
                                $('.questionOpt[data-id=' + $answer + ']').addClass('btn-success');
                            } else {
                                $('.questionOpt[data-id=' + $answer + ']').addClass('btn-danger');
                            }
                        if (response.data == null || response.data == undefined) {
                            @if(!empty($type))
                            ga('send', {
                                hitType: 'event',
                                eventCategory: 'Play',
                                eventAction: 'Game Finished',
                                eventLabel: 'Play Game Finished'
                            });
                            @else
                                window.location.href = "{{ url('/contest') }}";
                            @endif
                                return;
                        }
                        setTimeout(function() {
                            if (response.data != null || response.data != undefined) {
                                checkresponse(response);
                            }
                        }, 1000);

                    }
                })


            }

            function checkresponse(response)
            {
                if (response.status == 1) {
                    $(".contest-inner.first-slide").hide();
                    $(".loader-outer").show();

                    var data   = response.data;
                    var option = response.options;
                    $(".questionTitle").html(data.question);

                    $("#scored").html(data.scored);

                    var $optionsID = data.option_id.split("{{ returnConfig("column_separator") }}");
                    
                    var $optionsName = option;
                    // console.log($optionsName);

                    var $html = '';

                    if (data.question_image != null && data.question_image != undefined && data.question_image != "") {

                        $("#qstImg").removeClass("d-none");

                        $("#qstImg").children().attr("src", data.question_image)

                    } else {
                        $("#qstImg").addClass("d-none");
                        $("#qstImg").children().attr("src", "")
                        $(".loader-outer").hide();
                        $(".contest-inner.first-slide").show();
                  //      countdown.start();
                    }
                    $('#qstImg img').on('load', function () {
                        $(".loader-outer").hide();
                        $(".contest-inner.first-slide").show();
                    //    countdown.start();

                    });


                    $.each($optionsName, function (key, value) {

                        /*if (key % 2 == 0) {
                            $html += '<label class="badge badge-outline-dark animated bounceInLeft">' + value;
                        } else {
                            $html += '<label class="badge badge-outline-dark animated bounceInRight">' + value;
                        }*/

                        $html += '<button data-id="' + $optionsID[key] + '"\n' +
                            'class="btn animated btn-lg btn-color mb-3 questionOpt">\n' +
                            '\n' + value.option +
                            '</button>';
                    });


                    $("input[name='q_id']").val(data.question_id);

                    $("#answered").html(parseInt(data.answered) + 1);

                    $("#total").html(data.total_questions);

                    $(".optionBox").html($html);

                    $('html,body').animate({
                            scrollTop: $("#main-container").offset().top + -50
                        },
                        '1000');

                    countdown.start();

                }
            }

        });
    </script>
@endsection