@extends("admin.starter.starter")

@section("title","Country View")

@section("content")

    <div id="main-wrapper">
        
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Countries</h4>
                        <div class="d-flex align-items-center"></div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Countries</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <a href="{{route('cp.create')}}" id="" class="btn waves-effect waves-light btn-rounded btn-info mr-2 mb-2 float-right">create</a>
                    </div>
                    <div class="col-12">
                        @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        @endif
                        
                        <table class="table" id="example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    {{-- <th>razorpay</th>
                                    <th>stripe</th>
                                    <th>phonepe</th>
                                    <th>paytm</th>
                                    <th>paypal</th>
                                    <th>Active</th>
                                    <th>2checkout</th>
                                    <th>googlepay</th> --}}
                                    <th>plans</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($countries as $country)
                                <tr>
                                    <td>{{$country->id}}</td>
                                    <td>{{$country->name}}</td>
                                    {{-- <td>{{$country->razorpay}}</td>
                                    <td>{{$country->stripe}}</td>
                                    <td>{{$country->phonepe}}</td>
                                    <td>{{$country->paytm}}</td>
                                    <td>{{$country->paypal}}</td>
                                    <td>
                                        @if ($country->active)
                                            active
                                        @else
                                            inactive
                                        @endif
                                    </td>
                                    <td>{{$country->twocheckout}}</td>
                                    <td>{{$country->googlepay}}</td> --}}
                                    <td>
                                        <table>
                                            
                                            @foreach ($country->plans as $plan)
                                                @if($plan->active)
                                                <tr>
                                                    <td>{{$plan->plan_name}}</td>
                                                    <td>{{$plan->currency}} {{$plan->amount / 100}}</td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </table>
                                    </td>
                                    <td><a href="{{route('cp.edit', $country->id)}}">edit</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- {{$countries->links()}} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
@section('script_extra')

    <script type="text/javascript">
        function showDeleteMessage() {
            alert("Are you sure to Disable the row?");
        }
        $(document).ready(function() {
            $('#example').DataTable({
                "scrollX": true,
                "bStateSave": true,
                "fnStateSave": function (oSettings, oData) {
                    localStorage.setItem('offersDataTables', JSON.stringify(oData));
                },
                "fnStateLoad": function (oSettings) {
                    return JSON.parse(localStorage.getItem('offersDataTables'));
                }
            });


        } );
    </script>
@endsection
