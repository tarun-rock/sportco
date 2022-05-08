<?php
$title = "$user->name | Sporto.io";
$description = "SportCo helps fans make money from their love of sports. You can create original content and play trivia games. In return for contributing to the SportCo ecosystem, you receive SportCo coins. You can use SportCo coins to  play more games, buy merchandise and memorabilia, and even tickets to sporting events. Join now, and reward your passion!";
$mediaurl = url('/images/img1.jpg');
?>
@extends('front.master.main')
{{--@section('title','User Proile')--}}
@section("title", $title)
@section("meta_description", $description)
@section("meta_image", $mediaurl)


@section('content')
    <style>
        input[type='number'] {
            -moz-appearance: textfield;
        }

        /* Webkit browsers like Safari and Chrome */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
    <!-- Breadcrumbs -->
    <div class="container">
        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="{{ url("/") }}" class="breadcrumbs__url">Home</a>
            </li>
            <li class="breadcrumbs__item breadcrumbs__item--current">
                Profile
            </li>
        </ul>
    </div>

    <div class="main-container container" id="main-container">
        <!-- post content -->
        <div class="blog__content mb-72">
            <div class="row">
                <div class="col-lg-12">
                    @include('front.profileLeftbar')
                </div>
                <div class="col-md-12">
                    <br/>
                    <br/>
                </div>
                <div class="col-lg-12 blog__content mb-72">
                    <div class="content-box">
                        <!-- user profile check -->
                        <div id="optpopup">
                            <h4 class="modal-title" id="myModalLabel">Withdrawal Tokens Form</h4>
                            <br/>
                            <div class="alert small alert-danger" id="formerror" style="display: none;">
                                <ul>

                                </ul>

                            </div>

                            <div class="alert alert-danger" id="tokenerror" style="display: none;">

                            </div>

                            <form method="POST" id="tokenwithd" action="" class="">
                                @csrf
                                <div class="modal-body p-0">

                                    <div id="emailalert" class="">
                                        <div class="alert alert-success small">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <strong>Success!</strong> Authorization Code Sent to your Email id
                                            "<strong>{{ $user->email }} </strong>"
                                        </div>
                                        <div class="text-center"><i class="small">Authorization Code expires within 5
                                                minutes</i></div>
                                    </div>

                                    <div class="form-group">
                                        <label>Authorization Code <span style="color: red;">*</span></label>
                                        <input type="number" value="" class="form-control" name="otp"
                                               placeholder="Enter OTP"
                                               required/>

                                    </div>
                                    <div class="form-group">
                                        <label>Amount to Withdraw (Sportco Tokens) <span
                                                    style="color: red;">*</span></label>
                                        <input type="number" min="{{ ceil($min_token_value['min_transaction_token'] + $min_token_value['ETH_token_Fee'])}}"
                                               class="form-control" name="token"
                                               placeholder="{{ ceil($min_token_value['min_transaction_token'] + $min_token_value['ETH_token_Fee']) }} tokens min"
                                               required/>

                                        <small style="" id="value">
                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <label>ERC 20 Wallet Address <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" name="wallet_address"
                                               placeholder="Address" required/>
                                        <small class="d-block mt-1">Don't have an ERC20 wallet?
                                            <u><a href="https://metamask.io/" target="_blank"> Create here</a></u>.
                                            <u><a href="https://youtu.be/ZIGUC9JAAw8" target="_blank">Learn how</a></u>.
                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <label>Enter Login Password <span style="color: red;">*</span></label>
                                        <input type="password" class="form-control" name="password" placeholder=""
                                               required/>
                                    </div>


                                    <div class="alert alert-warning small">
                                        <ul class="list-display list-checkmarks">
                                            <strong class="mb-2 d-block">Important Terms & Conditions</strong>
                                            @if($min_token_value['min_transaction_token'] != 0)
                                                <li>There is a minimum withdrawal requirement for withdrawing Sportco
                                                    Tokens. If a requested withdrawal is
                                                    below <strong>{{$min_token_value['min_transaction_token']}} SPCO
                                                        Tokens</strong>, the
                                                    withdrawal request will not complete.
                                                </li>
                                            @endif
                                            <li>The current withdrawal fee is
                                                <strong>{{$min_token_value['ETH_token_Fee']}} SPCO
                                                    Tokens ({{$min_token_value['trasactionfee']}} ETH)</strong>. This
                                                will
                                                be deducted from the amount of tokens that you are withdrawing and the
                                                balance will be transferred to you. Withdrawal fees are regularly
                                                adjusted according to blockchain conditions.
                                            </li>
                                            <li>Once a withdrawal request has been submitted, it can take us up to 1
                                                business day to process the request. We try and complete the withdrawal
                                                in 24 hours however please note that the time taken for cryptocurrency
                                                withdrawals totally depends on the blockchain network congestion.

                                            </li>
                                        </ul>

                                    </div>

                                </div>
                                <div class="modal-footer">
                                    @if($view  == 2)
                                        <a href="{{url('profile/'.$user->id)}}"
                                           class="btn btn-lg btn-primary btn-button">Cancel</a>
                                    @endif
                                    <button type="submit" id="" class="btn btn-lg btn-color btn-button">Withdraw
                                    </button>
                                </div>
                            </form>

                        </div>
                        <!-- user profile check -->
                    </div>
                </div>

            </div>
        </div> <!-- end post content -->
    </div>
    <!-- end main container -->

    <!-- user profile check -->

    <!-- user profile check -->


    <!-- nick name popup -->
@endsection

