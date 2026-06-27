<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventType;
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
        $categories = $event->categories;
        $timeline = $event->timelines;
        $author = $event->author;
        $detailEvents = $event->detailEvents;
        // dd($eventType);
        return view('user.detail-event', compact('event', 'eventType', 'categories', 'timeline', 'author', 'detailEvents'));
    }
}
