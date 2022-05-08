@extends('front.master.main')

@section('content')
    <div class="subscribe login-register pt-80 pb-80">
        <div class="container">
            <div class="row justify-content-center style-default">
                <div class="col-md-6">
                    <div class="card">
                        <div class="p-5">
                            <div class="title-wrap ">
                                <h3 class="section-title">{{ __('Verify Your Email Address') }}</h3>
                            </div>

                            <div class="card-body">

                                <form method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        {{ __('A fresh verification link has been sent to your email address.') }}
                                    </div>
                                @endif

                                    {{ __('Before proceeding, please check your email for a verification link.') }}
                                    {{ __('If you did not receive the email') }}, <button type="submit" style="outline: none;background: transparent;border: none;color: #1059a2;text-decoration: underline;">{{ __('click here to request another') }}</button>.

                                    {{-- <button type="submit">{{ __('Resend Verification Email') }}</button> --}}
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
