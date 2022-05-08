<?php

namespace App\Http\Controllers;

use App\Model\Plans;
use App\Model\countries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CountryPlanController extends Controller
{

    /*protected $allCurrency;
    public function __construct() {
        $file = Storage::disk('local')->get('currency-code.json');
        $currency = json_decode($file, true);
        $this->allCurrency = $currency;
    }*/

    public function index()
    {
        $countries = countries::where("active",1)->get();
        foreach ($countries as $value) {
            dd($value->plans);
            
        }
        return view('admin.country.index')->with(['countries' => $countries/*,"currency" => $this->allCurrency*/]);
    }
    public function create(Request $request){
        $country = null;
        if($request->has("country")){
            $country= countries::where('id',$request->country)->with("plans")->first();
        }
        return view('admin.country.create',[/*"allCurrency" => $this->allCurrency,*/"country" => $country]);
    }

    public function edit($id){
        $country = countries::findOrFail($id);
        $getPlan=Plans::where("country_id",$id)->first();
        if(!$getPlan){
            return redirect()->route("cp.create",["country" => $id]);
        }
        $country= countries::where('id', $id)->with("plans")->first();
        return view('admin.country.create',["country" => $country, /*"allCurrency" => $this->allCurrency*/]);
    }

    public function save(Request $request){

        $plan_name   = $request->plan_name;
        $plan_amount = $request->plan_amount;
        $plan_days = $request->days;

        if($request->has("country_id") && $request->country_id!=null){

            $country = countries::find($request->country_id);
            $country->name        = $request->name;
            $country->active      = 1;
            $country->razorpay    = $request->razorpay ?? 0;
            $country->stripe      = $request->stripe ?? 0;
            $country->phonepe     = $request->phonepe ?? 0;
            $country->paytm       = $request->paytm ?? 0;
            $country->googlepay   = $request->googlepay ?? 0;
            $country->paypal      = $request->paypal ?? 0;
            $country->twocheckout = $request->twocheckout ?? 0;
            $country->save();

            $plans=Plans::where("country_id",$request->country_id)->get();
            if($plans->count() > 0){
                foreach ($plan_name as  $key => $value) {
                    $plan=Plans::find($request->plan_id[$key]);
                    $plan->plan_name = $plan_name[$key];
                    $plan->days = $plan_days[$key];
                    $plan->amount = $plan_amount[$key] * 100;
                    $plan->active = 1;
                    $plan->country_id = $request->country_id;
                    $plan->currency = $request->currency;
                    $plan->save();
                }
                //already have plans and on update
            }else{
                //don't have plan ,create them
                foreach($plan_name as  $key => $value){
                    $plan = new Plans();
                    $plan->plan_name = $plan_name[$key];
                    $plan->days = $plan_days[$key];
                    $plan->amount = $plan_amount[$key] * 100;
                    $plan->active = 1;
                    $plan->country_id = $request->country_id;
                    $plan->currency = $request->currency;
                    $plan->save();
                }
            }
        }else{

            $nameAlreadyExists=countries::where("name",$request->name)->exists();
            if($nameAlreadyExists){
                return redirect()->back()->withErrors(["name" => "Country with this name is already available"])->withInput();
            }

            $country = new countries();
            $country->name        = $request->name;
            $country->active      = 1;
            $country->razorpay    = $request->razorpay ?? 0;
            $country->stripe      = $request->stripe ?? 0;
            $country->phonepe     = $request->phonepe ?? 0;
            $country->paytm       = $request->paytm ?? 0;
            $country->googlepay   = $request->googlepay ?? 0;
            $country->paypal      = $request->paypal ?? 0;
            $country->twocheckout = $request->twocheckout ?? 0;
            $country->save();

            foreach ($plan_name as  $key => $value) {
                $plan = new Plans();
                $plan->plan_name = $plan_name[$key];
                $plan->days = $plan_days[$key];
                $plan->amount = $plan_amount[$key] * 100;
                $plan->active = 1;
                $plan->country_id = $country->id;
                $plan->currency = $request->currency;
                $plan->save();
            }

        }
        return redirect('dashboard/countries')->with('message', 'Sucessfully country added');
    }
}
