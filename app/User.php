<?php

namespace App;

use App\Model\InfluencersCommunities;
use App\Model\MasterRewards;
use App\Model\SiteMeta;
use App\Model\Users;
use App\Notifications\VerifyMailNotification;
use App\Notifications\WelcomeMailNotification;
use App\Notifications\ReferredUserUpdate;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Carbon\Carbon;
use App\Model\UserRewards;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','nickname', 'password','type','active','w_id','created_by','email_verified_at','app_id','referred_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyMailNotification());
    }*/
    public function verify(Request $request)
    {
      //  print_r("aaaa");die;
    }
    public function sendEmailVerificationNotification()
    {
        $this->notify(new Notifications\CustomVerifyEmail);
    }

    public function markEmailAsVerified()
    {

        session()->put('verified_email', 1);

        $Userdata = Auth()->user();

        $referredID = $Userdata->referred_by;
        $influencer = getIsInfluencer($referredID);





        $authID = auth()->user()->id;


        $wherIn = [returnConfig("referred_token"), returnConfig("first_post_tokens")];
        $TokenValue = getTableData(MasterRewards::class, [
            "select" => [
                "name",
                "tokens",
                "id"
            ],
            "whereIn" => ["id" => $wherIn],
        ]);

        $earnTokenValue = getTableData(MasterRewards::class, [
            "select" => [
                "name",
                "tokens",
                "id"
            ],
            "where" => [
                "active" => 1,
                "type" => 1,
                "id" => returnConfig('referred_token'),
            ],
            "single" => 1
        ]);

        if (!empty($influencer->activate)){
            updateData(users::class,[
                "update" => [
                    //"w_id" => $jsondata->id
                    "community_id" => $influencer->community_id
                ],
                "where" => [
                    "id" => $authID
                ],
            ]);
        }

        if (!empty($referredID) && empty($influencer->reward)) {
            session()->put('joinedviarefferal', 1);
            $extra = [
                "data" => [
                    'user_id' => $referredID,
                    'reward_id' => returnConfig('referred_token'),
                    'tokens' => $earnTokenValue['tokens'],
                    'active' => 1,
                    'created_at' => Carbon::now(),
                    'link_id' => $authID
                ]
            ];

            insertData(UserRewards::class, $extra);
            $toUser = User::find($referredID);


            $emaildata = [
                "firstToken" =>  $TokenValue[0]->tokens,
                "firstPostToken" =>  $TokenValue[1]->tokens,
            ];

            $toUser->notify(new ReferredUserUpdate($emaildata));

        }

        $this->notify(new WelcomeMailNotification());

        return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
        ])->save();


    }



}
