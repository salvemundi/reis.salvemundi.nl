<?php

namespace App\Http\Controllers;

use App\Models\VerificationToken;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use App\Mail\emailVerificationResponse;
use Carbon\Carbon;
use App\Models\ConfirmationToken;
use App\Models\Setting;
use App\Mail\emailConfirmationSignup;

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

            if(Setting::where('name','AutoSendPaymentEmailDate')->first()->value <= $today) {
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

    public function getVerifiedParticipants(): Collection
    {
        $userArr = [];
        $allVerifiedTokens = VerificationToken::where('verified', true)->get();

        foreach($allVerifiedTokens as $token) {
            array_push($userArr, $token->participant);
        }
        return collect($userArr);
    }

    public function getNonVerifiedParticipants(): Collection
    {
        $userArr = [];
        $allVerifiedTokens = VerificationToken::where('verified', false)->get();

        foreach($allVerifiedTokens as $token) {
            array_push($userArr, $token->participant);
        }

        return collect($userArr);
    }

    public function createVerifyToken(Participant $participant): VerficitationToken {
        $newVerificationToken = new VerificationToken();
        $newVerificationToken->participant()->associate($participant);
        $newVerificationToken->save();

        return $newVerificationToken;
    }

}
