<?php

namespace App\Http\Controllers;

use App\Models\VerificationToken;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify(Request $request)
    {
        $token = $request->token;
        $verificationToken = VerificationToken::find($token);

        if ($token && $verificationToken !== null) {
            $verificationToken->verified = true;
            $verificationToken->save();
            return view('verifyResponse', ['Response' => true]);
        }

        return view('verifyResponse', ['Response' => false]);
    }
}
