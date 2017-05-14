<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {

    protected $table = "events";

    protected $fillable = ['name', 'next_pick', 'start', 'end', 'spotify_playlist_id'];

    protected $dates = ['next_pick', 'start', 'end'];

    public function location() {
        return $this->belongsTo('App\Location');
    }

    public function activation_codes() {
        return $this->hasMany('App\ActivationCode');
    }

    public function suggestions() {
        return $this->hasMany('App\Suggestion');
    }

    public function playlist_entries() {
        return $this->hasMany('App\PlaylistEntry');
    }

    public function guests() {
        return $this->belongsToMany('App\Guest', 'activation_codes');
    }

    /**
    *   Adds a generated ActivationCode to the event
    */
    public function addActivationCodes($number = 1) {

        for($i = 0; $i < $number; $i++) {

            $this->activation_codes()->create([
                    'code' => ActivationCode::generate(8),
                    'status' => 'valid'
                ]);
        }
    }
}
