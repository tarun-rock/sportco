@extends("admin.starter.starter")

@section("content")
    <div class=":-fluid col  bg-white">
        <br/>
        <div class="row">
            <div class="col-xlg-12 col-xl-12">
                <h3 class="page-title">Posts</h3>
                <hr/>
            </div>
            <div class="col-lg-4 col-xl-3 col-xlg-2 ">
                <div class="row">
                    <div class="col-md-12 m-b-10">
                        <!-- START WIDGET D3 widget_graphTileFlat-->
                        <div class="widget-8 card no-border bg-danger no-margin widget-loader-bar plinks">
                            <a href="{{ url("dashboard/postlisting") }}" class="">&nbsp;</a>
                            <div class="container-xs-height full-height">
                                <div class="row-xs-height">
                                    <div class="col-xs-height col-top">
                                        <div class="card-header  top-left top-right">
                                            <div class="card-title text-black hint-text">
                                <span class="font-montserrat fs-11 all-caps">Total Posts
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-xs-height ">
                                    <div class="col-xs-height col-top relative">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="p-l-20">
                                                    <h3 class="no-margin p-b-5 text-white">{{$totalPosts}}</h3>

                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET -->

                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3 col-xlg-2 ">
                <div class="row">
                    <div class="col-md-12 m-b-10">
                        <!-- START WIDGET D3 widget_graphTileFlat-->
                        <div class="widget-8 card no-border bg-warning no-margin widget-loader-bar plinks">
                            <a href="{{ url("dashboard/post-pending") }}" class="">&nbsp;</a>
                            <div class="container-xs-height full-height ">
                                <div class="row-xs-height">
                                    <div class="col-xs-height col-top">
                                        <div class="card-header  top-left top-right">
                                            <div class="card-title text-black hint-text">
                                <span class="font-montserrat fs-11 all-caps">PENDING POSTS
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-xs-height ">
                                    <div class="col-xs-height col-top relative">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="p-l-20">
                                                    <h3 class="no-margin p-b-5 text-white">{{ $pendingPost }}</h3>

                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                            </div>
                                        </div>
                                        <div class='widget-8-chart line-chart' data-line-color="black"
                                             data-points="true" data-point-color="warning" data-stroke-width="2">
                                            <svg></svg>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- END WIDGET -->

                    </div>
                </div>
            </div>

        </div>
        <hr/>
        <div class="row">
            <div class="col-xlg-12 col-xl-12">
                <h3 class="page-title">Users</h3>
            </div>
            <div class="col-lg-4 col-xl-3 col-xlg-2 ">
                <div class="row">
                    <div class="col-md-12 m-b-10">
                        <!-- START WIDGET D3 widget_graphTileFlat-->
                        <div class="widget-8 card no-border bg-success no-margin widget-loader-bar plinks">
                            <a href="{{ url("dashboard/users") }}" class="">&nbsp;</a>
                            <div class="container-xs-height full-height">
                                <div class="row-xs-height">
                                    <div class="col-xs-height col-top">
                                        <div class="card-header  top-left top-right">
                                            <div class="card-title text-black hint-text">
                                <span class="font-montserrat fs-11 all-caps">Total Users
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-xs-height ">
                                    <div class="col-xs-height col-top relative">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="p-l-20">
                                                    <h3 class="no-margin p-b-5 text-white">{{$totalUsers}}</h3>

                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET -->

                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3 col-xlg-2 ">
                <div class="row">
                    <div class="col-md-12 m-b-10">
                        <!-- START WIDGET D3 widget_graphTileFlat-->
                        <div class="widget-8 card no-border bg-info no-margin widget-loader-bar">
                            <div class="container-xs-height full-height">
                                <div class="row-xs-height">
                                    <div class="col-xs-height col-top">
                                        <div class="card-header  top-left top-right">
                                            <div class="card-title text-black hint-text">
                                <span class="font-montserrat fs-11 all-caps" style="color:#fff">Users Added Today
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-xs-height ">
                                    <div class="col-xs-height col-top relative">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="p-l-20">
                                                    <h3 class="no-margin p-b-5 text-white">{{ $todayUsers }}</h3>

                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                            </div>
                                        </div>
                                        <div class='widget-8-chart line-chart' data-line-color="black"
                                             data-points="true" data-point-color="warning" data-stroke-width="2">
                                            <svg></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET -->

                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-xlg-12 col-xl-12">
                <h3 class="page-title">Tokens</h3>
            </div>
            <div class="col-lg-4 col-xl-3 col-xlg-2 ">
                <div class="row">
                    <div class="col-md-12 m-b-10">
                        <!-- START WIDGET D3 widget_graphTileFlat-->
                        <div class="widget-8 card no-border bg-complete no-margin widget-loader-bar">
                            <div class="container-xs-height full-height">
                                <div class="row-xs-height">
                                    <div class="col-xs-height col-top">
                                        <div class="card-header  top-left top-right">
                                            <div class="card-title text-black hint-text">
                                <span class="font-montserrat fs-11 all-caps">Total Tokens
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-xs-height ">
                                    <div class="col-xs-height col-top relative">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="p-l-20">
                                                    <h3 class="no-margin p-b-5 text-white">{{ $tokenAwarded }}</h3>

                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                            </div>
                                        </div>
                                        <div class='widget-8-chart line-chart' data-line-color="black"
                                             data-points="true" data-point-color="warning" data-stroke-width="2">
                                            <svg></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET -->

                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3 col-xlg-2 ">
                <div class="row">
                    <div class="col-md-12 m-b-10">
                        <!-- START WIDGET D3 widget_graphTileFlat-->
                        <div class="widget-8 card no-border bg-primary no-margin widget-loader-bar">
                            <div class="container-xs-height full-height">
                                <div class="row-xs-height">
                                    <div class="col-xs-height col-top">
                                        <div class="card-header  top-left top-right">
                                            <div class="card-title text-black hint-text">
                                <span class="font-montserrat fs-11 all-caps" style="color:#fff">Tokens Awarded Today
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-xs-height ">
                                    <div class="col-xs-height col-top relative">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="p-l-20">
                                                    <h3 class="no-margin p-b-5 text-white">{{$tokenRadeem}}</h3>

                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                            </div>
                                        </div>
                                        <div class='widget-8-chart line-chart' data-line-color="black"
                                             data-points="true" data-point-color="warning" data-stroke-width="2">
                                            <svg></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET -->

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection