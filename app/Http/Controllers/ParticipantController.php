<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;
use App\Enums\CovidProof;
use BenSampo\Enum\Rules\EnumValue;
use Carbon\Carbon;

class ParticipantController extends Controller
{
    public function getAllIntroParticipantsWithInformation(Request $request) {
        $participants = Participant::all();

        if($request->userId) {
            $selectedParticipant = Participant::find($request->userId);
            $age = Carbon::parse($selectedParticipant->birthday)->diff(\Carbon\Carbon::now())->format('%y years');
            return view('participants', ['participants' => $participants, 'selectedParticipant' => $selectedParticipant, 'age' => $age]);
        }

        return view('participants', ['participants' => $participants]);
    }

    public function checkIn(Request $request) {
        $request->validate([
            'proof' => 'required',
        ]);
        if($request->input('proof') == 0){
            return back()->with('msg','Het moet bekend zijn of de persoon al is gevaccineerd!');
        }
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

    public function viewAdd() {
        return view('addParticipants');
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'birthday' => 'required',
            'role' => 'required',
            'proof' => 'required',
            'checkedIn' => 'required',
        ]);
        if($request->input('proof') == 0){
            return back()->with('error','Het moet bekend zijn of de persoon al is gevaccineerd!');
        }
        $participant = new Participant;
        $participant->firstName = $request->input('firstName');
        $participant->lastName = $request->input('lastName');
        $participant->birthday = $request->input('birthday');
        $participant->email = $request->input('email');
        $participant->phoneNumber = $request->input('phoneNumber');
        $participant->studentYear = $request->input('studentYear');
        $participant->firstNameParent = $request->input('firstNameParent');
        $participant->lastNameParent = $request->input('lastNameParent');
        $participant->addressParent = $request->input('addressParent');
        $participant->phoneNumberParent = $request->input('phoneNumberParent');
        $participant->medicalIssues = $request->input('medicalIssues');
        $participant->specials = $request->input('specials');
        $participant->role = $request->input('role');
        $participant->covidTest = $request->input('covidTest');
        $participant->checkedIn = (int)$request->input('checkedIn');
        $participant->save();
        return redirect('/add')->with('message', 'Deelnemer is toegevoegd');
    }
}
