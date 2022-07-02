<?php

namespace App\Http\Controllers;

use App\Models\VerificationToken;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\emailVerificationResponse;
use Carbon\Carbon;
use App\Models\ConfirmationToken;

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

            $participant = $verificationToken->participant()->first();

            Mail::to($participant->email)
                ->send(new emailVerificationResponse($participant));

            $today = Carbon::now()->format('Y-m-d'); //yyyy-mm-dd

            if(Setting::where('name','AutoSendPaymentEmailDate')->first()->value->lte($today)) {
                $newConfirmationToken = new ConfirmationToken();
                $newConfirmationToken->participant()->associate($participant);
                $newConfirmationToken->save();

                Mail::to($participant->email)
                ->send(new emailConfirmationSignup($participant, $newConfirmationToken));
            }

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
