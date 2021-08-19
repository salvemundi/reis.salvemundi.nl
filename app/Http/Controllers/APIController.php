<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;

class APIController extends Controller
{
    public function GetParticipants()
    {
        $client = new \GuzzleHttp\Client([
            'verify' => false
        ]);
        $url = "https://localhost/api/participants";
        $res = $client->get($url);
        $content = json_decode($res->getBody()->getContents());
        //dd($content);
        foreach($content as $item)
        {
            echo($item['firstName']);
        }
    }
}
