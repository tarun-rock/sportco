<?php

namespace App\Http\Controllers;

use App\Model\FootballMatches;
use App\Http\Controllers\CoreController as Core;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
//use Morrislaptop\Firestore\Firestore;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Print_;
//use Google\Cloud\Firestore\FirestoreClient;
use Google\Cloud\Storage\StorageClient;

class WidgetController extends Controller
{
    //
    //private $firestore;

    /**
     * @param //Firestore $firestore
     *
     * @return void
     */
    /*public function __construct(Firestore $firestore)
    {
        $this->firestore = $firestore;
        $this->firestore->collection("PathToCollection");
    }*/

    public function liveScore(Request $request, $conpetitonID = 5)
    {

        //Cache::flush();
        $ttl = config('cache.full_lifetime');
        $competitionarray = Cache::remember('competitionslist', $ttl, function () {
            $data = Core::footBallCompetitionsList();
            $response = $data['response']['items'];
            return $response;

        });

        $liveMatch = Core::footBallMatchesLive();
        $livematcharray = $liveMatch['response']['items'];
        $matchLive = collect($livematcharray);
        $matchLivearray = [];
        if (!empty($matchLive->count())){
            $matchLivearray = $matchLive->map(function ($item, $key) {
                return $item['competition']['cid'];
            })->unique()->toArray();
        }


        return view("front.liveScore")->with([
            'data' => $competitionarray,
             'livematch' => array_values($matchLivearray)
        ]);

    }

    public function matchInfo(Request $request)
    {
        if ($request->isMethod("post")) {
            $data = input::get();
            $matchID = $data['matchId'];
            $matchesarray = Core::matchInfo($matchID);

            $data = $matchesarray['response']['items'];
            return $data;


        }

    }

    /*public function footBallMatchesList(Request $request)
    {
         //Cache::flush();

        $ttl = config('cache.full_lifetime');
        if ($request->isMethod("post")) {
            $data = input::get();
            $conpetitonID = $data['compititionId'];
            $matchesdata = Cache::remember("footBallMatchesList$conpetitonID", $ttl, function () use ($conpetitonID) {
                $matchesarray = Core::footBallMatchesList($conpetitonID);
                $data = $matchesarray['response']['items'];
                return $data;
            });


            $matchesPointTableArray = Cache::remember("matchesPointTable$conpetitonID", $ttl, function () use ($conpetitonID) {
                $matchesarray = Core::matchesPointTable($conpetitonID);
                $data = $matchesarray['response']['items'];
                return $data;
            });
            //print_r($matchesPointTableArray);die;

            $matchesPointTable = $matchesPointTableArray[0]['point_table'];


            $filteredArray = array();
            $matchinfo = $livematchinfo=[];
            /*$matchLive = [];
            $matchLive['mid'] = 303036;*/
         /*   $matchLive = collect($matchesdata)
                ->where('status', '=', 3);

            if (count($matchLive) > 0){

                $i = 1;
                foreach ($matchLive as $key => $item){
                    $dbliveMatch = getTableData(FootballMatches::class, [
                        "select" => [
                            "competition_id",
                            "match_id",
                        ],
                        "where" => [
                            "status" => 3,
                            "match_id" => $item['mid']
                        ],
                        "single" => 1
                    ]);


                    if(empty($dbliveMatch)){
                        $update = [
                            "competition_id" => $conpetitonID,
                            "match_id"=> $item['mid'],
                            "status"=>3, // live match
                            "active"=>1, // live match
                            "created_at"=>Carbon::now(),
                        ];

                        FootballMatches::insert($update);

                        $firestore = new FirestoreClient([
                            'projectId' => config("services.liveScore.projectId"),
                        ]);
                        $dataArray = Core::footBallMatchesInfo($item['mid']);
                        $collection = $firestore->collection('footBallLiveScores');
                        $document = $collection->document('matchID'.$item['mid']);
                        $document->set($dataArray);
                        $livematchinfo = [
                            "matchId"=>$item['mid'],
                            "competitionID"=>$conpetitonID
                        ];


                    }else{
                        $livematchinfo = [
                            "matchId"=>$item['mid'],
                            "competitionID"=>$conpetitonID
                        ];

                    }
                    if ($i++ == 10) break;

                }

            }else{



                $matchCompleted = collect($matchesdata)
                    ->where('status', '=', 2)
                    ->where('status', '!=', 3)
                    ->first();

                if (!empty($matchCompleted)) {
                    $matchID = $matchCompleted['mid'];
                    $matcheinfosarray = Cache::remember("matchInfo$matchID", $ttl, function () use ($matchID) {
                        $matchesarray = Core::matchInfo($matchID);
                        $data = $matchesarray['response']['items'];
                        return $data;
                    });


                    $triviaarray = $matcheinfosarray['commentary'] ?? "";
                    $triviacontent = "";
                    if (!empty($triviaarray)) {
                        $trivialastchild = sizeof($triviaarray) - 1;
                        $triviacontent = $matcheinfosarray['commentary'][$trivialastchild];
                    }


                    $venue = $matcheinfosarray['match_info']['0']['venue'];
                    $status = $matcheinfosarray['match_info']['0']['status'];
                    $away_goal = $matcheinfosarray['match_info']['0']['result']['away'];
                    $home_goal = $matcheinfosarray['match_info']['0']['result']['home'];
                    $home_team_name = $matcheinfosarray['match_info']['0']['teams']['home']['tname'];
                    $away_team_name = $matcheinfosarray['match_info']['0']['teams']['away']['tname'];


                    $matchinfo = [
                        "trivia" => $triviacontent,
                        "venue" => $venue,
                        "status" => $status,
                        "away_goal" => $away_goal,
                        "home_goal" => $home_goal,
                        "home_team_name" => $home_team_name,
                        "away_team_name" => $away_team_name

                    ];
                }
            }


            foreach ($matchesdata as $key => $match) {
                $filteredArray[$key] = [
                    'mid' => $match['mid'],
                    'result' => $match['result'],
                    'teams' => $match['teams'],
                    'status' => $match['status'],
                    'datestart' => $match['datestart'],
                    'competitionid' =>$match['competition']['cid'],
                ];
            }

        }


        return [
            "matchfixture" => $filteredArray,
            "matchespoint" => $matchesPointTable,
            "matchinfo" => $matchinfo,
            "livematchinfo"=>$livematchinfo
        ];

    }
*/

    /*public function liveScoreApiCallAction(Firestore $firestore)
    {
        $liveMatchArray = getTableData(FootballMatches::class, [
            "select" => [
                "competition_id",
                "match_id",
            ],
            "where" => [
                "status" => 3
            ]
        ]);
        foreach ($liveMatchArray as $key => $matchdata){
            //print_r($matchdata['match_id']);die;
            $machesId = $matchdata['match_id'];

            $dataArray = Core::footBallMatchesInfo($machesId);

            $liveMatch = $dataArray['response']['items']['match_info'][0]['status'];
            if ($liveMatch == 3){
                $collection = $firestore->collection('footBallLiveScores');
                $user = $collection->document('matchID'.$machesId);
                // Save a document
                $user->set($dataArray);
            }else{
                updateData(FootballMatches::class, [
                    "update" => [
                        "status" => 2
                    ],
                    "where" => [
                        "match_id" => $machesId
                    ],
                ]);
            }


        }


        $machesId = '36360';
        /*$currentMacheName = Football_maches_sections::select('match_id')->first();
        if (!empty($currentMacheName)) {
            $machesId = $currentMacheName->match_id;
        }*/
       /* $init = 0;
        //foreach ($init > array.length, $init++){

    //}




    }*/


}
