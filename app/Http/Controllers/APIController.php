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
        $arr = [];
        foreach($content as $item)
        {
            // Try to find the participant first, then update their records instead of creating a new object
            $tryToFind = Participant::where('samuId',$item->id)->first();
            if($tryToFind)
            {
                $tryToFind->firstName = $item->firstName;
                $tryToFind->insertion = $item->insertion;
                $tryToFind->lastName = $item->lastName;
                $tryToFind->birthday = strtotime($item->birthday);
                $tryToFind->email = $item->email;
                $tryToFind->phoneNumber = $item->phoneNumber;
                $tryToFind->firstNameParent = $item->firstNameParent;
                $tryToFind->lastNameParent = $item->lastNameParent;
                $tryToFind->addressParent = $item->addressParent;
                $tryToFind->medicalIssues = $item->medicalIssues;
                $tryToFind->specials = $item->specials;
                $tryToFind->phoneNumberParent = $item->phoneNumberParent;
                $tryToFind->studentYear = $item->studentYear;
                array_push($arr,$tryToFind);
                //$tryToFind->save();
            }

            $newParticipant = new Participant();
            $newParticipant->firstName = $item->firstName;
            $newParticipant->insertion = $item->insertion;
            $newParticipant->lastName = $item->lastName;
            $newParticipant->birthday = strtotime($item->birthday);
            $newParticipant->email = $item->email;
            $newParticipant->phoneNumber = $item->phoneNumber;
            $newParticipant->firstNameParent = $item->firstNameParent;
            $newParticipant->lastNameParent = $item->lastNameParent;
            $newParticipant->addressParent = $item->addressParent;
            $newParticipant->medicalIssues = $item->medicalIssues;
            $newParticipant->specials = $item->specials;
            $newParticipant->phoneNumberParent = $item->phoneNumberParent;
            $newParticipant->studentYear = $item->studentYear;
            $newParticipant->samuId = $item->id;
            array_push($arr,$newParticipant);
            //$newParticipant->save();
        }
        dd($arr);
    }
}
