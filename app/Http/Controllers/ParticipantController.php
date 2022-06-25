<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;
use App\Enums\Roles;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ParticipantsExport;
use App\Exports\StudentFontysEmailExport;
use App\Mail\emailNonVerifiedParticipants;
use App\Mail\VerificationMail;
use App\Models\VerificationToken;
use App\Enums\StudyType;

class ParticipantController extends Controller {
    private $verificationController;

    public function __construct() {
        $this->verificationController = new VerificationController();
    }

    public function getParticipantsWithInformation(Request $request) {
        $participants = Participant::all();

        if ($request->userId) {
            $selectedParticipant = Participant::find($request->userId);
            if(!isset($selectedParticipant)) {
                return redirect("/participants");
            }
            $age = Carbon::parse($selectedParticipant->birthday)->diff(Carbon::now())->format('%y years');
            return view('admin/participants', ['participants' => $participants, 'selectedParticipant' => $selectedParticipant, 'age' => $age]);
        }
        return view('admin/participants', ['participants' => $participants]);
    }

    public function checkedInView(Request $request){
        $availableParticipants = Participant::where('checkedIn', 1)->get();

        if ($request->userId) {
            $selectedParticipant = Participant::find($request->userId);
            if(!isset($selectedParticipant)) {
                return redirect("/participants");
            }

            $age = Carbon::parse($selectedParticipant->birthday)->diff(Carbon::now())->format('%y years');

            return view('admin/participantCheckedIn', ['participants' => $availableParticipants, 'selectedParticipant' => $selectedParticipant, 'age' => $age]);
        }

        return view('admin/participantCheckedIn', ['participants' => $availableParticipants]);
    }

    public function getParticipant($token) {
        $participant = Participant::find($token);
        $age = Carbon::parse($participant->birthday)->diff(Carbon::now())->format('%y');
        if($age >= 18) {
            $participant->above18 = true;
        } else {
            $participant->above18 = false;
        }
        $participant->age = $age;
        return $participant->toJson();
    }

    public function checkIn(Request $request) {
        $participant = Participant::find($request->userId);
        if($participant->removedFromintro){
            return back();
        }
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

    public function checkOutEveryone() {
        Participant::query()->update(['checkedIn' => false]);
        return back();
    }

    public function delete(Request $request) {
        $participant = Participant::find($request->userId);
        $participant->delete();

        return redirect("/participants");
    }

    public function viewAdd() {
        return view('admin/addParticipants');
    }

    public function store(Request $request) {
        if($request->input('confirmation') == null) {
            $request->validate([
                'firstName' => 'required', 'regex:/^[a-zA-Z ]+$/',
                'insertion' => ['nullable','max:32','regex:/^[a-zA-Z ]+$/'],
                'lastName' => 'required', 'regex:/^[a-zA-Z ]+$/',
                'birthday' => 'required',
                'email' => 'required|email:rfc,dns|max:65',
                'phoneNumber' => 'required|max:15|regex:/(^[0-9]+$)+/',
                'firstNameParent' => ['nullable', 'max:65', 'regex:/^[a-zA-Z ]+$/'],
                'lastNameParent' => ['nullable', 'max:65', 'regex:/^[a-zA-Z ]+$/'],
                'addressParent' => ['nullable', 'max:65', 'regex:/^[a-zA-Z ]+$/'],
                'phoneNumberParent' => 'nullable|max:15|regex:/(^[0-9]+$)+/',
                'medicalIssues' => 'nullable|max:250|regex:/^[a-zA-Z ]+$/',
                'role' => 'nullable',
                'checkedIn' => 'nullable',
            ]);
        } else {
            $request->validate([
                'firstName' => ['nullable', 'regex:/^[a-zA-Z ]+$/]'],
                'insertion' => ['nullable','max:32','regex:/^[a-zA-Z ]+$/'],
                'lastName' =>  ['nullable', 'regex:/^[a-zA-Z ]+$/]'],
                'birthday' => 'required',
                'email' => 'required|email:rfc,dns|max:65',
                'fontysEmail' => 'required|email:rfc,dns|max:65|ends_with:student.fontys.nl',
                'phoneNumber' => 'required|max:15|regex:/(^[0-9]+$)+/',
                'firstNameParent' => ['nullable', 'max:65', 'regex:/^[a-zA-Z ]+$/'],
                'lastNameParent' => ['nullable', 'max:65', 'regex:/^[a-zA-Z ]+$/'],
                'addressParent' => ['nullable', 'max:65', 'regex:/^[a-zA-Z ]+$/'],
                'phoneNumberParent' => 'nullable|max:15|regex:/(^[0-9]+$)+/',
                'medicalIssues' => 'nullable|max:250|regex:/^[a-zA-Z ]+$/',
                'role' => 'nullable',
                'checkedIn' => 'nullable',
                'studyType' => 'required'
            ]);
        }

        if($request->input('uid') != null) {
            $participant = Participant::find($request->input('uid'));
        } else {
            $participant = new Participant;
            $participant->id = Str::uuid()->toString();
        }

        if($request->input('confirmation') == null) {
            $participant->firstName = $request->input('firstName');
            $participant->insertion = $request->input('insertion');
            $participant->lastName = $request->input('lastName');
        } else {
            $participant->fontysEmail = $request->input('fontysEmail');
        }

        $participant->birthday = $request->input('birthday');
        $participant->email = $request->input('email');
        $participant->phoneNumber = $request->input('phoneNumber');
        $participant->studyType = StudyType::coerce((int)$request->input('studyType'));

        if($request->input('studentYear') != null) {
            $participant->studentYear = $request->input('studentYear');
        } else {
            $participant->studentYear = 0;
        }

        $participant->firstNameParent = $request->input('firstNameParent');
        $participant->lastNameParent = $request->input('lastNameParent');
        $participant->addressParent = $request->input('addressParent');
        $participant->phoneNumberParent = $request->input('phoneNumberParent');
        $participant->medicalIssues = $request->input('medicalIssues');
        $participant->specials = $request->input('specials');

        if($request->input('role') != null) {
            $participant->role = $request->input('role');
        } else {
            $participant->role = 0;
        }

        // what is this shit
        if($request->input('checkedIn') != null) {
            $participant->checkedIn = Roles::coerce((int)$request->input('checkedIn'));
        } else {
            $participant->checkedIn = Roles::coerce(0);
        }
        $participant->save();

        return back()->with('message', 'Informatie is opgeslagen!');
    }

    function excel() {
        return Excel::download(new ParticipantsExport, 'deelnemersInformatie.xlsx');
    }

    function studentFontysEmails() {
        return Excel::download(new StudentFontysEmailExport, 'fontysEmails.xlsx');
    }

    public function storeNote(Request $request): \Illuminate\Http\RedirectResponse {
        $participant = Participant::find($request->userId);
        $participant->note = $request->input('participantNote');
        $participant->save();
        return back();
    }

    public function storeRemove(Request $request) {
        $participant = Participant::find($request->userId);
        $participant->removedFromIntro = !$participant->removedFromIntro;

        if($participant->removedFromIntro) {
            $participant->checkedIn = false;
        }

        $participant->save();
        return back();
    }

    public function signup(Request $request) {
        $request->validate([
            'firstName' => ['required', 'max:65', 'regex:/^[a-zA-Z ]+$/'],
            'insertion' => ['nullable','max:32','regex:/^[a-zA-Z ]+$/'],
            'lastName' => ['required', 'max:65', 'regex:/^[a-zA-Z ]+$/'],
            'email' => 'required|email:rfc,dns|max:65',
        ]);

        if (Participant::where('email', $request->input('email'))->count() > 0) {
            return back()->with('warning', 'Dit email adres bestaat al!');
        }

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

    //Create participant(purple only)
    public function purpleSignup(Request $request) {
        $request->validate([
            'fontysEmail' => 'required|email:rfc,dns|max:65|ends_with:student.fontys.nl',
            'email' => 'required|email:rfc,dns|max:65',

        ]);

        if (Participant::where('fontysEmail', $request->input('fontysEmail'))->count() > 0) {
            return back()->with('warning', 'Jij hebt je waarschijnlijk al ingeschreven voor purple!');
        }

        $participant = new Participant();
        $participant->fontysEmail= $request->input('fontysEmail');
        $participant->email = $request->input('email');
        $participant->save();

        return back()->with('message', 'Je hebt je succesvol opgegeven voor Purple!');
    }

    public function sendEmailsToNonVerified() {
        $nonVerifiedParticipants = $this->verificationController->getNonVerifiedParticipants();

        $token = new VerificationToken;
        $token->participant()->associate($participant);
        $token->save();

        Mail::to($nonVerifiedParticipants->email)
            ->send(new emailNonVerifiedParticipants($nonVerifiedParticipants, $token));

        return back()->with('message', 'De mails zijn verstuurd!');
    }
}
