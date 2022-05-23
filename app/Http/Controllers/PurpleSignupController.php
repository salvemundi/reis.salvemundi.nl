<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Hier moet juiste model komen
use App\Models\Blog;
use App\Models\PurpleParticipants;
use Carbon\Carbon;

// This controller  is commonly referred to as blog / news controller. Previous PR #12 caused a naming nightmare. (May or may not have been me.)
class PurpleSignUpController extends Controller
{
    public function showPurplePage() {

        return view('purpleSignup');
    }

    public function purpleSignup(Request $request) {
        $request->validate([
            'studentNumber' => ['required', 'max:65']
        ]);
        if (PurpleParticipants::where('studentNumber', $request->input('studentNumber'))->count() > 0) {
            return back()->with('warning', 'Dit studentnummer bestaat al!');
        }

        $participant = new PurpleParticipants();
        $participant->studentNumber= $request->input('studentNumber');
        $participant->save();

        return view('purpleSignup');
     }



}
