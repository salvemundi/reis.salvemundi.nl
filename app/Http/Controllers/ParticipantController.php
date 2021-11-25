<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;
use App\Enums\CovidProof;
use App\Enums\Roles;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ParticipantsExport;
use App\Mail\VerificationMail;
use App\Models\VerificationToken;

class ParticipantController extends Controller
{
    public function getParticipantsWithInformation(Request $request) {
        $participants = Participant::all();

        if ($request->userId) {

            $selectedParticipant = Participant::find($request->userId);
            if(!isset($selectedParticipant))
            {
                return redirect("/participants");
            }
            $age = Carbon::parse($selectedParticipant->birthday)->diff(\Carbon\Carbon::now())->format('%y years');

            return view('participants', ['participants' => $participants, 'selectedParticipant' => $selectedParticipant, 'age' => $age]);
        }

        return view('participants', ['participants' => $participants]);
    }

    public function checkedInView(Request $request){
        $availableParticipants = Participant::where('checkedIn', 1)->get();
        if ($request->userId) {

            $selectedParticipant = Participant::find($request->userId);
            if(!isset($selectedParticipant))
            {
                return redirect("/participants");
            }
            $age = Carbon::parse($selectedParticipant->birthday)->diff(\Carbon\Carbon::now())->format('%y years');

            return view('participantCheckedIn', ['participants' => $availableParticipants, 'selectedParticipant' => $selectedParticipant, 'age' => $age]);
        }
        return view('participantCheckedIn', ['participants' => $availableParticipants]);
    }

    public function checkIn(Request $request) {

        $participant = Participant::find($request->userId);
        $participant->checkedIn = true;
        $participant->save();

        return back();
    }

    public function checkOut(Request $request) {
        $participant = Participant::find($request->userId);
        $participant->checkedIn = false;
        $participant->save();

        return back();
    }
    public function delete(Request $request) {
        $participant = Participant::find($request->userId);
        $participant->delete();

        return redirect("/participants");
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
            'email' => 'unique:participants',
            'phoneNumber' => 'required|min:11|numeric',
            'role' => 'required',
            'checkedIn' => 'required',
        ]);

        $participant = new Participant;
        $participant->id = Str::uuid()->toString();
        $participant->firstName = $request->input('firstName');
        $participant->insertion = $request->input('insertion');
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
        $participant->checkedIn = Roles::coerce((int)$request->input('checkedIn'));
        $participant->save();

        return back()->with('message', 'Deelnemer is toegevoegd!');
    }

    function excel() {
        return Excel::download(new ParticipantsExport, 'deelnemersInformatie.xlsx');
    }

    public function signupIndex() {
        return view('signup');
    }

    public function signup(Request $request) {
        $request->validate([
            'email' => 'required|email:rfc,dns|max:65',
        ]);

        $participant = new Participant;
        $participant->firstName = $request->input('firstName');
        $participant->insertion = $request->input('insertion');
        $participant->lastName = $request->input('lastName');
        $participant->email = $request->input('email');
        $participant->save();

        $token = new VerificationToken;
        $token->participant()->associate($participant);
        $token->save();

        Mail::to($participant->email)
            ->send(new VerificationMail($participant, $token));
        return back()->with('message', 'Je hebt je ingeschreven! Check je mail om jou email te verifiëren');
    }
}
