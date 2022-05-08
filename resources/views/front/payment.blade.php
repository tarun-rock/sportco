@extends('front.master.main')
{{-- @section('head_extra')
@endsection --}}
@section('content')
<br/><br/>
<div class="container">
   @php
      $user = Auth::User();

      $checkName = explode('-', $user->name);
      /*if($checkName[0] == "guest"){
        Auth::logout();    
      }*/
      
      /*$plans = App\Model\countries::where('country_id', $user->country_id)->where('active', 1)->get();*/
      /*$updPass = App\Model\countries::where([
                    "active" => 1,
                ])->get(['name','id']);
      dd($updPass);*/
      
      // $plans = App\Model\Plans::where('country_id', $user->country_id)->where('active', 1)->get();
      // dd($plans);

   @endphp
   
   @isset($data)
   @if($data['gateway'] == 2)
   {{-- stripe --}}
   <input id="stripe_session_id" type="hidden" value="{{$data['id']}}">
   <script src="https://js.stripe.com/v3/"></script>
   <script type="text/javascript">
      var stripe = Stripe('{{env("STRIPE_KEY")}}');
      stripe.redirectToCheckout({sessionId: document.getElementById('stripe_session_id').value});
   </script>
   @endif
   @endisset
   <form id="paypal" method="post" action="{{ url('stripe') }}">
      @csrf
      <div class="row plans-blade">
         <div class="col-md-8">

            <h2 class="heading font-weight-bold">Become part of a growing digital sports community with Sportco+</h2>
            
            <h3 class="sub-heading">As a member, get access to:</h3>
            <ul class="list-unstyled feature-list">
               <li>1) Premium Sportco Content</li>
               <li>2) Tactical Analysis, Predictions, Head-to-head articles for Football, Tennis, Basketball</li>
               <li>3) Editor's choice articles</li>
               <li>4) Sports Quiz and Trivia</li>
               <li>5) E-Books</li>
            </ul>
         </div>
         <div class="col-md-4">
            <h4 class="plan-title d-flex justify-content-between align-items-center">
               <span class="title">Select your Plan</span>
               <span class="line"></span> 
               <span class="tag">50%off</span>
            </h4>
            {{-- @if(count($plans) > 0)
               
               @foreach($plans as $plan)
                  <label class="plan-label" for="{{ $plan->plan_name }}">
                     <input type="radio" id="{{ $plan->plan_name }}" name="plan" value="{{ $plan->id }}" name="selector">
                     <div class="check-circle"></div>
                        <p style="color: white;">Sportco Plus {{ $plan->plan_name }} plan</p>
                        <div class="d-flex align-items-end justify-content-between">
                           
                           <h5 class="mb-0" style="color: white;">{{ $plan->plan_name }} Plan</h5>
                           
                           <h1 class="mb-0" style="color: white;">
                              <del class="d-block" style="color: #999; font-size: 18px; ">{{ $plan->currency }} {{ $plan->amount / 100 }}</del>
                              {{ $plan->currency }} {{ $plan->amount / 100 }}</h1>
                        </div>
                  </label>
               @endforeach
            @else --}}

               <label class="plan-label" for="1">
                  <input type="radio" id="1" name="plan" value="plan" name="selector">
                  <div class="check-circle"></div>
                  <p style="color: white;">Sportco Plus Monthly plan</p>
                  <div class="d-flex align-items-end justify-content-between">
                     
                     <h5 class="mb-0" style="color: white;">Monthly Plan</h5>
                     
                     <h1 class="mb-0" style="color: white;">
                        <del class="d-block" style="color: #999; font-size: 18px; ">$2</del>
                        $1</h1>
                  </div>
               </label>
               <label class="plan-label" for="2">
                  <input type="radio" id="2" name="plan" value="plan" name="selector">
                  <div class="check-circle"></div>
                  <p style="color: white;">Sportco Plus Yearly plan</p>
                  <div class="d-flex align-items-end justify-content-between">
                     
                     <h5 class="mb-0" style="color: white;">Yearly Plan</h5>
                     
                     <h1 class="mb-0" style="color: white;">
                        <del class="d-block" style="color: #999; font-size: 18px; ">$12</del>
                        $6</h1>
                  </div>
               </label>


            {{-- @endif --}}
            
            <input type="submit" name="submit" class="btn btn-lg btn-primary d-block" value="Continue">
            
         </div>
         <div class="col-12 my-5"></div>
      </div>
   </form>
</div>
@endsection

@section('script_extra')
    <script type="text/javascript">
       $("#wrong").modal('show');  
    </script>
@endsection