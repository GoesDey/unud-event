<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserPageController extends Controller
{
    public function index() {
        $types = EventType::all();
        $events = Event::with('eventType', 'categories', 'participants')->where('end_date', '>=', now()->toDateString())
        ->orderBy('end_date', 'asc')
        ->take(3)
        ->get();
        // dd($events);
        return view('user.home', compact('types', 'events'));
    }
    public function detailEvent(Event $event) {
        $event->load(['eventType', 'categories', 'participants', 'timelines', 'author', 'detailEvents']);
        $eventType = $event->eventType;
        $participants = $event->participants;
        $categories = $event->categories;
        $timelines = $event->timelines->transform(function ($timeline) {
            $start = Carbon::parse($timeline->start)->locale('id');
            $end = Carbon::parse($timeline->end);

            $timeline->waktu_format = $start->isoFormat('D MMMM YYYY') . ' : ' . $start->format('H.i') . ' - ' . $end->format('H.i');
            
            return $timeline;
        });
        $author = $event->author;
        $detailEvents = $event->detailEvents;

        $backUrl = url()->previous() !== url()->current() 
        ? url()->previous() 
        : route('events');
        // dd($eventType);
        return view('user.detail-event', compact('event', 'eventType', 'participants','categories', 'timelines', 'author', 'detailEvents', 'backUrl'));
    }
}
