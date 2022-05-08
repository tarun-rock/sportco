@extends('front.master.main')
@section('head_extra')
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">

@endsection
@section('content')
    <main class="main oh" id="main" style="background:#171821">

        <!-- Hero Slider -->
        <section class="hero-slider-1">
            <div id="flickity-hero" class="carousel-main">

                <div class="carousel-cell hero-slider-1__item">
                    <article class="hero-slider-1__entry entry">
                        <div class="hero-slider-1__thumb-img-holder" style="background-image: url(img/content/hero/hero_post_19.jpg)">
                            <div class="bottom-gradient"></div>
                        </div>
                        <div class="hero-slider-1__thumb-text-holder">
                            <div class="container">
                                <h2 class="hero-slider-1__entry-title">
                                    <a href="single-post-music.html">GOLDEN BOOT</a>
                                    <p class="white">The World Cup's most anticipated individual award is the Golden Boot. An award that honors the players who are adept in finding the net over the course of a month. Think you know all there is about World Cup goal-scoring exploits? Well, then this quiz should be akin to an open goal for you.</p>
                                </h2>
                            </div>
                        </div>
                    </article>
                </div>
            </div> <!-- end flickity -->


        </section> <!-- end hero slider -->

        <div class="main-container container content-box " id="main-container">
            <div class="row">
                <div class="col-md-4 order-md-1 text-center">
                    <button data-type="time-remaining">Time Remaining</button>
                    <button data-type="time-elapsed">Time Elapsed</button>
                    <div id="countdown" class="mb-4"></div>
                    <h5>Next Question Will Appear in </h5>
                </div>
                <div class="col-md-8">
                    <div class="text-center">
                    <p>QUESTION - 2 / 10 </p>
                    <label class="badge badge-danger">POINTS - 0</label>
                        <div class="contest-container">
                            <div class="contest-inner first-slide">
                                <h2 id="heading" class="mb-3 animated  ">Which Sportswear giant sponsors the 'Golden Boot' award at the World Cup?</h2>
                                <div class="row justify-content-center">
                                    <div class="d-flex flex-column col-md-6 col-sm-7 ">

                                        <button id="btn-one" class="btn animated  btn-lg btn-color btn-button mb-3">Robert Prosinecki</button>
                                        <button id="btn-two" class="btn animated  btn-lg btn-color btn-button mb-3">Robert Prosinecki</button>
                                        <button id="btn-three" class="btn animated  btn-lg btn-color btn-button mb-3">Robert Prosinecki</button>
                                        <button id="btn-four" class="btn animated  btn-lg btn-color btn-button mb-3">Robert Prosinecki</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <hr/>
                    <div class="d-flex justify-content-between">
                        <a href="#" class="btn btn-color">Cancel</a>
                    <a href="javascript:void(0);" class="btn btn-primary" id="savequestion">Save</a>

                    </div>



                </div>
            </div>


        </div> <!-- end main container -->
    </main> <!-- end main-wrapper -->


@endsection
@section('script_extra')
    <style>
         #countdown{
            border:4px solid #0000000d;
            border-radius: 50%;
            width: 165px;
            margin: auto;
            height: 165px;
        }
        #countdown canvas{
            position:relative;
            left:-4px;
            top:-4px;
        }
    </style>

    <script src="{{asset('/js/jquery.countdown360.js')}}"></script>
    <script src="{{asset('/js/jquery-countdown360.min.js')}}"></script>

    <script>
        $("#countdown").countdown360({
            radius      : 80,
            seconds     : 60,
            strokeStyle: '#D3AD6A',
            fillStyle: "#fff",
            fontColor   : '#54555E',
            strokeWidth: 5,
            autostart   : false,
            onComplete  : function () {
                //console.log('done')

            }
        });
        countdown.start();

        $(document).ready(function () {
            $(".first-slide").addClass('showslide')
            $('#savequestion').click(function (e) {

               $("#heading, #btn-one, #btn-three").addClass('slideInRight')
               $("#btn-two, #btn-four").addClass('slideInLeft')
            });

        });



        $(document).on("click","button",function(e){
            e.preventDefault();
            var type = $(this).attr("data-type");
            if(type === "time-remaining")
            {
                var timeRemaining = countdown.getTimeRemaining();
                alert(timeRemaining);
            }
            else
            {
                var timeElapsed = countdown.getElapsedTime();
                alert(timeElapsed);
            }
        });
    </script>
@endsection