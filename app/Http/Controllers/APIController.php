<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    public function GetParticipants()
    {
        $client = new \GuzzleHttp\Client([
            'verify' => false
        ]);
        $url = "http://localhost/api/participants";
        $request = $client->get($url);
        dd($request->getBody());
    }
}
