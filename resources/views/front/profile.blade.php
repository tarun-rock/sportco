<?php
$title = "$user->name | Sporto.io";
$description = "SportCo helps fans make money from their love of sports. You can create original content and play trivia games. In return for contributing to the SportCo ecosystem, you receive SportCo coins. You can use SportCo coins to  play more games, buy merchandise and memorabilia, and even tickets to sporting events. Join now, and reward your passion!";
$mediaurl = url('/images/img1.jpg');
?>
@extends('front.master.main')
@section("title", $title)
@section("meta_description", $description)
@section("meta_image", $mediaurl)
@section('head_extra')
    <script>
        ga('send', {
            hitType: 'event',
            eventCategory: 'Profile',
            eventAction: 'Page Loaded',
            eventLabel: 'Profile Page Loaded'
        });
    </script>
@endsection

@section('content')
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
                    <div class="content-box profilecontentouter p-0">

                        <div class="tabs">
                            <ul class="tabs__list">
                                <li class="tabs__item tabs__item--active">
                                    <a href="#profile" class="tabs__url tabs__trigger">Post</a>
                                </li>
                                <li class="tabs__item">
                                    <a href="#play" class="tabs__url tabs__trigger">Play</a>
                                </li>
                                @auth
                                    @if($user->id == Auth::user()->id)


                                        <li class="tabs__item">
                                            <a href="#withdrawal" class="tabs__url tabs__trigger">Token</a>
                                        </li>
                                        <li class="tabs__item">
                                            <a href="#referredfrds" class="tabs__url tabs__trigger">Referred Friends</a>
                                        </li>
                                    @endif
                                @endauth

                                {{-- <li class="tabs__item">
                                    <a href="#edit" class="tabs__url tabs__trigger">Edit</a>
                                </li> --}}
                            </ul>
                        </div>
                        <div class="tabs__content tabs__content-trigger">
                            <div class="tabs__content-pane tabs__content-pane--active" id="profile">
                                <div class="row">

                                    <div class="col-md-12">
                                        <h4 class="m-t-2"><span class="fa fa-clock-o ion-clock pull-xs-right"></span>
                                            Recent Activity</h4>
                                        <div id="postactivity" class="table-responsive">
                                            @include('front.postactivity')
                                        </div>

                                    </div>
                                </div>
                                <!--/row-->
                            </div>
                            <div class="tabs__content-pane" id="play">
                                <h4 class="m-t-2"><span class="fa fa-clock-o ion-clock pull-xs-right"></span> Recent
                                    Activity</h4>
                                <div id="playactivity" class="table-responsive">
                                    @include('front.playactivity')
                                </div>

                            </div>
                            @auth
                                @if($user->id == Auth::user()->id)
                                    <div class="tabs__content-pane" id="withdrawal">
                                        <h4 class="m-t-2"><span class="fa fa-clock-o ion-clock pull-xs-right"></span>
                                            Withdrawal History</h4>
                                        <div id="tokenHistory" class="table-responsive">
                                            @include('front.TokenHistory')
                                        </div>

                                    </div>
                                    <div class="tabs__content-pane" id="referredfrds">
                                        <h4 class="m-t-2"><span class="fa fa-clock-o ion-clock pull-xs-right"></span>
                                            Invite History</h4>
                                        <div id="referredUsers" class="table-responsive">
                                            @include('front.referredUsers')
                                        </div>
                                    </div>
                                @endif
                            @endauth
                            {{--
                            <div class="tabs__content-pane" id="edit">
                                <h4 class="m-y-2">Edit Profile</h4>
                                <form role="form">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">First name</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" value="Jane">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Last name</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" value="Bishop">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="email" value="email@gmail.com">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Company</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Website</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="url" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Address</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" value="" placeholder="Street">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label"></label>
                                        <div class="col-lg-6">
                                            <input class="form-control" type="text" value="" placeholder="City">
                                        </div>
                                        <div class="col-lg-3">
                                            <input class="form-control" type="text" value="" placeholder="State">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Time Zone</label>
                                        <div class="col-lg-9">
                                            <select id="user_time_zone" class="form-control" size="0">
                                                <option value="Hawaii">(GMT-10:00) Hawaii</option>
                                                <option value="Alaska">(GMT-09:00) Alaska</option>
                                                <option value="Pacific Time (US &amp; Canada)">(GMT-08:00) Pacific Time (US &amp; Canada)</option>
                                                <option value="Arizona">(GMT-07:00) Arizona</option>
                                                <option value="Mountain Time (US &amp; Canada)">(GMT-07:00) Mountain Time (US &amp; Canada)</option>
                                                <option value="Central Time (US &amp; Canada)" selected="selected">(GMT-06:00) Central Time (US &amp; Canada)</option>
                                                <option value="Eastern Time (US &amp; Canada)">(GMT-05:00) Eastern Time (US &amp; Canada)</option>
                                                <option value="Indiana (East)">(GMT-05:00) Indiana (East)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Username</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" value="janeuser">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Password</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="password" value="11111122333">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Confirm password</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="password" value="11111122333">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label"></label>
                                        <div class="col-lg-9">
                                            <input type="reset" class="btn btn-secondary" value="Cancel">
                                            <input type="button" class="btn btn-primary" value="Save Changes">
                                        </div>
                                    </div>
                                </form>
                            </div> --}}
                        </div>
                    </div>
                </div>

            </div>

            <hr>
        </div> <!-- end post content -->
    </div>
    <!-- end main container -->
    <!-- nick name popup -->
    {{--
    <div class="modal fade" id="nickname" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Update Nick Name</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                    <form action="" id="n_nameupdate" method="POST">
                        @csrf
                        <div class="modal-body">

                            <label>Nick Name</label>
                             <input type="text" class="form-control"  name="nickname" value="" required/>

                            <button type="submit" class="btn btn-lg btn-color btn-button">Save</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>--}}




    <!-- nick name popup -->


@endsection
