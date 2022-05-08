<!-- Sidebar -->
<aside class="col-lg-4 sidebar sidebar--right">
    
    {{-- <div id="bottomWidget">
        <aside class="widget" id="olympics" style="padding: 3px;height: 600px;">
        
            <iframe id="iframe" src="https://fbwidget.gamapp.tech/sportco" style="width: 100%;border: none;height: 100%;"></iframe>
        </aside>
            
    </div> --}}


{{--     <aside class="widget widget_media_image">
        <a href="https://teespring.com/stores/sportco-store-2" target="_blank">
            <img src="{{url('images/merchsidebar.png')}}" class="img-fluid" width="100%" alt="">
        </a>
    </aside>
    <aside class="widget widget_media_image">
        <a href="{{url('/athlete_registration_form')}}"  target="_blank">
            <img src="{{url('images/adbanner1.png')}}" alt="">
        </a>
    </aside> --}}
    <style>
        .iframe-container {
            position: relative;
            min-width: 350px;
            width: 100%;
        }
        #overlay_div {
            position: absolute;
            width: 100%;
            height: 100%;
            content: "";
            display: block;
            top: 0;
            z-index: 1;
            cursor: pointer;
        }
    </style>

    
    {{-- <aside class="widget widget_mc4wp_form_widget">
    <div id="220616019">
        <script type="text/javascript">
            try {
                window._mNHandle.queue.push(function (){
                    window._mNDetails.loadTag("220616019", "300x250", "220616019");
                });
            }
            catch (error) {}
        </script>
    </div>
    </aside> --}}
    <!-- Widget Newsletter -->
    <aside class="widget widget_mc4wp_form_widget">
        <h4 class="widget-title">Newsletter</h4>
        <p class="newsletter__text">
            <i class="ui-email newsletter__icon"></i>
            Subscribe for our daily news
        </p>
        <form class="mc4wp-form newsletter" method="post">
            <div class="form-group">
                @csrf
                <input type="text" name="name" placeholder="Name" required="">
            </div>
            <div class="mc4wp-form-fields">
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" required="">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-lg btn-color" value="Sign Up">
                </div>
            </div>
        </form>
    </aside> <!-- end widget newsletter -->


    <!-- Widget Socials -->
    <aside class="widget widget-socials text-center">
        <div class="socials socials--rounded socials--large">
            <a href="https://www.facebook.com/SportCo.io/" class="social social-facebook" aria-label="facebook"><i
                        class="ui-facebook"></i></a>
            <a href="https://twitter.com/Sportcoio" class="social social-twitter" aria-label="twitter"><i
                        class="ui-twitter"></i></a>
            <a class="social social-medium" href="https://medium.com/@social_72044" target="_blank"><i
                        class="fab fa-medium-m"></i></a>
            <a class="social social-linkedin" href="https://www.linkedin.com/company/sportco-io/" target="_blank">
                <i class="ui-linkedin"></i></a>
            <a class="social social-slack" href="http://sportcoworkspace.slack.com/" target="_blank"><i
                        class="fab fa-slack-hash"></i></a>
            <a class="social social-telegram" href="http://t.me/SPORTCO_token" target="_blank"><i
                        class="fab fa-telegram-plane"></i></a>
        </div>
    </aside> <!-- end widget socials -->

    <!-- Widget Latest Videos -->
    <aside class="widget widget-latest-videos">
        <h4 class="widget-title">POPULAR POSTS</h4>

        {!! mostPopularSidebar() !!}

    </aside> <!-- end widget latest videos -->


    <!-- Widget Ad 300 -->

{{--<aside class="widget widget_media_image sticky position-relative" id="add-outer">
    <div class="sticky-stopper"></div>
<div id="sidebar-sticky">
    <a href="#">
        <img src="../img/content/placeholder_336.jpg" alt="">
    </a>

    <br/><br/>
    <br/>
    <a href="#">
        <img src="../img/content/placeholder_336.jpg" alt="">
    </a>
</div>
</aside>--}}
<!-- end widget ad 300 -->

</aside> <!-- end sidebar -->

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>


/*focus();
var listener = window.addEventListener('blur', function() {
    if (document.activeElement === document.getElementById('iframe')) {
        console.log('clicked');
    }
    window.removeEventListener('blur', listener);
});*/

$(document).ready(function(){

    var platform = navigator.platform;

        var width = window.screen.availWidth;
        console.log(width);

    if(width >= 850){
        $("#topWidget").hide();
        $("#bottomWidget").show();
    }else{
        
        $("#bottomWidget").hide();
        $("#topWidget").show();
    }





    $('#iframe').on('load' , function(){
        $('#iframe').contents().find('.link-sid').click(function(){
            // console.log("hello");
            $("#olympics").css('height','600px');

        });
    });
})



    function moveScroller() {
        /*  var sidebarouter = $("#add-outer");
          var stopPoint = $('.sticky-stopper').offset().top;
          var contentheight = $('#add-outer').height();
              var window_top = $(window).scrollTop() + 30;
              var stopscroll  = $(".stop-scroller").offset().top;
              var ot = sidebarouter.offset().top;
          var padding = 30;
             // var stopscroll = stopPoint.offset().top;
          $("#add-outer").css("height", contentheight);
              if (window_top + contentheight > stopscroll) {
                  $('#sidebar-sticky').css({top: ((window_top + -70) + contentheight - stopscroll + padding ) * -1})
                  //$('#sidebar-sticky').removeClass('sticky');
              }
              else if (window_top > stopPoint) {
                 // console.log("sdsd")

                  $('#sidebar-sticky').addClass('sticky');
              } else {
                  $('#sidebar-sticky').removeClass('sticky');
              }*/


        // console.log(footer)
        //console.log(st)

        // if(windowheight > ot) {
        //     $("#add-outer").css("height", $contentheight);
        //     $content.css({
        //         position: "fixed",
        //         top: "60px"
        //     });
        // }
        // // else if () {
        // //
        // // }
        // else {
        //     $content.css({
        //         position: "relative",
        //         top: ""
        //     });
        // }

    }


</script>