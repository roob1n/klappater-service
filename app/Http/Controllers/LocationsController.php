<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Location;

class LocationsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }


    public function index() {

        return view('admin.location.index')->with('location', auth()->user()->location);
    }


    public function create($access_token = null) {
        if (auth()->user()->location_id) {
            return redirect('admin/location/edit');
        }

        if($access_token) {
            return view('admin.location.create')->with([
                'spotify_url' => false,
                'access_token' => $access_token
            ]);
        }else {
            $url = "http://accounts.spotify.com/authorize/";
            $url .= "?client_id=".env('SPOTIFY_ID');
            $url .= "&response_type=code";
            $url .= "&redirect_uri=".env('SPOTIFY_REDIRECT_URI');
            $url .= "&scope=playlist-modify-public playlist-read-private playlist-modify-private";

            return view('admin.location.create')->with([
                'spotify_url' => $url,
                'access_token' => false
            ]);
        }
    }


    public function store() {

        $this->validate(request(), [
            'name' => 'required',
            'spotify_token' => 'required'
        ]);

        $location = Location::create(request(['name', 'spotify_token']));

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

        $access_token = $this->getSpotifyAccessToken(request()->input('code'));

        return redirect()->action('LocationsController@create', ['access_token' => $access_token]);
    }

    private function getSpotifyAccessToken($code) {

        $client = new Client();

        $res = $client->request('POST', 'https://accounts.spotify.com/api/token', [
            'headers' => [
                'Authorization' => "Basic ". base64_encode(env('SPOTIFY_ID').":".env('SPOTIFY_SECRET'))
            ],
            'form_params' => [
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => env('SPOTIFY_REDIRECT_URI')
            ]
        ]);

        return json_decode($res->getBody()->getContents())->access_token;
    }
}
