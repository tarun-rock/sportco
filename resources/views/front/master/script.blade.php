    @if(env("ISPROD",0))
        <script src="{{mix('js/app.js')}}"></script>
    @else
     <script src="{{asset('js/app.js')}}"></script>
    @endif
    <script src="{{asset('js/js.cookie.min.js')}}"></script>
 <script src="{{asset('js/sweetalert2.all.min.js')}}"></script>


 <script>
     
$(document).ready(function(){

    /*$("ul.footerouter .entry__meta-date").each(function(){
        $(this).html(moment($(this).html()).fromNow());
    });*/

    /*$(".l_post .entry__meta-date").each(function(){

        $(this).html(moment($(this).html().trim()).fromNow());
    });*/


    var date = new Date();
date.setTime(date.getTime() + (30 * 1000));

$("#accept_this").on("click",function(){
    
    if('{{ Auth::check() }}' == false)
    {
        Cookies.set('is_guest', 'accept', { expires: 59 });
        $.ajax({
           url: '{{ url("accept-terms") }}',
           type: 'POST',
           data: {
               type:1, // 1 value is representing guest 
               _token: "{{ csrf_token() }}"
           }
       });
        $(".terms_full_body").hide();
        $("#overlaymodel").removeClass("modal-backdrop fade show");        
    }else{
        Cookies.set('user{{ md5(Auth::id()) }}', 'accept', { expires: 59 });
        $.ajax({
           url: '{{ url("accept-terms") }}', 
           type: 'POST',
           data: {
               type:2, // 2 value is representing user 
               _token: "{{ csrf_token() }}"
           }
       });
        $(".terms_full_body").hide();
        $("#overlaymodel").removeClass("modal-backdrop fade show");
        }
});
setInterval(function(){
if('{{ \Request::path() }}' != "terms" && '{{ \Request::path() }}' != "privacy")
{
    if('{{ Auth::check() }}' == false)
    {
    if(Cookies.get('is_guest') == undefined)
    {
        $(".terms_full_body").show();
        $("#overlaymodel").addClass("modal-backdrop fade show");
    }
    }else{
        if(Cookies.get('user{{ md5(Auth::id()) }}') == undefined)
        {
             $(".terms_full_body").show();
             $("#overlaymodel").addClass("modal-backdrop fade show");
        }
    }
}
}, 1000);



    $('[data-toggle="tooltip"]').tooltip();  
    $("#logout-btn").click(function(){
        swal({
            title: 'Are you sure?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Proceed'
            }).then((result) => {
            if (result.value) {
                event.preventDefault();
                    document.getElementById('logout-form').submit();
            }
            })
        
    });
});
     
     $(document).ready(function(){

         $('.newsletter').submit(function (e) {
             e.preventDefault();

             $.ajax({
                 url: '{{ url("subscribe-mailchimp") }}',
                 type: 'POST',
                 data: $(this).serialize(),
                 success: function (data) {



                     if (parseInt(data['status']) === 1 || data == 1) {

                         swal({
                             title: 'Thanks For Signing up!',
                             type: 'success'
                         }).then((result) => {
                             if (result.value) {
                                 $('.fnewsletter')[0].reset();
                             };
                         })
                         $('.newsletter')[0].reset();

                     } else {
                         swal({
                             type: 'error',
                             text: data['msg'],
                         });
                     }
                 }
             });
         });

     });

 </script>
 {{--@if(empty(Auth::user()->nickname))--}}

 {{--@endif--}}

 @if(Session::has('username'))
     <script type="text/javascript">

         $(document).ready(function () {
             @if(Session::exists('username'))
             $('#nickname').modal('show');
             //{{Session::forget('username','notexist')}}
             @endif

             })
             /*http://localhost/web_sportco_publish/public/username*/

             $("form#n_nameupdate").submit(function (e) {
                 e.preventDefault();
                 var $data = $(this).serialize();
                 $.ajax({
                     url: '{{ url("username") }}',
                     type: "POST",
                     data: $data,
                     success: function (response) {
                         $("#nickname").modal("hide");
                         swal({
                             title: "Success!",
                             text: "Updated Successfully",
                             type: "success"
                         });
                     },
                     error: function (xhr, status, error) {
                         responseText = jQuery.parseJSON(xhr.responseText);
                         $('#usererror').show();
                         $('#usererror').html(responseText.message);
                     }
                 })

             });
         });

     </script>
@endif

    @yield("script_extra")



