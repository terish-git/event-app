<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Requests\EventStoreRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $events = Event::where('created_by', auth()->user()->id)->get();
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventStoreRequest $request)
    {
        // Method 1
        // $input               = $request->all();
        // $event               = Event::create($input);
        // Method 2
        $event                  = new Event;
        $event->name            = $request->name;
        $event->start_date      = $request->start_date;
        $event->end_date        = $request->end_date;
        $event->save();
        return back()->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('event.show',compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Event $event)
    {
        if ($request->ajax()) {
            return response()->json($event);
        }
        return view('event.edit',compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventStoreRequest $request, Event $event)
    {
        $event->update($request->all());
        return redirect()->route('events.index')->with('success','Event updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        if (!$event->invited->isEmpty()) {
            return ['error' => true, 'message' => "Cant Delete ! Please delete all invitations"];
        }
        $event->delete();
        return ['error' => false, 'message' => "Event deleted successfully"];
    }
}
