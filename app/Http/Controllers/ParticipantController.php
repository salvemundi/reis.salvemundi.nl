<?php

namespace App\Http\Controllers;

use App\Enums\AuditCategory;
use App\Jobs\resendQRCodeEmails;
use App\Jobs\resendVerificationEmail;
use App\Jobs\sendQRCodesToNonParticipants;
use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Participant;
use App\Enums\Roles;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Mail\VerificationMail;
use App\Mail\VerifySignUpWaitingList;
use App\Models\VerificationToken;
use App\Models\ConfirmationToken;
use App\Mail\manuallyAddedMail;
use App\Mail\emailConfirmationSignup;
use Throwable;

class ParticipantController extends Controller {
    private VerificationController $verificationController;
    private PaymentController $paymentController;
    private ActivityController $activityController;

    public function __construct() {
        $this->verificationController = new VerificationController();
        $this->paymentController = new PaymentController();
        $this->activityController = new ActivityController();
    }

    /**
     * @throws Throwable
     */
    public function linkActivities(Participant $participant, Collection $activities): Participant {
        foreach($activities as $activity) {
            $participant->activities()->attach($activity, ['id' => Str::uuid()->toString()]);
        }
        $participant->saveOrFail();

        return $participant;
    }

    public function view(): Factory|View|Application
    {
        $checkSignUp = Setting::where('name','SignupPageEnabled')->first()->value;
        $checkSignUp = filter_var($checkSignUp, FILTER_VALIDATE_BOOLEAN);
        return view('/signup', ['checkSignUp' => $checkSignUp]);
    }

    public function getParticipantsWithInformation(Request $request): View|Factory|Redirector|RedirectResponse|Application
    {
        AuditLogController::Log(AuditCategory::Other(),'Bezocht pagina met alle deelnemers');

        $participants = Participant::all();
        $dateToday = Carbon::now()->toDate();
        $selectedParticipant = Participant::find($request->userId);

        if(!isset($selectedParticipant)) {
            if($request->userId) {
                return redirect("/participants");
            }
        } else {
            $age = Carbon::parse($selectedParticipant->birthday)->diff(Carbon::now())->format('%y years');
            AuditLogController::Log(AuditCategory::ParticipantManagement(), "Ziet gegevens van " . $selectedParticipant->firstName . " " . $selectedParticipant->lastName, $selectedParticipant);
        }

        foreach($participants as $participant) {
            if($participant->payments != null) {
                $participant->latestPayment = $participant->payments()->latest()->first();
            }
            $participant->dateDifference = $dateToday->diff($participant->created_at)->d;
        }

        return view('admin/participants', ['participants' => $participants, 'selectedParticipant' => $selectedParticipant ?? null, 'age' => $age ?? null]);
    }

    public function checkedInView(Request $request): View|Factory|Redirector|RedirectResponse|Application
    {
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
        $participant->checkedIn = true;
        $participant->save();
        AuditLogController::Log(AuditCategory::ParticipantManagement(), "Heeft " . $participant->firstName . " " . $participant->lastName. " in gechecked", $participant);

        return back();
    }

    public function checkOut(Request $request) {
        $participant = Participant::find($request->userId);
        $participant->checkedIn = false;
        $participant->save();
        AuditLogController::Log(AuditCategory::ParticipantManagement(), "Heeft " . $participant->firstName . " " . $participant->lastName. " uit gechecked", $participant);

        return back();
    }

    public function changeReserveList(Request $request): RedirectResponse {
        $participant = Participant::find($request->userId);
        $participant->isOnReserveList = !$participant->isOnReserveList;
        $participant->save();

        $string = $participant->isOnReserveList ?
            "Heeft " . $participant->firstName . " " . $participant->lastName. " in de wachtrij gezet" :
            "Heeft " . $participant->firstName . " " . $participant->lastName. " uit de wachtrij gehaald";

        AuditLogController::Log(AuditCategory::ParticipantManagement(), $string ,$participant);

        return back();
    }

    public function checkOutEveryone() {
        Participant::query()->update(['checkedIn' => false]);
        AuditLogController::Log(AuditCategory::Other(), "Heeft iedereen uit gechecked");

        return back();
    }

    public function delete(Request $request) {
        $participant = Participant::find($request->userId);
        $participant->delete();
        AuditLogController::Log(AuditCategory::ParticipantManagement(), "Heeft " . $participant->firstName . " " . $participant->lastName. " verwijderd", $participant);
        return redirect("/participants");
    }

    public function viewAdd() {
        return view('admin/addParticipants');
    }

    /**
     * @throws Throwable
     */
    public function store(Request $request, bool $saveActivities = false): RedirectResponse
    {
        if($request->input('confirmation') == null) {
            $request->validate([
                'firstName' => 'required', 'regex:/^[a-zA-Z á é í ó ú ý Á É Í Ó Ú Ý ç Ç â ê î ô û Â Ê Î Ô Û à è ì ò ù À È Ì Ò Ù ä ë ï ö ü ÿ Ä Ë Ï Ö Ü Ÿ ã õ ñ Ã Õ Ñ]+$/',
                'insertion' => ['nullable','max:32','regex:/^[a-zA-Z ]+$/'],
                'lastName' => 'required', 'regex:/^[a-zA-Z á é í ó ú ý Á É Í Ó Ú Ý ç Ç â ê î ô û Â Ê Î Ô Û à è ì ò ù À È Ì Ò Ù ä ë ï ö ü ÿ Ä Ë Ï Ö Ü Ÿ ã õ ñ Ã Õ Ñ]+$/',
                'birthday' => 'required',
                'email' => 'required|email:rfc,dns|max:65',
                'phoneNumber' => 'required|max:15|regex:/(^[0-9]+$)+/',
                'medicalIssues' => 'nullable|max:250|regex:/^[a-zA-Z0-9\s ,-]+$/',
                'specials' => 'nullable|max:250|regex:/^[a-zA-Z0-9\s ,-]+$/',
                'role' => 'nullable',
                'checkedIn' => 'nullable',
                'activities' => 'required',
            ]);
        } else {
            $request->validate([
                'firstName' => 'nullable', 'regex:/^[a-zA-Z á é í ó ú ý Á É Í Ó Ú Ý ç Ç â ê î ô û Â Ê Î Ô Û à è ì ò ù À È Ì Ò Ù ä ë ï ö ü ÿ Ä Ë Ï Ö Ü Ÿ ã õ ñ Ã Õ Ñ]+$/]',
                'insertion' => ['nullable','max:32','regex:/^[a-zA-Z ]+$/'],
                'lastName' =>  'nullable', 'regex:/^[a-zA-Z á é í ó ú ý Á É Í Ó Ú Ý ç Ç â ê î ô û Â Ê Î Ô Û à è ì ò ù À È Ì Ò Ù ä ë ï ö ü ÿ Ä Ë Ï Ö Ü Ÿ ã õ ñ Ã Õ Ñ]+$/]',
                'birthday' => 'required',
                'email' => 'required|email:rfc,dns|max:65',
                'phoneNumber' => 'required|max:15|regex:/(^[0-9]+$)+/',
                'medicalIssues' => 'nullable|max:250|regex:/^[a-zA-Z0-9\s ,-]+$/',
                'specials' => 'nullable|max:250|regex:/^[a-zA-Z0-9\s ,-]+$/',
                'role' => 'nullable',
                'checkedIn' => 'nullable',
            ]);
        }

        if($request->input('uid') != null) {
            $participant = Participant::find($request->input('uid'));
        } else {
            $participant = new Participant;
            $participant->id = Str::uuid()->toString();
        }

        if($request->input('confirmation') == null) {
            if(Setting::where('name','SignupPageEnabled')->first()->value == 'false') {
                return back()->with('error','Inschrijvingen zijn helaas gesloten!');
            }
        } else {
            if(Setting::where('name','ConfirmationEnabled')->first()->value == 'false') {
                return back()->with('error','Inschrijvingen zijn helaas gesloten!');
            }
        }

        $participant->birthday = $request->input('birthday');
        $participant->email = $request->input('email');
        $participant->phoneNumber = $request->input('phoneNumber');

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
        if($saveActivities) {
            $activityCollection = new Collection();
            foreach ($request->only(['activities'])['activities'] as $uuid) {
                $activityCollection->add($this->activityController->show($uuid));
            }
            $this->linkActivities($participant, $activityCollection);
        }
        $participant->save();

        return back()->with('message', 'Informatie is opgeslagen!');
    }

    public function signup(Request $request) {
        $request->validate([
            'firstName' => ['required', 'max:65', 'regex:/^[a-zA-Z á é í ó ú ý Á É Í Ó Ú Ý ç Ç â ê î ô û Â Ê Î Ô Û à è ì ò ù À È Ì Ò Ù ä ë ï ö ü ÿ Ä Ë Ï Ö Ü Ÿ ã õ ñ Ã Õ Ñ]+$/'],
            'insertion' => ['nullable','max:32','regex:/^[a-zA-Z ]+$/'],
            'lastName' => ['required', 'max:65', 'regex:/^[a-zA-Z á é í ó ú ý Á É Í Ó Ú Ý ç Ç â ê î ô û Â Ê Î Ô Û à è ì ò ù À È Ì Ò Ù ä ë ï ö ü ÿ Ä Ë Ï Ö Ü Ÿ ã õ ñ Ã Õ Ñ]+$/'],
            'email' => 'required|email:rfc,dns|max:65',
            'phoneNumber' => 'required|min:10|max:15|regex:/(^[0-9+]+$)+/|',
        ]);

        if(Setting::where('name','SignupPageEnabled')->first()->value == 'false') {
            return back()->with('error','Inschrijvingen zijn helaas gesloten!');
        }

        if (Participant::where('email', $request->input('email'))->count() > 0) {
            return back()->with('warning', 'Dit email adres bestaat al!');
        }

        $participant = new Participant;
        $participant->firstName = $request->input('firstName');
        $participant->insertion = $request->input('insertion');
        $participant->lastName = $request->input('lastName');
        $participant->email = $request->input('email');
        $participant->phoneNumber = $request->input('phoneNumber');

        if (!$request->input('cbx')) {
            return back()->with('warning', 'Accept the terms and conditions');
        }

        $participant->save();

        $token = new VerificationToken;
        $token->participant()->associate($participant);
        $token->save();

        Mail::to($participant->email)
            ->send(new VerificationMail($participant, $token));
        if ((int)Setting::where('name', 'MaxAmountParticipants')->first()->value < Participant::count()) {
            $participant->isOnReserveList = true;
            $participant->save();
            Mail::to($participant->email)
                ->send(new VerifySignUpWaitingList($participant));
            return back()->with('message', 'Je hebt je succesvol ingeschreven maar je bent helaas te laat en staat in de wachtrij.');
        }
        return back()->with('message', 'Je hebt je ingeschreven! Check je mail om jou email te verifiëren');
    }

    public function sendEmailsToNonVerified(): RedirectResponse {
        $nonVerifiedParticipants = $this->verificationController->getNonVerifiedParticipants();

        foreach($nonVerifiedParticipants as $participant) {
            $verificationToken = $this->verificationController->createNewVerificationToken($participant);
            $verificationToken->save();

            resendVerificationEmail::dispatch($participant, $verificationToken);
        }

        AuditLogController::Log(AuditCategory::Other(), "Heeft opnieuw verificatie mails verzonden naar alle niet geverifieerde deelnemers");

        return back()->with('message', 'De mails zijn verstuurd!');
    }

    public function resendQRCodeEmails(): RedirectResponse {
        $paidParticipants = $this->paymentController->getAllPaidUsers();

        foreach($paidParticipants as $participant) {
            resendQRCodeEmails::dispatch($participant);
        }

        AuditLogController::Log(AuditCategory::Other(), "Heeft alle qr-codes opnieuw verzonden naar alle betaalde deelnemers");
        return back()->with('message', 'De mails zijn verstuurd!');
    }

    public function storeEdit(Request $request): RedirectResponse
    {
        $request->validate([
            'participantFirstName' => 'required', 'regex:/^[a-zA-Z á é í ó ú ý Á É Í Ó Ú Ý ç Ç â ê î ô û Â Ê Î Ô Û à è ì ò ù À È Ì Ò Ù ä ë ï ö ü ÿ Ä Ë Ï Ö Ü Ÿ ã õ ñ Ã Õ Ñ]+$/',
            'participantInsertion' => ['nullable','max:32','regex:/^[a-zA-Z ]+$/'],
            'participantLastName' => 'required', 'regex:/^[a-zA-Z á é í ó ú ý Á É Í Ó Ú Ý ç Ç â ê î ô û Â Ê Î Ô Û à è ì ò ù À È Ì Ò Ù ä ë ï ö ü ÿ Ä Ë Ï Ö Ü Ÿ ã õ ñ Ã Õ Ñ]+$/',
            'participantBirthday' => 'nullable',
            'participantEmail' => 'required|email:rfc,dns|max:65',
            'participantPhoneNumber' => 'nullable|max:15|regex:/(^[0-9]+$)+/',
            'participantAddress' => ['nullable', 'max:65', 'regex:/^[a-zA-Z0-9 ]+$/'],
            'participantMedicalIssues' => 'nullable|max:250|regex:/^[a-zA-Z0-9\s ,-]+$/',
            'participantSpecial' => 'nullable|max:250|regex:/^[a-zA-Z0-9\s ,-]+$/'
        ]);
        $participant = Participant::find($request->userId);
        AuditLogController::Log(AuditCategory::ParticipantManagement(), "Bewerkt gegevens van " . $participant->firstName . " " . $participant->lastName, $participant);
        if($participant == null) {
            return back()->with('error','Deelnemer niet gevonden!');
        }
        $participant->firstName = $request->input('participantFirstName');
        $participant->insertion = $request->input('participantInsertion');
        $participant->lastName = $request->input('participantLastName');
        $participant->email = $request->input('participantEmail');
        $participant->birthday = $request->input('participantBirthday');
        $participant->phoneNumber = $request->input('participantPhoneNumber');
        $participant->medicalIssues = $request->input('participantMedicalIssues');
        $participant->role = $request->input('participantRole') ?? 0;
        $participant->save();
        return back()->with('success','Deelnemer gegevens opgeslagen!');
    }


    public function storeSelfAddedParticipant(Request $request): RedirectResponse
    {
        $request->validate([
            'firstName' => ['required', 'regex:/^[a-zA-Z á é í ó ú ý Á É Í Ó Ú Ý ç Ç â ê î ô û Â Ê Î Ô Û à è ì ò ù À È Ì Ò Ù ä ë ï ö ü ÿ Ä Ë Ï Ö Ü Ÿ ã õ ñ Ã Õ Ñ]+$/'],
            'insertion' => ['nullable','max:32','regex:/^[a-zA-Z ]+$/'],
            'lastName' =>  ['required', 'regex:/^[a-zA-Z á é í ó ú ý Á É Í Ó Ú Ý ç Ç â ê î ô û Â Ê Î Ô Û à è ì ò ù À È Ì Ò Ù ä ë ï ö ü ÿ Ä Ë Ï Ö Ü Ÿ ã õ ñ Ã Õ Ñ]+$/'],
            'birthday' => 'required',
            'email' => 'required|email:rfc,dns|max:65',
            'phoneNumber' => 'required|max:15|regex:/(^[0-9]+$)+/',
            'medicalIssues' => 'nullable|max:250|regex:/^[a-zA-Z0-9\s ,-]+$/',
            'specials' => 'nullable|max:250|regex:/^[a-zA-Z0-9\s ,-]+$/',
            'role' => 'nullable',
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
        $participant->medicalIssues = $request->input('medicalIssues');
        $participant->specials = $request->input('specials');

        if($request->input('role') != null) {
            $participant->role = $request->input('role');
        } else {
            $participant->role = 0;
        }

        if($request->input('checkedIn') != null) {
            $participant->checkedIn = Roles::coerce((int)$request->input('checkedIn'));
        } else {
            $participant->checkedIn = Roles::coerce(0);
        }

        $participant->save();

        $verificationToken = $this->verificationController->createNewVerificationToken($participant);
        $verificationToken->verified = true;
        $verificationToken->save();

        $newConfirmationToken = new ConfirmationToken();
        $newConfirmationToken->participant()->associate($participant);
        $newConfirmationToken->save();

        Mail::to($participant->email)
            ->send(new emailConfirmationSignup($participant, $newConfirmationToken));

        AuditLogController::Log(AuditCategory::ParticipantManagement(), "Heeft deelnemer " . $participant->firstName . " " . $participant->lastName. " toegevoegd", $participant);

        return back()->with('message', 'Deelnemer is opgeslagen!');
    }

    public function sendParticipantConfirmationEmail(Request $request): RedirectResponse
    {
        $participant = Participant::find($request->userId);
        if(!$participant->hasCompletedDownPayment()) {
            Mail::to($participant->email)
                ->send(new emailConfirmationSignup($participant, $this->createConfirmationToken($participant)));
            AuditLogController::Log(AuditCategory::ParticipantManagement(), "Heeft nieuwe confirmatie mail gestuurd naar " . $participant->firstName . " " . $participant->lastName, $participant);
            return back()->with('success','Confirmatie email verstuurd!');
        }
        return back()->with('error','Deelnemer heeft al betaald!');
    }

    public function finalPaymentView(Request $request): Factory|View|Application {
        $confirmationToken = ConfirmationToken::find($request->token);
        $selectedActivities = $confirmationToken->participant->activities;

        return view('/finalPayment', ['selectedActivities' => $selectedActivities, 'totalPaymentAmount' => $this->paymentController->calculateFinalPrice($request)]);
    }

    public function sendFinalPaymentEmail(): RedirectResponse {
        $paidParticipants = $this->paymentController->getAllPaidUsers();

        foreach($paidParticipants as $participant) {
            resendQRCodeEmails::dispatch($participant);
        }

        AuditLogController::Log(AuditCategory::Other(), "Heeft alle qr-codes opnieuw verzonden naar alle betaalde deelnemers");
        return back()->with('message', 'De mails zijn verstuurd!');
    }

    private function createConfirmationToken(Participant $participant): ConfirmationToken
    {
        $confirmationToken =  new ConfirmationToken();
        $confirmationToken->participant()->associate($participant);
        $confirmationToken->save();

        return $confirmationToken;
    }
}
