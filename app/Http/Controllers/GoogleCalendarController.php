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
        $calendarEvent->nama = $event->nama;
        $calendarEvent->description = $event->description;
        $calendarEvent->start_date = Carbon::parse($event->start_date);
        $calendarEvent->end_date = Carbon::parse($event->end_date);

        $calendarEvent->update();

        return redirect()->back()->with('success', 'Event created and added to Google Calendar successfully!');
    }

}
