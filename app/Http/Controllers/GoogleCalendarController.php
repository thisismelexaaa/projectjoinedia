<?php

namespace App\Http\Controllers;

use App\Models\BuatEvent;
use Carbon\Carbon;
use Spatie\GoogleCalendar\Event;

class GoogleCalendarController extends Controller
{

    public function createEvent($event)
    {
        $calendarEvent = new BuatEvent();
        $calendarEvent->name = $event->nama;
        $calendarEvent->description = $event->description;
        $calendarEvent->startDateTime = Carbon::parse($event->start_date);
        $calendarEvent->endDateTime = Carbon::parse($event->end_date);

        $calendarEvent->save();

        return redirect()->back()->with('success', 'Event created and added to Google Calendar successfully!');
    }

}
