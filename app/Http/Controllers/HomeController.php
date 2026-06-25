<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventType;
use Illuminate\Http\Request;

class HomeController extends Controller
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
}
