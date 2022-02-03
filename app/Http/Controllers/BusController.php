<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\Participant;

class BusController extends Controller
{
    public function index() {
        $viewVars = [];

        $viewVars['busses'] = Bus::all();
        $viewVars['allParticipants'] = Participant::where('checkedIn', true)->count();
        $viewVars['allParticipantsInBuss'] = Bus::sum('personAmount');
        $viewVars['differenceParticipantsInBusses'] = $viewVars['allParticipants'] - $viewVars['allParticipantsInBuss'];

        return view('admin/bus', $viewVars);
    }

    public function addBusses(Request $request) {
        for ($i = 0; $i < $request->input('busAmount'); $i++) {
            $bus = new Bus;
            $bus->save();
        }

        return back()->with('message', 'Bus(sen) zijn toegevoegd!');
    }

    public function addBusNumber(Request $request) {
        $bus = Bus::find($request->input('id'));
        $bus->busNumber = $request->input('busNumber');

        if (Bus::where('busNumber', '=', $request->input('busNumber'))->first() != null) {
            return back()->with('error', 'Busnummer is al in gebruik!');
        }

        $bus->save();

        return back()->with('message', 'Busnummer is toegevoegd!');
    }

    public function addPersonsToBus(Request $request) {
        $bus = Bus::find($request->input('id'));
        $bus->personAmount = $request->input('personAmount');
        $bus->save();

        return back()->with('message', 'Aantal personen zijn toegevoegd!');
    }

    public function resetBusses() {
        Bus::truncate();
        return back()->with('message', 'De bussen zijn verwijderd!');
    }
}
