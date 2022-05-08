@extends('admin.starter.starter')

@section('title','Site Settings')

@section('head_extra')

    <meta name="csrf_token" content="{{ csrf_token() }}"/>

@endsection

@section('content')

    <!-- START CONTAINER FLUID -->
    <div class=" container-fluid   container-fixed-lg bg-white">
        <div class="card card-transparent">
            {{--<div class="card-header">
                <div class="card-title">Token Setting</div>
            </div>--}}
            <div class="card-body">
                <h5>Site Setting</h5>


                <br/>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <form action="" id="site_meta" class="row" method="POST" autocomplete='off'
                      enctype="multipart/form-data">

                    @csrf
                    @foreach($datas as  $key  => $data)
                        @if($key <= 0)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{$data->name}}</label>
                                    <input type="text" class="form-control" name="{{$data->id}}_s"
                                           value="{{$data->value}}" required>
                                </div>
                            </div>
                        @endif

                        @if($key == 1)

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="d-flex justify-content-between">
                                        <div>{{$data->name}}</div>
                                        <div class="alert-danger pl-1 pr-1">SPCO :
                                            <strong>{{$meta_info['ETH_token_Fee']}}</strong></div>
                                    </label>
                                    <input type="text" class="form-control" name="{{$data->id}}_s"
                                           value="{{$data->value}}" required>
                                </div>
                            </div>
                        @endif
                        @if($key == 2)

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{$data->name}} {{$meta_info['ETH_token_Fee']}}</label>
                                    <input type="text" class="form-control" name="{{$data->id}}_s"
                                           value="{{$data->value}}" required>
                                </div>
                            </div>
                        @endif


                        @if($key == 3)
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label>{{$data->name}}</label>
                                    <input type="text" disabled="disabled" class="form-control" name="{{$data->id}}_s"
                                           value="$ {{$ETHUSD}}" style="color: #989696;">
                                </div>
                            </div>
                        @endif
                        @if($key == 4)
                            <div class="col-md-12">
                                <br/>
                                <hr/>
                            </div>
                            <div class="col-md-6">
                                <h5>Admin Email Setting</h5>
                                <br/>
                                <div class="form-group mb-4">
                                    <label>{{$data->name}}</label>
                                    <input type="text" class="form-control" name="{{$data->id}}_s"
                                           value="{{$data->value}}" required>
                                    <small style="color: #888484">User withdrawal requests notifications will be pushed to this E-Mail ID.</small>
                                </div>



                            </div>
                        @endif

                    @endforeach


                    <div class="col-md-12">
                        <br/>
                        <hr/>
                    </div>
                    <div class="col-md-6">
                        <h5>Referred Tokens</h5>
                        <br/>
                        <div class="form-group mb-4">
                            <label>{{$data->name}}</label>
                            <input type="number" class="form-control" name="{{$data->id}}_s" value="{{$data->value}}" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                    </div>
                    <button class="btn btn-primary">Submit</button>

                </form>



            </div>
        </div>
    </div>
    <!-- END CONTAINER FLUID -->

@endsection

