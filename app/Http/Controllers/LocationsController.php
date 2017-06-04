<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Location;
use App\Uahnn\Services\SpotifyService;

class LocationsController extends Controller {

    protected $spotifyService;

    public function __construct(SpotifyService $spotifyService) {
        $this->middleware('auth');
        $this->spotifyService = $spotifyService;
    }


    public function index() {

        return view('admin.location.index')->with('location', auth()->user()->location);
    }


    public function create() {
        if (auth()->user()->location_id) {
            return redirect('admin/location/edit');
        }

        if($spotify_data = session('spotify_data')) {

            return view('admin.location.create')->with([
                'spotify_url' => false,
                'access_token' => $spotify_data['access_token'],
                'refresh_token' => $spotify_data['refresh_token'],
                'expires' => $spotify_data['expires']
            ]);
        }else {

            $url = $this->spotifyService->getAccessUrl();

            return view('admin.location.create')->with([
                'spotify_url' => $url,
                'access_token' => false
            ]);
        }
    }


    public function store() {

        $this->validate(request(), [
            'name' => 'required',
            'spotify_token' => 'required',
            'expires_in' => 'required',
            'refresh_token' => 'required'
        ]);

        $user = $this->spotifyService->getUserName(request()->spotify_token);

        $location = Location::create([
            'name' => request()->name,
            'spotify_token' => request()->spotify_token,
            'spotify_user' => $user,
            'expires_in' => Carbon::now()->addSeconds(request()->expires_in - 120),
            'refresh_token' => request()->refresh_token
        ]);

        auth()->user()->location()->associate($location);

        auth()->user()->save();

        return redirect('/admin/location');
    }


    public function edit() {
        return view('admin.location.edit')->with('location', auth()->user()->location);
    }


    public function update() {
        $this->validate(request(), [
            'name' => 'required',
            'spotify_account_id' => 'required'
        ]);


        auth()->user()->location()->update(request(['name', 'spotify_account_id']));

        return redirect('/admin/location');
    }

    public function callback() {
        // TODO: fehler abfangen

        $spotify_data = $this->spotifyService->getAccessToken(request()->input('code'));

        return redirect()->action('LocationsController@create')->with('spotify_data', $spotify_data);
    }

}
