<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Enums\Roles;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    private PaymentController $paymentController;

    public function __construct() {
        $this->paymentController = new PaymentController();
    }

    public function index(): Factory|View|Application
    {
        $viewVars = [];

        $viewVars['amountTotalCheckedIn']           = Participant::where('checkedIn', true)->count();
        $viewVars['amountCrew']                     = Participant::where('role', Roles::crew)->count();
        $viewVars['amountCrewCheckedIn']            = Participant::where('role', Roles::crew)->where('checkedIn', true)->count();
        $viewVars['amountParticipants']             = Participant::where('role', Roles::participant)->where('checkedIn', true)->count();
        $viewVars['amountAllTravelers']             = Participant::all()->count();
        $viewVars['amountParticipantsPaid']         = count($this->paymentController->getAllPaidUsers());
        $viewVars['amountParticipantsCheckedIn']    = Participant::where('role', Roles::participant)->where('checkedIn', true)->count();
        $viewVars['amountEveryone']                 = $viewVars['amountParticipantsPaid'] + $viewVars['amountCrew'];

        return view('admin/dashboard', $viewVars);
    }
}
