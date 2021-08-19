<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    public function GetParticipants()
    {
        $client = new \GuzzleHttp\Client();
        $url = "https://salvemundi.nl/api/participants";
        $myBody['name'] = "Demo";
        $request = $client->put($url,  ['body'=>$myBody]);
        $response = $request->send();
        dd($response);
    }
}
