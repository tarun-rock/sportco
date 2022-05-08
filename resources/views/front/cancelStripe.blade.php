@extends('front.master.main')
{{-- @section('head_extra')
   

@endsection --}}
@section('content')
<br><br>
	<div class="container pb-5">
		<div class="col-12">
           	<div class="dialog-box">
               	<h2 class="heading font-weight-bold">We' re sorry to see you go! </h2>
               	<p class="text-dark font-weight-semibold">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod libero amet, laborum qui nulla quae alias tempora. Placeat voluptatem eum numquam quas distinctio  </p>
               	<div class="row justify-content-around">
                   	<div class="col-md-8">
                    	<ul class="list-unstyled my-5">
	                        <li>
	                          <input type="radio" id="f-option" name="selector">
	                          <label for="f-option">I want happy with the content of the website</label>
	                          
	                          <div class="check"></div>
	                        </li>
	                        <li>
	                          <input type="radio" id="s-option" name="selector">
	                          <label for="s-option">My finacial situation changes</label>
	                          
	                          <div class="check"><div class="inside"></div></div>
	                        </li>
	                        <li>
	                          <input type="radio" id="t-option" name="selector">
	                          <label for="t-option">I found better website with similar content</label>
	                          
	                          <div class="check"><div class="inside"></div></div>
	                        </li>
	                        <li>
	                            <input type="radio" id="p-option" name="selector">
	                            <label for="p-option">other reasons ( Please explane below)</label>
	                            
	                            <div class="check"><div class="inside"></div></div>
	                        </li>
                          <div class="clearfix"></div>
                      	</ul>
                   	</div>
               </div>
               <a class="btn btn-lg btn-secondary mx-2" href="#">No, take me back</a>

               <a class="btn btn-lg btn-primary mx-2" href="{{ url('cancel_membership') }}">Cancel subscription</a>
           	r</div>
      	</div>
    </div>              


@endsection