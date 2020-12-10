<?php

namespace App\Http\Controllers;

use App\Models\ThirdAuthentication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ThirdAuthenticationController extends Controller
{

    public function getAuthenticationByClient($client)
    {
        $client = ThirdAuthentication::where("client", $client)->first();
        return $client;
    }


    public function requestAuthenticationTokenToGatorade()
    {

        $clientId = "";
        $clientSecret = "";
        $appId = "";
        /*  $response = Http::post(
            'https://jsonplaceholder.typicode.com/token',
            [
                'clientId' => $clientId,
                'clientSecret' => $clientSecret,
                'appId' => $appId
            ]
        );
 */
        $response = ["token" => "", "expiration_date" => ""];

        // look for third authentication by client
        $thirdAuthenticationFound =
            ThirdAuthentication::where("client", "gatorade")->first();

        if ($thirdAuthenticationFound) {
            //update the register
            $thirdAuthenticationFound->token = $response['token'];
            $thirdAuthenticationFound->expiration_date = $response['expiration_date'];
            $thirdAuthenticationFound->save();
        } else {
            //create a new register
            $authenticationModel = new ThirdAuthentication();
            $authenticationModel->client = "gatorade";
            $authenticationModel->token = $response['token'];
            $authenticationModel->expiration_date = $response['expiration_date'];
            $authenticationModel->save();
        }
    }


    /*    public function manageAuthenticationToken()
    {
        //
        $response = Http::post('https://jsonplaceholder.typicode.com/users');
        return array("token" => "12341231", "expiration_date" => "10000000");
    } */
}