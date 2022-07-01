<?php

namespace App\Http\Controllers;

use App\Models\VerificationToken;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\emailVerificationResponse;

class VerificationController extends Controller
{
    public function verify(Request $request) {
        $token = $request->token;
        $verificationToken = VerificationToken::find($token);

        if ($token && $verificationToken !== null) {
            if($verificationToken->verified) {
                return view('verifyResponse', ['Response' => false]);
            }

            $verificationToken->verified = true;
            $verificationToken->save();

            Mail::to($verificationToken->participant()->first()->email)
                ->send(new emailVerificationResponse($verificationToken->participant()->first()));

            return view('verifyResponse', ['Response' => true]);
        }

        return view('verifyResponse', ['Response' => false]);
    }

    public function getVerifiedParticipants() {
        $userArr = [];
        $allVerifiedTokens = VerificationToken::where('verified', true)->get();

        foreach($allVerifiedTokens as $token) {
            array_push($userArr, $token->participant);
        }

        return $userArr;
    }

    public function getNonVerifiedParticipants(): array
    {
        $userArr = [];
        $allVerifiedTokens = VerificationToken::where('verified', false)->get();

        foreach($allVerifiedTokens as $token) {
            array_push($userArr, $token->participant);
        }

        return $userArr;
    }

}
