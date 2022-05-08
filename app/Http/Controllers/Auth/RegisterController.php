<?php

namespace App\Http\Controllers\Auth;

use App\Model\SiteMeta;
use App\Model\Users;
use App\User;
// use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Automattic\WooCommerce\HttpClient\HttpClientException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Contracts\Auth\Authenticatable;
// use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
// use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    // protected $user;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

   /* public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }*/

    protected $redirectTo = '/';

    protected function redirectTo()
    {
        //return '/email/verify';
        //session()->has('play')
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $customMessages = [
            'email.disposable_pizza' => 'This email is not valid.'
        ];



        if (!empty(isProd())){
            return Validator::make($data, [
                'name' => 'required|string|max:255',
                'nickname' => 'required|string|min:5|max:12|unique:users,nickname',
                'email' => 'required|string|email|max:255|unique:users|disposable_pizza',
                'password' => 'required|string|min:6|confirmed',
                #   'g-recaptcha-response' => 'required|recaptcha',
            ],$customMessages);
        }
        else{
            return Validator::make($data, [
                'name' => 'required|string|max:255',
                'nickname' => 'required|string|min:5|max:12|unique:users,nickname',
                'email' => 'required|string|email|max:255|unique:users|disposable_pizza',
                'password' => 'required|string|min:6|confirmed',
            ],$customMessages);
        }


    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // dd($data);
        
        $username = strtolower(preg_replace('/\s+/', '', $data['nickname']));

        /*$mailchimp = [
            "email" => $data['email'],
            "nickname" => $username,
            "name" => $data['name'],
            "platform" => "WEB",
            "source" => "EMAIL",
            "dor" => date("Y-m-d"),
        ];

        addRegistrationSubscriber($mailchimp);*/

        /*$w_data = [
            "email" => $data['email'],
            "first_name" => $data['name'],
            "last_name" => "",
            "username" => $username,
            "password" => Hash::make($data['password']),
            "billing" => [
                "first_name" => $data['nickname'],
                "last_name" => "",
                "company" => "",
                "address_1" => "",
                "address_2" => "",
                "city" => "",
                "state" => "",
                "postcode" => "",
                "country" => "",
                "email" => $data['email'],
                "phone" => ""
            ],
            "shipping" => [
                "first_name" => $username,
                "last_name" => "",
                "company" => "",
                "address_1" => "",
                "address_2" => "",
                "city" => "",
                "state" => "",
                "postcode" => "",
                "country" => ""
            ]
        ];*/




        /*$referredUser = getTableData(User::class,[
            "select" => [
                "id"
            ],
            "where" => [
                "app_id" => $data["ref_id"]
            ],
            "single" => 1
        ]);*/



        try{

            if (!empty(isProd())){

                $woocommerce = oauth();
                $jsondata = $woocommerce->post('customers/', $w_data);
                return User::create([
                    'name' => $data['name'],
                    'nickname' => $username,
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'type' => returnConfig("user"),
                    'w_id' => $jsondata->id,
                    'active' => isActive(),
                    'app_id' => getToken(8),
                    'referred_by' => $referredUser['id'] ?? 0
                ]);
            }
            else{
                /*print_r($username);
                die;*/
                /*$user =  User::insert([
                    'name' => $data['name'],
                    'nickname' => $username,
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'type' => returnConfig("user"),
                    'w_id' => 0,
                    'active' => isActive(),
                    'app_id' => getToken(8),
                    'referred_by' => $referredUser['id'] ?? 0
                ]);*/


                $user = new User;
                $user->name = $data['name'];
                $user->nickname = $username;
                $user->email = $data['email'];
                $user->password = Hash::make($data['password']);
                $user->type = returnConfig("user");
                $user->w_id = 0;
                $user->active = isActive();
                $user->app_id = getToken(8);
                $user->referred_by = $referredUser['id'] ?? 0;
                $user->save();
                

                // Auth::login($user->id);
                    
                // Auth::loginUsingId($user->id);
                
                // dd("hello");
                /*event(new Registered($user));

                Auth::login($user);*/

                 // return ["status" => 1];
                // dd("fdvdf");
                // $userId = $user->id;


                /*$user_data = [
                    "email" => $user->email,
                    "password" => $user->password,
                ];

                if (Auth::attempt($user_data)) {

                    $userId = Auth::User()->id;
                    dd($userId);

                    return ["status" => 1];
                }*/ 
                // return $user->id ;
                return response()->json(["status" => 1]);


            }




        }
        catch (HttpClientException $e)
        {
            $this->validate(request(), [
                'email' => [function ($attribute, $value, $fail) {
                        $fail('Email is already in use!');
                }]
            ]);


        }

    }

    protected function registered(Request $request, $user)
    {
        dd("hello");
        return response()->json(["status" => 1]);

    }

    /* public function usernamecheck(Request $request){
         $data = Input::get();
         print_r($data);die;

         return Validator::make($data, [
             'nickname' => 'required|string|min:5|max:12|unique:users,nickname',

         ]);
         print_r("dfd");die;

     }*/


}
