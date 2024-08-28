<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use Google\Client;
use Google\Service\Calendar;
use Illuminate\Http\Request;
use App\Models\BuatEvent;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Log;

class GoogleCalendarController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setAuthConfig(config_path('credentials.json'));
        $this->client->addScope(Calendar::CALENDAR);
        $this->client->setRedirectUri(config('google.redirect_uri'));
    }

    public function connect()
    {
        $authUrl = $this->client->createAuthUrl();
        return redirect($authUrl);
    }

    public function callback(Request $request)
    {
        $this->client->authenticate($request->code);
        $accessToken = $this->client->getAccessToken();

        // Print access token for debugging
        logger()->info('Access Token Received: ', ['token' => $accessToken]);

        session(['google_access_token' => $accessToken]);

        return redirect()->route('penjadwalan.index');
    }

    public function createEvent($event)
    {
        // Check if access token is present
        $accessToken = session('google_access_token');
        if (!$accessToken) {
            return redirect()->back()->with('error', 'Google access token is missing.');
        }

        $this->client->setAccessToken($accessToken);

        // Check if the token is expired and refresh if necessary
        if ($this->client->isAccessTokenExpired()) {
            $refreshToken = $this->client->getRefreshToken();
            if ($refreshToken) {
                $newAccessToken = $this->client->fetchAccessTokenWithRefreshToken($refreshToken);
                session(['google_access_token' => $newAccessToken]);
                $this->client->setAccessToken($newAccessToken);
            } else {
                return redirect()->back()->with('error', 'Google access token is expired and no refresh token is available.');
            }
        }

        $service = new Calendar($this->client);
        $calendarId = 'primary';

        // Log event details for debugging
        Log::info('Creating Google Calendar Event:', [
            'summary' => $event->nama,
            'location' => $event->location,
            'description' => $event->description,
            'start_date' => $event->start_date,
            'end_date' => $event->end_date
        ]);

        $googleEvent = new \Google\Service\Calendar\Event([
            'summary' => $event->nama,
            'location' => $event->location,
            'description' => $event->description,
            'start' => [
                'dateTime' => $event->start_date,
                'timeZone' => 'Asia/Jakarta',
            ],
            'end' => [
                'dateTime' => $event->end_date,
                'timeZone' => 'Asia/Jakarta',
            ],
        ]);

        try {
            $service->events->insert($calendarId, $googleEvent);
            return redirect()->back()->with('success', 'Event created and added to Google Calendar!');
        } catch (\Exception $e) {
            Log::error('Failed to create Google Calendar event: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create event in Google Calendar.');
        }
=======
use Carbon\Carbon;
use Spatie\GoogleCalendar\Event;

class GoogleCalendarController extends Controller
{
    
    public function createEvent($event)
    {
        $calendarEvent = new Event;
        $calendarEvent->name = $event->nama;
        $calendarEvent->description = $event->description;
        $calendarEvent->startDateTime = Carbon::parse($event->start_date);
        $calendarEvent->endDateTime = Carbon::parse($event->end_date);

        $calendarEvent->save();

        return redirect()->back()->with('success', 'Event created and added to Google Calendar successfully!');
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36
    }

}
