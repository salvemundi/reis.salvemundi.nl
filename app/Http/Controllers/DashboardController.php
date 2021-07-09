<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;

class DashboardController extends Controller
{
    public function index() {
        $viewVars = [];

        $viewVars['amountTotal']                = Participant::count();
        $viewVars['amountTotalCheckedIn']       = Participant::where('checkedIn', 1)->count();
        $viewVars['amountCrew']                 = Participant::where('role', 3)->count();
        $viewVars['amountCrewCheckedIn']        = Participant::where('role', 3)->where('checkedIn', 1)->count();
        $viewVars['amountChildren']             = Participant::where('role', 0)->count();
        $viewVars['amountChildrenCheckedIn']    = Participant::where('role', 0)->where('checkedIn', 1)->count();
        $viewVars['amountParents']              = Participant::where('role', 1)->count();
        $viewVars['amountParentsCheckedIn']     = Participant::where('role', 1)->where('checkedIn', 1)->count();
        $viewVars['amountTeachers']             = Participant::where('role', 2)->count();
        $viewVars['amountTeachersCheckedIn']    = Participant::where('role', 2)->where('checkedIn', 1)->count();

        return view("dashboard", $viewVars);
    }
}
