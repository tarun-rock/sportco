<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\CoreController as Core;

class CoreController extends Controller
{
    //

    public static function validationMsg($validator)
    {
        $error = "";
        foreach (array_values($validator->messages()->toArray()) as $msg) {
            $error = $error . implode(' ', $msg);
        }
        return $error;
    }

    /*
     * @function footBallOverAllPercentageCalculation
     *
     * footBall Over All Percentage Calculation
     *
     * @param
     *
     *
     * @return
     * value
     *
    
    
     */

    public static function footBallOverAllPercentageCalculation($name, $home_value, $away_value)
    {
        if ($home_value == 0 && $away_value == 0) {
            $valueData['name'] = $name;
            $valueData['homePercentage'] = 50;
            $valueData['awayPercentage'] = 50;
            $valueData['homeOrginal'] = $home_value;
            $valueData['awayOrginal'] = $away_value;
        } else {
            $total = $home_value + $away_value;
            $valueData['name'] = $name;
            $valueData['homePercentage'] = round(($home_value / $total) * 100);
            $valueData['awayPercentage'] = round(($away_value / $total) * 100);
            $valueData['homeOrginal'] = $home_value;
            $valueData['awayOrginal'] = $away_value;
        }
        return $valueData;
    }

    /*
     * @function footBallMatchesInfo
     *
     * footBall Matches Info
     *
     * @param
     *
     *
     * @return
     * value
     *
    
    
     */

    public static function footBallCompetitionsList()
    {


        $dataArray = [];
        if (Cache::has('accessToken')) {
            $token = Cache::get('accessToken');
        } else {
            CoreController::getTokenEntitysport();
            $token = Cache::get('accessToken');

        }

        $dataArray['response']['items'] = [];
        $url = 'https://rest.entitysport.com/soccer/season/19-20/competitions?token=' . $token;
        $curlData = CoreController::apiCurlHit($url);


        if ($curlData['info']['http_code'] == 200) {
            return json_decode($curlData['dataArray'], true);
        } else {
            return $dataArray;
        }

    }


    public static function matchInfo($matchID)
    {

        if (Cache::has('accessToken')) {
            $token = Cache::get('accessToken');
        } else {
            CoreController::getTokenEntitysport();
            $token = Cache::get('accessToken');

        }
        $dataArray = [];
        $dataArray['response']['items'] = [];
        $url = 'https://rest.entitysport.com/soccer/matches/' . $matchID . '/info?token=' . $token;
        $curlData = CoreController::apiCurlHit($url);
        if ($curlData['info']['http_code'] == 200) {
            return json_decode($curlData['dataArray'], true);
        } else {
            CoreController::getTokenEntitysport();
            return $dataArray;
        }


    }

    public static function footBallMatchesList($compitionid)
    {

        $dataArray = [];
        $dataArray['response']['items'] = [];
        if (Cache::has('accessToken')) {
            $token = Cache::get('accessToken');
        } else {
            CoreController::getTokenEntitysport();
            $token = Cache::get('accessToken');

        }

        $url = 'https://rest.entitysport.com/soccer/competition/' . $compitionid . '/matches?token=' . $token;
        $curlData = CoreController::apiCurlHit($url);

        if ($curlData['info']['http_code'] == 200) {
            return json_decode($curlData['dataArray'], true);
        } else {
            CoreController::getTokenEntitysport();
            return $dataArray;
        }

    }

    public static function matchesPointTable($compitionid)
    {

        $dataArray = [];
        $dataArray['response']['items'] = [];
        if (Cache::has('accessToken')) {
            $token = Cache::get('accessToken');
        } else {
            CoreController::getTokenEntitysport();
            $token = Cache::get('accessToken');

        }
        $url = 'https://rest.entitysport.com/soccer/competition/' . $compitionid . '/?token=' . $token;
        $curlData = CoreController::apiCurlHit($url);


        if ($curlData['info']['http_code'] == 200) {
            return json_decode($curlData['dataArray'], true);
        } else {
            CoreController::getTokenEntitysport();
            return $dataArray;
        }

    }

    public static function footBallMatchesListBasedOnCompetitions($competition_id)
    {
        $dataArray = [];
        if (Cache::has('accessToken')) {
            $dataArray['response']['items'] = [];
            $token = Cache::get('accessToken');
            $url = 'https://rest.entitysport.com/soccer/competition/' . $competition_id . '/matches?token=' . $token;
            $curlData = CoreController::apiCurlHit($url);
            if ($curlData['info']['http_code'] == 200) {
                return json_decode($curlData['dataArray'], true);
            } else {
                CoreController::getTokenEntitysport();
                return $dataArray;
            }
        } else {
            CoreController::getTokenEntitysport();
            return $dataArray;
        }
    }


    public static function footBallMatchesLive()
    {

        if (Cache::has('accessToken')) {
            $token = Cache::get('accessToken');
        } else {
            CoreController::getTokenEntitysport();
            $token = Cache::get('accessToken');

        }
        $dataArray = [];
        $dataArray['response']['items'] = [];
        
        $url = 'https://rest.entitysport.com/soccer/matches?token='.$token.'&status=3';
        $curlData = CoreController::apiCurlHit($url);

        if ($curlData['info']['http_code'] == 200) {
            $dataArray = json_decode($curlData['dataArray'], true);
            return $dataArray;
        } else {
            CoreController::getTokenEntitysport();
            return ['status' => 'unauthorized'];
        }

    }

    /*
     * @function footBallMatchesStatsv2
     *
     * footBall Matches Stats v2
     *
     * @param
     *
     *
     * @return
     * value
     *
    
    
     */

    public static function footBallMatchesStatsv2($machesId)
    {
        if (Cache::has('accessToken')) {
            $token = Cache::get('accessToken');
            $url = 'https://rest.entitysport.com/soccer/matches/' . $machesId . '/statsv2?token=' . $token;
            $curlData = CoreController::apiCurlHit($url);
            if ($curlData['info']['http_code'] == 200) {
                $dataArray = json_decode($curlData['dataArray'], true);
                return $dataArray;
            } else {
                CoreController::getTokenEntitysport();
                return ['status' => 'unauthorized'];
            }
        } else {
            CoreController::getTokenEntitysport();
            return ['status' => 'unauthorized'];
        }
    }

    /*
     * @function footBallMatchesInfo
     *
     * footBall Matches Info
     *
     * @param
     *
     *
     * @return
     * value
     *
    
    
     */

    public static function footBallMatchesInfo($machesId)
    {

        if (Cache::has('accessToken')) {
            $token = Cache::get('accessToken');
        } else {
            CoreController::getTokenEntitysport();
            $token = Cache::get('accessToken');

        }
        $url = 'https://rest.entitysport.com/soccer/matches/' . $machesId . '/info?token=' . $token;
        $curlData = CoreController::apiCurlHit($url);
        if ($curlData['info']['http_code'] == 200) {
            $dataArray = json_decode($curlData['dataArray'], true);
            return $dataArray;
        } else {
            Core::getTokenEntitysport();
            return ['status' => 'unauthorized'];
        }


    }

    /*
     * @function getTokenEntitysport
     *
     * get Token Entitysport
     *
     * @param
     *
     *
     * @return
     * token
     *
    
    
     */

    public static function getTokenEntitysport()
    {

        $accessKey = env("ENTITY_ACCESS_KEY");
        $secretKey = env("ENTITY_SECRET_KEY");
        $url = 'https://rest.entitysport.com/v2/auth?access_key=' . $accessKey . '&secret_key=' . $secretKey;
        $curlData = CoreController::apiCurlHit($url);
        Cache::put('accessToken', env("ENTITY_TOKEN"), 4320);
        if ($curlData['info']['http_code'] == 200) {
            // 3 day for access Token
            Cache::put('accessToken', env("ENTITY_TOKEN"), 4320);
        }
    }

    public static function apiCurlHit($url, $extra = [])
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $dataArray = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        return ['dataArray' => $dataArray, 'info' => $info];
    }
}
