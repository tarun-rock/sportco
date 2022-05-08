@extends("admin.starter.starter")

@section("title","Country Create")

@section("content")


<div class="page-wrapper">
            
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Create/Edit Country</h4>
                        <div class="d-flex align-items-center">
                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Create/Edit Country</li>
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
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <a href="{{route('cp.index')}}" id="" class="btn waves-effect waves-light btn-rounded btn-info mr-2 mb-2 float-right">Go Back</a>
                                    </div>
                                </div>
                                <br>
                                <form action="{{route('cp.save')}}" method="post">
                                    @csrf
                                    @if($country)
                                    <input type="text" name="country_id" id="" value="{{ $country->id ?? ''}}" hidden>
                                    @endif
                                    <div class="row">{{-- row --}}
                                        <div class="col-md-12">{{-- col-md-12 --}}
                                            <div class="form-group">{{-- form-group --}}
                                                <label for="" class="control-label">Country Name</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$country->name ?? old("name")}}" id="name" aria-describedby="inputGroupPrepend"  required  placeholder="Country Name">
                                                    @error("name")
                                                    <div  class="invalid-feedback">
                                                       {{$message}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>{{-- //form-group --}}
                                        </div>{{-- //col-md-12 --}}


                                        


                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="" class="control-label">Currency</label>
                                                    <div class="form-group">
                                                        <select name="currency" required id="" class="form-control">
                                                            <option value="">Choose Currency</option>
                                                            @foreach ($allCurrency as $currency)
                                                            <option
                                                                @if($country && $country->plans->count() > 0)
                                                                    @if($country->plans[0]->currency==$currency['code'])
                                                                        selected
                                                                    @endif
                                                                @endif
                                                                @if(old("currency")==$currency['code'])
                                                                    selected
                                                                @endif
                                                                value="{{ $currency["code"] }}">{{ $currency["code"] }} - {{ $currency["name"] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <input type="hidden" name="plan_id[]" value="{{ $country->plans[0]->id ?? 0 }}">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="" class="control-label">Plan Name (Monthly) </label>
                                                    <div class="form-group">
                                                        <input type="hidden" name="hidden_id[]" value="{{$country->plans[0]->plan_id ?? ''}}">
                                                        <input type="hidden" name="days[]" value="30">
                                                        <input readonly="readonly"  type="text" class="form-control " name="plan_name[]"
                                                            value="{{$country->plans[0]->plan_name ?? 'Monthly'}}" aria-describedby="inputGroupPrepend" required placeholder="Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="" class="control-label">Amount</label>
                                                    <div class="form-group">
                                                        {{-- <input type="hidden" name="hidden_amount[]" value="{{$plan->plan_id ?? ''}}"> --}}
                                                        <input min="1" step="0.01" type="number" class="form-control  " name="plan_amount[]"
                                                            @if($country)
                                                                value="{{$country->plans->count() > 0 ? $country->plans[0]->amount / 100 : ''}}"
                                                            @else
                                                                value="{{ old('plan_amount')[0]}}"
                                                            @endif
                                                            aria-describedby="inputGroupPrepend" required placeholder="Value">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <input type="hidden" name="plan_id[]" value="{{ $country->plans[1]->id ?? 0 }}">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="" class="control-label">Plan Name (Annual)</label>
                                                    <div class="form-group">
                                                        <input type="hidden" name="hidden_id[]" value="{{$plan->plans ?? ''}}">
                                                        <input type="hidden" name="days[]" value="365">
                                                        <input  readonly="readonly" type="text" class="form-control " name="plan_name[]"
                                                            value="{{$country->plans[1]->plan_name ?? 'Annual'}}" aria-describedby="inputGroupPrepend" required placeholder="Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="" class="control-label">Amount</label>
                                                    <div class="form-group">
                                                        <input min="1" step="0.01" type="number" class="form-control  " name="plan_amount[]"
                                                             @if($country)
                                                                value="{{$country->plans->count() > 0 ? $country->plans[1]->amount / 100 : ''}}"
                                                            @else
                                                                value="{{ old('plan_amount')[1]}}"
                                                            @endif

                                                        aria-describedby="inputGroupPrepend" required placeholder="Value">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">{{-- col-md-12 --}}
                                            <div class="form-group">{{-- form-group --}}
                                                <button type="submit" class="btn waves-effect waves-light btn-rounded btn-info" id="Button">Submit</button>
                                            </div>{{-- //form-group --}}
                                        </div>{{-- //col-md-12 --}}
                                    </div>{{-- //row --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right sidebar -->
    <!-- ============================================================== -->
    <!-- .right-sidebar -->
    <!-- ============================================================== -->
    <!-- End Right sidebar -->
    <!-- ============================================================== -->
    </div>

    @endsection
@section('script_extra')

@endsection