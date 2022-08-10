<?php

namespace App\Http\Controllers;

use App\Enums\AuditCategory;
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
        $new = true;
        if($request->input('eventId')) {
            $new = false;
            $event = Schedule::find($request->input('eventId'));
        } else {
            $event = new Schedule;
        }

        $event->name =  $request->input('name');
        $event->description =  $request->input('description');
        $event->beginTime =  $request->input('beginTime');
        $event->endTime =  $request->input('endTime');

        $event->save();
        if($new) {
            AuditLogController::Log(AuditCategory::ScheduleManagement(), 'Nieuw event aangemaakt',null, null, null, $event);
        } else {
            AuditLogController::Log(AuditCategory::ScheduleManagement(), 'Event aangepast',null, null, null, $event);
        }
        return redirect('/events')->with('success', 'Event is opgeslagen!');
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
                AuditLogController::Log(AuditCategory::ScheduleManagement(), 'Event verwijderd',null, null, null, $event);
                return redirect('/events')->with('success', 'Event is verwijderd!');
            }
            return redirect('/events')->with('error', 'Event kon niet gevonden worden!');

        }
        return redirect('/events')->with('error', 'Er ging iets niet helemaal goed, probeer het later nog een keer.');
    }
}
