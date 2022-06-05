<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use Carbon\Carbon;
use DateTimeZone;

class ScheduleController extends Controller
{
    public function index()
    {
        $events = Schedule::orderBy('beginTime', 'ASC')->get();
        $time = Carbon::now();
        $time->tz = new DateTimeZone('Europe/Amsterdam');
        $timeFound = false;
        $currentEvent = null;
        $nextEvent = null;
        foreach ($events as $event)
        {
            if($timeFound)
            {
                $nextEvent = $event;
                $timeFound = false;
            }
            if ($event->beginTime <= $time)
            {
                if($event->endTime >= $time)
                {
                    $currentEvent = $event;
                    $timeFound = true;
                }
            }
        }
        return view('qr-code', ['events' => $events, 'currentEvent' => $currentEvent, 'nextEvent' => $nextEvent]);
    }

    public function getAllEvents()
    {
        $schedules = Schedule::all();
        return view('admin/schedule', ['events' => $schedules]);
    }

    public function saveEvent(Request $request) {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'beginTime' => 'required', 'date_format:Y-m-d\TH:i',
            'endTime' => 'required', 'date_format:Y-m-d\TH:i',
        ]);

        $event = null;
        if($request->input('eventId')) {
            $event = Schedule::find($request->input('eventId'));
        } else {
            $event = new Schedule;
        }

        $event->name =  $request->input('name');
        $event->description =  $request->input('description');
        $event->beginTime =  $request->input('beginTime');
        $event->endTime =  $request->input('endTime');

        $event->save();
        return redirect('/events')->with('success', 'Blog is opgeslagen!');
    }


    public function showEventInputs(Request $request) {
        $event = null;
        if($request->eventId){
            $event = Schedule::find($request->eventId);
        }
        return view('admin/addSchedule',['event' => $event]);
    }

    public function deleteEvent(Request $request) {
        if($request->eventId) {
            $event = Schedule::find($request->eventId);
            if($event != null) {
                $event->delete();
                return redirect('/events')->with('success', 'Blog is verwijderd!');
            }
            return redirect('/events')->with('error', 'Blog kon niet gevonden worden!');

        }
        return redirect('/events')->with('error', 'Er ging iets niet helemaal goed, probeer het later nog een keer.');
    }


}
