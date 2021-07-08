<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;
use App\Enums\CovidProof;
use BenSampo\Enum\Rules\EnumValue;

class ParticipantController extends Controller
{
    public function getAllIntroParticipantsWithInformation(Request $request) {
        $participants = Participant::all();

        $selectedParticipant = null;
        if($request->userId) {
            $selectedParticipant = Participant::find($request->userId);
        }

        return view('participants', ['participants' => $participants, 'selectedParticipant' => $selectedParticipant]);
    }

    public function checkIn(Request $request) {
        $participant = Participant::find($request->userId);
        $participant->checkedIn = true;
        $participant->covidTest = CovidProof::coerce((int)$request->proof);
        $participant->save();
        return back();
    }

    public function checkOut(Request $request) {
        $participant = Participant::find($request->userId);
        $participant->checkedIn = false;
        $participant->covidTest = CovidProof::coerce("none");
        $participant->save();
        return back();
    }
}
