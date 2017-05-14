<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Event;

class EventsController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $currentEvents = Event::latest()->where('location_id', '=', auth()->user()->location->id)
            ->whereDate('end', '>', Carbon::now())
            ->whereDate('start', '<', Carbon::now())
            ->get();

        $upcomingEvents = Event::latest()->where('location_id', '=', auth()->user()->location->id)
            ->whereDate('start', '>', Carbon::now())->get();

        $pastEvents = Event::latest()->where('location_id', '=', auth()->user()->location->id)
            ->whereDate('end', '<', Carbon::now())
            ->get();

        return view('admin.events.index', compact('currentEvents', 'upcomingEvents', 'pastEvents'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
                'name' => 'required',
                'spotify_playlist_id' => 'required',
                'start' => 'required|date',
                'end' => 'required|date'
            ]);

        auth()->user()->location->events()->create([
                'name' => request('name'),
                'spotify_playlist_id' => request('spotify_playlist_id'),
                'next_pick' => Carbon::createFromFormat('Y-m-d\Th:i', request('start')),
                'start' => Carbon::createFromFormat('Y-m-d\Th:i', request('start')),
                'end' => Carbon::createFromFormat('Y-m-d\Th:i', request('end'))
            ]);

        return redirect('/admin/events');
    }

    public function show($id)
    {
        return view('admin.events.show');
    }

    public function edit($id)
    {
        $event = Event::find($id);

        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $this->validate(request(), [
                'name' => 'required',
                'spotify_playlist_id' => 'required',
                'start' => 'required|date',
                'end' => 'required|date'
            ]);

        $event = Event::findOrFail($id);

        $event->update([
                'name' => request('name'),
                'spotify_playlist_id' => request('spotify_playlist_id'),
                'start' => Carbon::createFromFormat('Y-m-d\Th:i', request('start')),
                'end' => Carbon::createFromFormat('Y-m-d\Th:i', request('end'))
                ]);

        return redirect('/admin/events');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
