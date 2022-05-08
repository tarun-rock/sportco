@extends('front.master.main')
{{-- @section('head_extra')
   

@endsection --}}
@section('content')
<br><br>
	<div class="container pb-5">
		<div class="col-12">
	        <div class="dialog-box">
	            <h2 class="heading font-weight-bold"> Payment Incomplete </h2>
	            <p class="text-dark font-weight-semibold">Uh-oh! It looks like there was an error with the payment procedure,please return to the payment page and try again.</p>

	            <a class="btn btn-lg btn-primary" href="{{ url('/') }}">Let's Go!</a>
	        </div>
   		</div>	
	</div>


@endsection