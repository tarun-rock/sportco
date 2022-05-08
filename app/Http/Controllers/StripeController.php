<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;
use App\User;
use Carbon\Carbon;
use App\Model\Plans;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Psr7\Request as Psr7Request;


use App\Model\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;





class StripeController extends Controller
{
    
    public function payment()
    {
        $user = Auth::User();
        $plans = Plans::where('country_id', $user->country_id)->where('active', 1)->get();
        dd($plans);
            
        return view('front.payment');
    }

    public function stripePost(Request $request)
    {
        /*Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
    			// 'name',"amount","currency",
                "source" => $request->stripeToken,
                "description" => "This payment is tested purpose phpcodingstuff.com",
    			// "address" => ["city" => 'city', "country" => 'india', "line1" => "address", "line2" => "", "state" => "punjab"]

        ]);
        */

            $user_id = Auth::User();

            $checkName = explode('-', $user_id->name);
            if($checkName[0] == "guest"){
                Auth::logout();  
                return  redirect('login');

            }

            /*if(!$user_id){
                // return view('auth/login');
                return  redirect('login');

            }*/

            \Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));

            /*$amount = $request->plan;
            if($amount == "Upgrade Plan"){
                $amount = 5;
            }*/

            // $amount = (int)$amount * 100;

            $plan = Plans::where('id',$request->plan)->first();

            $amount = (int)$plan->amount;
            $amount = (int)$amount;
            $newplan_name = $plan->plan_name;


            if($plan->days == 365){
                $newplan_period = "year";
            }else{
                $newplan_period = "month";
            }

            $allplans = \Stripe\Plan::all();
            // dd($allplans->data);
            $found_plan = null;
            foreach($allplans->data as $stripe_plan){
                if($stripe_plan->interval == $newplan_period && $stripe_plan->amount == $amount && $stripe_plan->currency == strtolower($plan->currency)){
                    $found_plan = $stripe_plan->id;
                    // dd($rzr_plan);
                }
            }
            // prod_KLmemf46TU3A2T

            if(is_null($found_plan)){
                $newplanArray = [
                    'amount' => $amount,
                    'currency' => $plan->currency,
                    'interval' => $newplan_period,
                    'product' => /*env("STRIPE_PRODUCT")*/ "prod_KLmemf46TU3A2T",
                ];
                $newplan = \Stripe\Plan::create($newplanArray);
            }

            $data = array();
            $data['success_url'] = url('/').'/payment/stripe/status/{CHECKOUT_SESSION_ID}';
            $data['cancel_url'] = url('/payment/stripe/failed');
            $data['payment_method_types'] = ['card'];
            $data['mode'] = 'subscription';
            $data['subscription_data'] = array();
            $data['subscription_data']['items'] = array();
            $data['subscription_data']['items'][]['plan'] = $newplan->id ?? $found_plan;
            $data['subscription_data']['metadata'] = array();
            $data['subscription_data']['metadata']['user_id'] = $user_id->id ?? 0;
            // $data['subscription_data']['metadata']['promo_id'] = $isAvail['id'] ?? 0;
            // $data['client_reference_id'] = $user_id ?? 0;
            // dd($data);
            $checkout_session = \Stripe\Checkout\Session::create($data);
            $data = array();
            $data['id'] = $checkout_session->id;
            $data['gateway'] = 2;
            return view('front.payment', compact('data', 'user_id'));
            return json_encode(['id' => $checkout_session->id]);

    }

    public function status($id){
        // dd("dsd");
        \Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));
        $session    = \Stripe\Checkout\Session::retrieve($id);
        $customer   = \Stripe\Customer::retrieve($session->customer);
        // dd($session->mode);
        if($session->mode == 'subscription'){
            $sub        = \Stripe\Subscription::retrieve($session->subscription);
        // return($sub);
            $subscription_id    = $session->subscription;
            $currency           = strtoupper($session->currency);
            $amount             = $session->amount_total / 100;
            $charge_at          = $sub->start_date;
            /* time */
            $start_at           = $sub->current_period_start;
            $end_at             = $sub->current_period_end;
            $start              = new Carbon($start_at);
            $end                = new Carbon($end_at);
            $days               = $start->diffInDays($end);
            /* // time */
            // dd($days);
            $duration           = 'Other';
            if($days            == 365 or $days == 364){
                $duration       = 'Annual';
            }elseif($days       == 30 or $days == 31){
                $duration       = 'Monthly';
            }






            return view('front.success', compact('subscription_id', 'currency', 'amount', 'charge_at', 'duration'));
        }elseif($session->mode == 'payment'){
            // if($session->payment_status == 'paid'){
            //     $paymentIntent      = \Stripe\PaymentIntent::retrieve($session->payment_intent);
            //     if($paymentIntent->status == 'succeeded'){
            //         $subscription_id    = $session->payment_intent;
            //         $currency           = strtoupper($session->currency);
            //         $amount             = $session->amount_total / 100;
            //         /* time */
            //         $start_at           = $paymentIntent->created;
            //         // dd($session);
            //         $start              = new Carbon($start_at);
            //         $end = $start;
            //         $end                = $end->addWeeks($session->metadata['pkg']);
            //         $days               = $start->diffInDays($end);
            //         // dd($days);
            //         $charge_at = $start_at;
            //         $duration = $session->metadata['pkg']. ' Weeks';
            //         return view('front.success', compact('subscription_id', 'currency', 'amount', 'charge_at', 'duration'));
            //     }
            // }
        }
        return view('front.failedStripe');
        
    }

    public function failed(){
        return view('front.failedStripe');
    }

    public function webhook(Request $request)
    {
        \Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));
        $payload = @file_get_contents('php://input');
        $event = null;
        $time = time();
        try {
            $event = \Stripe\Event::constructFrom(
                json_decode($payload, true)
            );
                    // dd($event->type);

            switch ($event->type) {
                case 'payment_intent.succeeded':
                    $payment = $event->data->object;
                    // return $payment;

                    return response()->json(['status' => 200, 'message' => 'Webhook Received',]);
                    break;
                case 'payment_method.attached':
                    $payment = $event->data->object;
                    return response()->json(['status' => 200, 'message' => 'Webhook Received',]);
                    break;
                // ... handle other event types
                case 'checkout.session.completed':
                    // return "checkout";
                    $payment = $event->data->object;

                    if($payment->payment_status == 'paid'){
                        // return "paid";
                        $createPayment = new Payment();
                        $createPayment->user_id         = $payment->metadata['user_id'];
                        $createPayment->transaction_id  = $payment->payment_intent;
                        $createPayment->plan_id         = $payment->metadata['pkg'];
                        $createPayment->customer_id     = $payment->metadata['user_id'];
                        $createPayment->amount          = $payment->amount_total;
                        $createPayment->currency        = strtoupper($payment->currency);
                        $createPayment->payment_status  = 1;
                        $createPayment->start_time      = Carbon::now()->toDateTimeString();
                        $createPayment->end_time        = Carbon::now()->addWeeks($payment->metadata['pkg'])->toDateTimeString();
                        $createPayment->save();
                    }
                        // return "not-paid";

                    /*$user = User::find($payment->metadata['user_id']);
                    $details = array();
                    Mail::to($user->email)->queue(new SummerPackageMail($details));
                    Storage::disk('local')->put('event' . $time . '.json', $event);*/
                    return response()->json(['status' => 200, 'message' => 'Webhook Received',]);
                    break;
                // ... handle other event types
                case 'invoice.payment_succeeded':
                        // print_r("subscription");
                        // return "subscription";
                    $payment = $event->data->object;

                    $data   = $payment->lines->data[0];
                    $ispaid = $payment->paid;
                    // return $payment;
                    if ($ispaid && $data->type = 'subscription') { 
                    // vars
                        // print_r("subscription");
                        // return "in";
                        $billing_reason = $payment->billing_reason;
                        $currency       = $payment->currency;
                        $customer       = $payment->customer;
                        $status         = $payment->status;
                        $total          = $payment->total;
                        $periodBox      = $data->period;
                        $planBox        = $data->plan;
                        $priceBox       = $data->price;
                        $user_id        = $data->metadata->user_id;
                        $sub      = DB::table('payment')->where('transaction_id',$data->subscription)->first();
                        $started  = $periodBox->start;
                        $ended    = $periodBox->end;

                        $started_ok        = Carbon::createFromTimestamp($started)->toDateTimeString();
                        $ended_ok          = Carbon::createFromTimestamp($ended)->toDateTimeString();
                        $transaction_id    = $data->subscription;
                        $if_already_exist = DB::table('payment')->where('transaction_id', $transaction_id)->where('start_time', $started_ok)->where('end_time', $ended_ok)->where('active', 1)->first();
                        if($if_already_exist){
                            return response()->json(['status' => 200, 'message' => 'Webhook Received | entry already exists',]);
                            // return 'already exists';
                        }
                        
                        $createPayment = new Payment();
                        $createPayment->user_id         = $user_id ?? $sub->user_id;
                        $createPayment->transaction_id  = $data->subscription;
                        $createPayment->plan_id         = $planBox->id;
                        $createPayment->customer_id     = $customer ?? 1;
                        $createPayment->amount          = $total;
                        $createPayment->currency        = strtoupper($currency);
                        $createPayment->payment_status  = 1;
                        $createPayment->start_time      = Carbon::createFromTimestamp($started)->toDateTimeString();
                        $createPayment->end_time        = Carbon::createFromTimestamp($ended)->toDateTimeString();
                        $createPayment->save();
                    }
                    // end vars
                    Storage::disk('local')->put('started' . $time . '.json', $started);
                    Storage::disk('local')->put('payment' . $time . '.json', $payment);
                    Storage::disk('local')->put('event' . $time . '.json', $event);
                    return response()->json(['status' => 200, 'message' => 'Webhook Received',]);
                    // Storage::disk('local')->put('started_timestamp'.$time.'.txt', Carbon::createFromTimestamp($started)->toDateTimeString());
                    // Storage::disk('local')->put('invoice'.$time.'.txt', $payment);
                    // Storage::disk('local')->put('data'.$time.'.txt', $data);
                    // $period_start = $payment->payment_settings;
                    break;
                    case 'invoice.updated':
                        $payment  = $event->data->object;
                        $data     = $payment->lines->data[0];
                        $ispaid   = $payment->paid;
                        if ($ispaid && $data->type = 'subscription') { 
                        // vars
                            // print_r("invoice updte");
                            $billing_reason = $payment->billing_reason;
                            $currency       = $payment->currency;
                            $customer       = $payment->customer;
                            $status         = $payment->status;
                            $total          = $payment->total;
                            $periodBox      = $data->period;
                            $planBox        = $data->plan;
                            $priceBox       = $data->price;
                            $user_id        = $data->metadata->user_id;
                            $promo_id       = $data->metadata->promo_id;
                            $sub      = DB::table('payment')->where('transaction_id',$data->subscription)->first();
                            $started  = $periodBox->start;
                            $ended    = $periodBox->end;

                            $started_ok        = Carbon::createFromTimestamp($started)->toDateTimeString();
                            $ended_ok          = Carbon::createFromTimestamp($ended)->toDateTimeString();
                            $transaction_id    = $data->subscription;
                            $if_already_exist = DB::table('payment')->where('transaction_id', $transaction_id)->where('start_time', $started_ok)->where('end_time', $ended_ok)->where('active', 1)->first();
                            if($if_already_exist){
                                return response()->json(['status' => 200, 'message' => 'Webhook Received | entry already exists',]);
                                // return 'already exists';
                            }

                            $createPayment = new Payment();
                            $createPayment->user_id         = $user_id ?? $sub->user_id;
                            $createPayment->transaction_id  = $data->subscription;
                            $createPayment->plan_id         = $planBox->id;
                            $createPayment->customer_id     = $customer ?? $sub->customer_id ?? 1;
                            $createPayment->amount          = $total;
                            $createPayment->currency        = strtoupper($currency);
                            $createPayment->payment_status  = 1;
                            $createPayment->start_time      = Carbon::createFromTimestamp($started)->toDateTimeString();
                            $createPayment->end_time        = Carbon::createFromTimestamp($ended)->toDateTimeString();
                            $createPayment->save();
                        }
                        // end vars
                        Storage::disk('local')->put('subscription_updated_event' . $time . '.json', $event);
                        // Storage::disk('local')->put('started_timestamp'.$time.'.txt', Carbon::createFromTimestamp($started)->toDateTimeString());
                        // Storage::disk('local')->put('invoice'.$time.'.txt', $payment);
                        // Storage::disk('local')->put('data'.$time.'.txt', $data);
                        // $period_start = $payment->payment_settings;
                        return response()->json(['status' => 200, 'message' => 'Webhook Received',]);
                        break;
                        case 'invoice.created':
                            $payment  = $event->data->object;
                            $data     = $payment->lines->data[0];
                            $ispaid   = $payment->paid;
                            if ($ispaid && $data->type = 'subscription') { 
                            // vars
                            // print_r("invoice create");

                                $billing_reason = $payment->billing_reason;
                                $currency       = $payment->currency;
                                $customer       = $payment->customer;
                                $status         = $payment->status;
                                $total          = $payment->total;
                                $periodBox      = $data->period;
                                $planBox        = $data->plan;
                                $priceBox       = $data->price;
                                $user_id        = $data->metadata->user_id;
                                $promo_id       = $data->metadata->promo_id;
                                $sub      = DB::table('payment')->where('transaction_id',$data->subscription)->first();
                                $started  = $periodBox->start;
                                $ended    = $periodBox->end;
    
                                $started_ok        = Carbon::createFromTimestamp($started)->toDateTimeString();
                                $ended_ok          = Carbon::createFromTimestamp($ended)->toDateTimeString();
                                $transaction_id    = $data->subscription;
                                $if_already_exist = DB::table('payment')->where('transaction_id', $transaction_id)->where('start_time', $started_ok)->where('end_time', $ended_ok)->where('active', 1)->first();
                                if($if_already_exist){
                                    return response()->json(['status' => 200, 'message' => 'Webhook Received | entry already exists',]);
                                    // return 'already exists';
                                }
    
                                $createPayment = new Payment();
                                $createPayment->user_id         = $user_id ?? $sub->user_id;
                                $createPayment->transaction_id  = $data->subscription;
                                $createPayment->plan_id         = $planBox->id;
                                $createPayment->customer_id     = $customer ?? $sub->customer_id ?? 1;
                                $createPayment->amount          = $total;
                                $createPayment->currency        = strtoupper($currency);
                                $createPayment->payment_status  = 1;
                                $createPayment->start_time      = Carbon::createFromTimestamp($started)->toDateTimeString();
                                $createPayment->end_time        = Carbon::createFromTimestamp($ended)->toDateTimeString();
                                $createPayment->save();
                            }
                            // end vars
                            Storage::disk('local')->put('subscription_updated_event' . $time . '.json', $event);
                            // Storage::disk('local')->put('started_timestamp'.$time.'.txt', Carbon::createFromTimestamp($started)->toDateTimeString());
                            // Storage::disk('local')->put('invoice'.$time.'.txt', $payment);
                            // Storage::disk('local')->put('data'.$time.'.txt', $data);
                            // $period_start = $payment->payment_settings;
                            return response()->json(['status' => 200, 'message' => 'Webhook Received',]);
                            break;
                // ... handle other event types customer.subscription.updated
                default:
                    // Unexpected event type
                    return response()->json(['status' => 200, 'message' => 'Webhook Received',]);
                    http_response_code(400);
                    exit();
            }

            // Storage::disk('local')->put('file'.$time.'.txt', $event);
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            echo '⚠️  Webhook error while parsing basic request.';
            Storage::disk('local')->put('file1.txt', 'error');
            http_response_code(400);
            exit();
        }
    }


    public function cancel_subscription(){
        $user = Auth::user();
        // dd($user);
        $currentTime = Carbon::now()->toDateTimeString();
        $last_payments = DB::table('payment')->where('user_id', $user->id)->where('payment_status', 1)->where('active', 1)->select('id', 'transaction_id', 'start_time', 'end_time')->get();
            // dd($stripePayments);
        
        
        $activePayments = collect();


        foreach($last_payments as $pay){
            if($pay->start_time < $currentTime and $pay->end_time > $currentTime){
                $activePayments->push($pay);
                // return $next($request);
            }
        }

        $stripePayments     = collect();

        foreach($activePayments as $activePay){
            
            $stripePayments->push($activePay);
            
        }


            // dd($stripePayments);
        
        /* Stripe */
        if($last_payments->count() && $stripePayments->count()){
            $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));
            $stripe_last_txt = $stripe->subscriptions->retrieve($stripePayments->last()->transaction_id);
            // dd($stripe_last_txt);
            if($stripe_last_txt->status == 'active'){
                $result = $stripe->subscriptions->cancel($stripePayments->last()->transaction_id);
            }
        }
        
        foreach($last_payments as $pp1){
            DB::table('payment')->where('id', $pp1->id)->update(array('payment_status' => 0));
        }
        // dd($activePayments);
        // $result = $api->subscription->cancel('sub_Gkr9VWarnega9Y');
        // dd("done");
        return ["status" => 1];
    }



}
