<!-- START HEADER -->
<div class="header ">
    <!-- START MOBILE SIDEBAR TOGGLE -->
    <a href="#" class="btn-link toggle-sidebar d-lg-none pg pg-menu" data-toggle="sidebar">
    </a>
    <!-- END MOBILE SIDEBAR TOGGLE -->
    <div class="">
        {{--  --}}
        <!-- START NOTIFICATION LIST -->
        <ul class="d-lg-inline-block d-none notification-list no-margin d-lg-inline-block b-grey b-l b-r no-style p-l-30 p-r-20">
            <li class="p-r-10 inline">
                <div class="dropdown">
                    <a href="javascript:;" id="notification-center" class="header-icon pg pg-world"
                       data-toggle="dropdown">
                        <span class="bubble"></span>
                    </a>
                    <!-- START Notification Dropdown -->
                    <div class="dropdown-menu notification-toggle" role="menu" aria-labelledby="notification-center">
                        <!-- START Notification -->
                        <div class="notification-panel">
                            <!-- START Notification Body-->
                            <div class="notification-body scrollable">
                                <!-- START Notification Item-->
                                @foreach(notification() as $notification)



                                    <div class="notification-item  clearfix" data-id="{{$notification-> id}}">
                                        <div class="heading">

                                            <i class="fa  pg-arrow_right m-r-5"></i>
                                            <span class="bold">{{$notification-> notification}}</span>


                                            <span class="pull-right time">

                                            {{ parsePostDate($notification->created_at)  }}
                                        </span>
                                        </div>
                                        <!-- START Notification Item Right Side-->

                                    </div>
                            @endforeach
                            <!-- END Notification Item-->
                                <!-- START Notification Footer-->

                                <!-- START Notification Footer-->
                            </div>
                            <!-- END Notification -->
                        </div>
                        <!-- END Notification Dropdown -->
                    </div>
            </li>
        </ul>
        <!-- END NOTIFICATIONS LIST -->
        {{--<a href="#" class="search-link d-lg-inline-block d-none" data-toggle="search"><i class="pg-search"></i>Type anywhere to <span class="bold">search</span></a>--}}
    </div>
    <div class="d-flex align-items-center">
        <!-- START User Info-->
        <div class="pull-left p-r-10 fs-14 font-heading d-lg-block d-none">
            <span class="semi-bold">Admin</span>
        </div>
        <div class="dropdown pull-right d-lg-block d-none">
            <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
              <span class="thumbnail-wrapper d32 circular inline">
              <img src="{{ asset("admin/assets/img/profiles/avatar.jpg") }}" alt=""
                   data-src="{{ asset("admin/assets/img/profiles/avatar.jpg") }}"
                   data-src-retina="{{ asset("admin/assets/img/profiles/avatar_small2x.jpg") }}" width="32" height="32">
              </span>
            </button>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
                <a href="#" class="dropdown-item"><i class="pg-settings_small"></i> Settings</a>
                <a href="#" class="dropdown-item"><i class="pg-outdent"></i> Feedback</a>
                <a href="#" class="dropdown-item"><i class="pg-signals"></i> Help</a>
                <a class="clearfix bg-master-lighter dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <span class="pull-left">Logout</span>
                    <span class="pull-right"><i class="pg-power"></i></span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                </a>
            </div>
        </div>
        <!-- END User Info-->
        {{--<a href="#" class="header-icon pg pg-alt_menu btn-link m-l-10 sm-no-margin d-inline-block" data-toggle="quickview" data-toggle-element="#quickview"></a>--}}
    </div>
</div>
<!-- END HEADER -->
