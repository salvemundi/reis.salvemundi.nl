<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Enums\Roles;

class DashboardController extends Controller
{
    public function index() {
        $viewVars = [];

        $viewVars['amountTotal']                = Participant::count();
        $viewVars['amountTotalCheckedIn']       = Participant::where('checkedIn', true)->count();
        $viewVars['amountCrew']                 = Participant::where('role', Roles::crew)->count();
        $viewVars['amountCrewCheckedIn']        = Participant::where('role', Roles::crew)->where('checkedIn', true)->count();
        $viewVars['amountChildren']             = Participant::where('role', Roles::child)->count();
        $viewVars['amountChildrenCheckedIn']    = Participant::where('role', Roles::child)->where('checkedIn', true)->count();
        $viewVars['amountParents']              = Participant::where('role', Roles::dad_mom)->count();
        $viewVars['amountParentsCheckedIn']     = Participant::where('role', Roles::dad_mom)->where('checkedIn', true)->count();
        $viewVars['amountTeachers']             = Participant::where('role', Roles::teacher)->count();
        $viewVars['amountTeachersCheckedIn']    = Participant::where('role', Roles::teacher)->where('checkedIn', true)->count();

        return view('admin/dashboard', $viewVars);
    }
}
