{{-- @extends('layouts.app') --}}
@extends('front.master.main')
@section("title", "Register | SportCo")
@section("meta_description", "Join our huge community of ardent sports fans across the world. Connect with people who love sports as much as you do. Create a new SportCo account and be a part of the first ever digital sports hubs.")


@section('head_extra')

<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />

    <script>
        ga('send', {
            hitType: 'event',
            eventCategory: 'Register',
            eventAction: 'Page Loaded',
            eventLabel: 'Register Page Loaded'
        });
    </script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection
@section('content')
@php
    $countries = App\Model\countries::where('active', '1')->orderBy('name', 'asc')->get();
@endphp
<div class="subscribe login-register pt-80 pb-80">
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-5">
                <div class="title-wrap mb-2">
                    <h3 class="section-title">{{ __('Register') }}</h3>
                </div>
                <div class="text-left mb-3">
                        Already have an account?<a href="{{ route('login') }}"> Sign in</a>
                    </div>
                <div class="">
                    <form method="POST" id="register-form" action="">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-form-label text-md-right">{{ __('Name') }}</label>

                          
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"  autofocus>


                                    <span id="wr-name" class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>

                           
                        </div>
                        <div class="form-group">
                            <label for="nickname" class="col-form-label text-md-right">{{ __('User Name') }}</label>


                            <input id="nickname" type="text" onchange="username()" class="form-control{{ $errors->has('nickname') ? ' is-invalid' : '' }}" name="nickname"  autofocus>
                            <span class="invalid-feedback" role="alert" id="username">
                                        <strong></strong>
                                    </span>


                                <span id="wr-username" class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>


                        </div>

                        <div class="form-group">
                            <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>



                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">


                                    <span id="wr-email" class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>

                            
                        </div>

                        <div class="form-group">
                            <label for="country" class="col-form-label text-md-right">Choose Country</label>
                            <div class="drop-icon"></div>
                            <select name="country_id" id="country_id" placeholder="select One" class=" form-control country_id"
                                required>
                              <option class="form-control textblack" value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>

                            
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >


                                    <span id="wr-password" class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>

                                
                                <div id="messages"></div>
                            
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >

                        </div>
                        <input type="hidden" name="ref_id" value="<?php echo $_GET['ref_id'] ?? "null" ; ?>"/>

                        @if(!empty(auth()->user()->IsInfluencer))

                        @endif
                        <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="{{ env("GOOGLE_RECAPTCHA_SITE_KEY") }}"></div>

                                <span id="wr-captcha" class="help-block invalid-feedback" style="display: block;">
                                <strong></strong>
                                </span>

                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-lg btn-color btn-button">{{ __('Register') }}</button>
                        </div>
                        <br/>
                                
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
@section('script_extra')

<script src="{{ asset('js/password_strength.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
    
<script type="text/javascript">
    $(document).ready(function() {
        $('.country_id').select2();
    });
</script>
<script>

    $("form#register-form").submit(function (e) {
        $(".invalid-feedback strong").html("");
        e.preventDefault();
         /*var data = $(this).serialize();
        console.log(data);*/
        swal({
            title: 'Please Wait',
            html: '<h1 class="mt-5 mb-5 fa fa-spinner fa-spin"></h1>',
            showConfirmButton: false
        });

        $.ajax({
            url: '{{ route('login-register') }}',
            type: "POST",
            dataType: 'json',
            data: $(this).serialize(),
             headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success: function (response) {
                console.log(response);
                // return;
                if (response.status == 1) {
                    ga('send', {
                        hitType: 'event',
                        eventCategory: 'Register',
                        eventAction: 'Registered',
                        eventLabel: 'User Registered'
                    });
                    swal.hideLoading();
                    // window.location.href = "{url('/email/verify')}}";
                    window.location.href = "{{url('/')}}";
                }else{

                    setTimeout(function(){ swal.close(); }, 1000);
                    
                    // swal.hideLoading();
                    $("#wr-email").show();
                    $("#wr-email strong").html(response.error);

                }
            },
            error: function (xhr, status, error) {

                /*swal.hideLoading();
                swal({
                    title: "Error",
                    text: "Please Check All Field",
                    type: "error"
                })*/
                var responseText = jQuery.parseJSON(xhr.responseText);
                // console.log(responseText.errors.em);
                // return;
                var wr_name = responseText.errors.name;
                var wr_email = responseText.errors.email;
                var wr_password = responseText.errors.password;


                /*if (grecaptcha.getResponse() == ""){
                    $("#wr-captcha").show();
                    $("#wr-captcha strong").html("The g-recaptcha-response field is required.");
                }*/

                $.each(wr_email, function (key, val) {
                    $("#wr-email").show();
                    $("#wr-email strong").html(val);
                });
                $.each(wr_name, function (key, val) {
                    $("#wr-name").show();
                    $("#wr-name strong").html(val);
                });
                $.each(wr_password, function (key, val) {
                    $("#wr-password").show();
                    $("#wr-password strong").html(val);
                });

            }
        })


    });

    function username(){
        $trimname = $("input[name='nickname']").val().replace(/\s+/g, '');
        $("input[name='nickname']").val($trimname)

        $.ajax({
            url: "{{ url("/usernamevalidate") }}",
            type:"Post",
            data: {
                "_token": "{{ csrf_token() }}",
                "username": $trimname,
            },
            success: function(data) {
               /* globalData = data;
                console.log(globalData.nickname);*/
                $("#username").hide();

            },
            error: function (response) {
                var err = jQuery.parseJSON(response.responseText);

                $("#username").show();
                $("#username strong").html(err.message);
            }
        });

    }
        jQuery(document).ready(function () {
              var options = {
                  onKeyUp: function (evt) {
                      $(evt.target).pwstrength("outputErrorList");
                  }
              };
              $('#password').pwstrength(options);
          });
          </script>
@endsection
