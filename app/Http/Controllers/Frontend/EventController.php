<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->get();
        return view('site.news.index', compact('events'));
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('site.news.show', compact('event'));
    }
}
