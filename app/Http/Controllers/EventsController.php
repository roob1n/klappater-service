<?php

namespace App\Http\Controllers;

use App\Uahnn\Services\SpotifyService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Event;

class EventsController extends Controller {

    protected $spotifyService;

    public function __construct(SpotifyService $spotifyService) {
        $this->middleware('auth');
        $this->spotifyService = $spotifyService;
    }

    public function index() {

        $currentEvents = Event::latest()->where('location_id', '=', auth()->user()->location->id)
            ->where([
                ['start', '<', Carbon::now()],
                ['end', '>', Carbon::now()],
            ])
            ->get();

        $upcomingEvents = Event::latest()->where('location_id', '=', auth()->user()->location->id)
            ->where('start', '>', Carbon::now())->get();

        $pastEvents = Event::latest()->where('location_id', '=', auth()->user()->location->id)
            ->where('end', '<', Carbon::now())
            ->get();

        return view('admin.events.index', compact('currentEvents', 'upcomingEvents', 'pastEvents'));
    }

    public function create() {
        $playlists = $this->spotifyService->getSpotifyPlaylists(auth()->user()->location);

        return view('admin.events.create')->with(['playlists' => $playlists]);
    }

    public function store(Request $request) {
        $this->validate(request(), [
            'name' => 'required',
            'spotify_playlist_id' => 'required',
            'start' => 'required|date',
            'end' => 'required|date'
        ]);

        auth()->user()->location->events()->create([
            'name' => request('name'),
            'spotify_playlist_id' => request('spotify_playlist_id'),
            'next_pick' => Carbon::createFromFormat('Y-m-d\TH:i', request('start')),
            'start' => Carbon::createFromFormat('Y-m-d\TH:i', request('start')),
            'end' => Carbon::createFromFormat('Y-m-d\TH:i', request('end'))
        ]);

        return redirect('/admin/events');
    }

    public function show($id) {
        return view('admin.events.show');
    }

    public function edit($id) {
        $event = Event::find($id);

        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, $id) {
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}
