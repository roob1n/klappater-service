<?php

namespace App\Uahnn\Services;

use Carbon\Carbon;
use GuzzleHttp\Client;

class SpotifyService {

    protected $client;

    protected $clientId;
    protected $secret;
    protected $redirectUri;


    public function __construct() {
        $this->client = new Client([
            'base_uri' => 'https://api.spotify.com/v1/'
        ]);

        $this->clientId = env('SPOTIFY_ID');
        $this->secret = env('SPOTIFY_SECRET');
        $this->redirectUri = env('SPOTIFY_REDIRECT_URI');
    }

    public function getAccessUrl() {

        $url = "http://accounts.spotify.com/authorize/";
        $url .= "?client_id=" . $this->clientId;
        $url .= "&response_type=code";
        $url .= "&redirect_uri=" . $this->redirectUri;
        $url .= "&scope=playlist-modify-public playlist-read-private playlist-modify-private";

        return $url;
    }

    public function getAccessToken($code) {

        $response = $this->client->request('POST', 'https://accounts.spotify.com/api/token', [
            'headers' => [
                'Authorization' => "Basic " . base64_encode($this->clientId . ":" . $this->secret)
            ],
            'form_params' => [
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => $this->redirectUri
            ]
        ]);

        $contents = json_decode($response->getBody()->getContents());

        return ['access_token' => $contents->access_token,
            'expires' => $contents->expires_in,
            'refresh_token' => $contents->refresh_token];
    }


    public function refreshAccessToken($location) {

        if ($location->expires_in < Carbon::now()) {

            $response = $this->client->request('POST', 'https://accounts.spotify.com/api/token', [
                'headers' => [
                    'Authorization' => "Basic " . base64_encode($this->clientId . ":" . $this->secret)
                ],
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $location->refresh_token,
                ]
            ]);

            $new_data = json_decode($response->getBody()->getContents());

            $location->spotify_token = $new_data['access_token'];
            $location->expires_in = Carbon::now()->addSeconds($new_data['expires_in'] - 120);

            if(isset($new_data['refresh_token']) && $new_data['refresh_token'] != $location->refresh_token) {
                $location->refresh_token = $new_data['refresh_token'];
            }

            $location->save();

            return true;
        }

        return false;
    }

    public function getUserName($access_token) {

        $response = $this->client->request('GET', 'https://api.spotify.com/v1/me', [
            'headers' => [
                'Authorization' => "Bearer " . $access_token
            ],
        ]);

        return json_decode($response->getBody()->getContents())->id;
    }

    public function putSongOnPlaylist($location, $playlist, $song) {

        $this->refreshAccessToken($location);

        $response = $this->client->request('POST',
            'https://api.spotify.com/v1/users/' . $location->spotify_user . '/playlists/' . $playlist . '/tracks?uris=spotify%3Atrack%3A' . $song,
            [
                'headers' => [
                    'Authorization' => "Bearer " . $location->spotify_token
                ]
            ]);
    }

    public function getSpotifyPlaylists($location) {

        $this->refreshAccessToken($location);

        $response = $this->client->request('GET', 'https://api.spotify.com/v1/users/' . $location->spotify_user . '/playlists/', [
            'headers' => [
                'Authorization' => "Bearer " . $location->spotify_token
            ],
        ]);

        return json_decode($response->getBody()->getContents())->items;
    }
}