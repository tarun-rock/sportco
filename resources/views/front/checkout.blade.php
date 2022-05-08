@extends('front.master.main')
@section('content')

    <main class="main oh pt-40 pb-80" id="main">

        <div class="main-container container" id="main-container">
            {{--<h1 class="page-title">{{ ucfirst($name) ?? "" }}</h1>--}}
            <h1 class="page-title">Checkout</h1>
            <br/>
            <div class="row">
                <div class="col-md-8">
                    <div class="content-box">
                        <div class="title-wrap">
                            <h3>Shipping Details</h3>
                        </div>
                        <form action="" id="shipping_address" method="POST">
                            @csrf
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First name</label>
                                    <input name="fastname" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last name</label>
                                    <input name="lastname" type="text">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email <span class="text-muted">(Optional)</span></label>
                                    <input name="email" type="email">
                                </div>
                            </div>
                            <div class="col-md-6 noinputarrow">
                                <div class="form-group">
                                    <label>Zip</label>
                                    <input name="address_1" type="number">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input name="address_1" type="text">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address 2</label>
                                    <input name="address_2" type="text">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" name="city" class=""/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>State</label>
                                            <select name="state">
                                                <option selected="" value="default">Select an option</option>
                                                <option value="state_1">State 1</option>
                                                <option value="state_2">State 2</option>
                                                <option value="state_3">State 3</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <select name="country">
                                                <option selected="" value="default">Select an option</option>
                                                <option value="india">India</option>
                                                <option value="uk">United Kingdom</option>
                                                <option value="usa">USA</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mobile Number</label>
                                            <input type="tel" class="" name="phone_number"/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                    <button type="submit" class="btn btn-color">Submit</button>
                                    </div>


                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="content-box pl-4 pr-4">
                        @if(Cart::count()> 0)
                            <ul class="mb-3">
                                @foreach(Cart::content() as $item)
                                    <li class="d-flex justify-content-between lh-condensed border-bottom pb-3 mb-3">

                                        <div class="d-flex">
                                            <div class="mr-2">
                                                <form action="{{route('destory', $item->rowId)}}" method="post"
                                                      class="text-right">
                                                    {{ csrf_field()}}
                                                    {{method_field('DELETE')}}
                                                    <button type="submit"
                                                            class="btn-outline-secondary small border-0 p-0">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div>
                                                <p class="my-0">{{$item->name}}</p>
                                                <small class="text-info">QTY: {{$item->qty}}, Price: {{$item->price}}
                                                    Tokens
                                                </small>
                                            </div>
                                        </div>
                                        <h6>{{$item->price * $item->qty}}
                                            <small>Tokens</small>
                                        </h6>
                                    </li>
                                @endforeach
                                <li class=" d-flex justify-content-between">
                                    <h5>Total</h5>
                                    <h5>{{Cart::total()}} Tokens</h5>
                                </li>
                            </ul>
                        @else
                            <div class="text-center">
                                <h2>No Items in Cart</h2>
                                <a class="btn btn-color btn-sm" href="{{route('store')}}">Shop Now</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>


        </div>
    </main> <!-- end main container -->





@endsection
@section('script_extra')

@endsection