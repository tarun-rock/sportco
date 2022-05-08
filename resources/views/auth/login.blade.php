@extends('front.master.main')
@section("title", "Login | SportCo")
@section("meta_description", "Sign into your SportCo account and start contributing to the sports community in return for SportCo tokens. Play games, write articles, post pictures and reward yourself with amazing merchandise.")

@section('head_extra')
    <script>
        ga('send', {
            hitType: 'event',
            eventCategory: 'Login',
            eventAction: 'Page Loaded',
            eventLabel: 'Login Page Loaded'
        });
    </script>
@endsection
@section('content')
    <div class="subscribe login-register pt-80 pb-80">
        <div class="container">
            <div class="row justify-content-center style-default">
                <div class="col-md-6">
                    <div class="card">
                        <div class="p-5">
                            <div class="title-wrap mb-2">
                                <h3 class="section-title ">{{ __('Login') }}</h3>
                            </div>
                            <div class="text-left mb-3">Don't have an account?<a href="{{ route('register') }}"> Sign
                                    Up</a></div>


                            <div class="">
                                <form method="POST" id="loginform">
                                    @csrf
                                    <div id="signin_error" class="alert alert-danger" style="display: none">

                                    </div>
                                    <div class="form-group">
                                        <label for="email"
                                               class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>


                                        <input id="email" type="email"
                                               class="form-control"
                                               name="email" value="{{ old('email') }}" required autofocus>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="password"
                                               class=" col-form-label text-md-right">{{ __('Password') }}</label>
                                        <input id="password" type="password"
                                               class="form-control"
                                               name="password" required>

                                    </div>

                                    <div class="form-group">

                                        <div class="">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                   id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>

                                    </div>

                                    <div class="form-group mb-0 mt-4">
                                        <div class="d-flex justify-content-between">
                                            <button type="submit" class="btn btn-lg btn-color btn-button">
                                                {{ __('Login') }}
                                            </button>

                                            <a class="forgot-pass" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        </div>
                                    </div>


                                    @if(!empty(request()->all()['redirect']))
                                        <input type="hidden" name="redirect" value="{{ request()->all()['redirect'] }}">
                                    @endif

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script_extra')
    <script>

        $("form#loginform").submit(function (e) {
            swal({
                title: 'Please Wait',
                html: '<h1 class="mt-5 mb-5 fa fa-spinner fa-spin"></h1>',
                showConfirmButton: false
            });
            $("#signin_error").hide()
            $("input[name='email']").removeClass("invalid")
            $("input[name='password']").removeClass("invalid")
            e.preventDefault();



            $.ajax({
                url: '{{ route('login') }}',
                type: "POST",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'email': $("input[name='email']").val(),
                    'password': $("input[name='password']").val()
                },
                success: function (response) {

                    if (response.status == 1) {
                        swal.close();
                        ga('send', {
                            hitType: 'event',
                            eventCategory: 'Login',
                            eventAction: 'Logged in',
                            eventLabel: 'Logged in'
                        });

                        window.location.href = response.redirectlink;
                    }

                },
                error: function (response) {
                        swal.close();
                    //responseText = jQuery.parseJSON(error);
                    var responseText = jQuery.parseJSON(response.responseText);
                    var emailerr = responseText.errors.email;
                    //var passerr = responseText.errors.password;
                    $("#signin_error").show()
                    $("#signin_error").html(emailerr)
                    $("input[name='email']").addClass("invalid")
                    $("input[name='password']").addClass("invalid")
                    ga('send', {
                        hitType: 'event',
                        eventCategory: 'Login',
                        eventAction: 'Logged failed',
                        eventLabel: 'Logged failed'
                    });



                }
            })

        });
    </script>
@endsection