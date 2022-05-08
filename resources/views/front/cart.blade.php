@extends('front.master.main')
@section('content')

    <main class="main oh pt-40 pb-80" id="main">

        <div class="main-container container" id="main-container">
            {{--<h1 class="page-title">{{ ucfirst($name) ?? "" }}</h1>--}}
            <br/>
            <div class="row">
                <div class="col-md-12">
                    {{--@if (session()->has('success_message'))
                        <div class="alert alert-success">
                            {{session()->get('success_message')}}
                        </div>
                    @endif--}}


                    <div class="container">
                        @if(Cart::count()> 0)
                            <div class="d-flex justify-content-between border-bottom mb-4">
                                <h1 class="page-title">Checkout</h1>
                                <div class="mt-3"><a class="btn btn-color btn-sm" href="{{route('store')}}">Continue
                                        Shopping</a></div>
                            </div>
                            <h5>{{Cart::count()}} Item(s) In Cart</h5>


                            <table class="table table-striped table-hover table-bordered">
                                <tbody>
                                <tr>
                                    <th>Item</th>
                                    <th>QTY</th>
                                    <th>Unit Price</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>


                                @foreach(Cart::content() as $item)
                                    <tr>
                                        <td>{{$item->name}} </td>
                                        <td>{{$item->qty}}</td>
                                        <td>{{$item->price}} Tokens</td>
                                        <td>{{$item->price * $item->qty}} Tokens</td>
                                        <td>
                                            <form action="{{route('destory', $item->rowId)}}" method="post">
                                                {{ csrf_field()}}
                                                {{method_field('DELETE')}}
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <th colspan="3" class="text-right"><span>Sub Total</span></th>
                                    <th colspan="2">{{Cart::subtotal()}} Tokens</th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-right"><span>VAT 0%</span></th>
                                    <th colspan="2">{{Cart::tax()}}</th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-right"><span>Total</span></th>
                                    <th colspan="2">{{Cart::total()}}</th>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="4">
                                       {{-- @if (Cart::total() <= userTokens(10))
                                elligibal
                                @else

                                no elligibal
                                @endif--}}
                                        @if($item->options->virtual == 1)
                                        <button type="button" id="checkout" class="pull-right btn btn-success btn-sm">Checkout</button>
                                            @else
                                            <span class="text-danger">Select Virtual Product</span>
                                        @endif

                                    </td>
                                    {{--<td colspan="4"><a href="{{route('productCheckout')}}" class="pull-right btn btn-success btn-sm">Checkout</a></td>--}}
                                </tr>
                                </tbody>
                            </table>



                        @else
                            <h2>No Items in Cart</h2>
                            <a class="btn btn-color btn-sm" href="{{route('store')}}">Continue Shopping</a>

                        @endif


                    </div>

                </div>
            </div>


        </div>
    </main> <!-- end main container -->





@endsection
@section('script_extra')
    <script>
        $(document).ready(function () {
            $("#checkout").click(function () {
                swal({
                    title: 'Please Wait',
                    html: '<h1 class="mt-5 mb-5 fa fa-spinner fa-spin"></h1>',
                    showConfirmButton: false
                });
                $.ajax({
                    url:"{{route('PlaceOrderByToken')}}",
                    type: "POST",
                    data:{
                        "_token": "{{ csrf_token() }}",
                    },

                }).done(function (data) {
                    if (data == 1) {

                        swal({
                            title: "Success!",
                            text: "Your order is placed",
                            type: "success"
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "{{ route("store") }}"
                            }
                        })
                    }


                    if (data.status == 0){

                        swal({
                            title: "Error",
                            text: data.message,
                            type: "error"
                        })

                    }

                }).fail(function () {

                });
            })
        })
    </script>

@endsection