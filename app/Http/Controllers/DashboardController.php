<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;

class DashboardController extends Controller
{
    public function index() {
        $amountTotal = Participant::count();
        $amountCrew = Participant::where('role', 3)->count();
        $amountChildren = Participant::where('role', 0)->count();
        $amountParents = Participant::where('role', 1)->count();
        $amountTeachers = Participant::where('role', 2)->count();
        return view("dashboard", ['amountTotal' => $amountTotal, 'amountCrew' => $amountCrew, 'amountChildren' => $amountChildren, 'amountParents' => $amountParents, 'amountTeachers' => $amountTeachers]);

    }
}
