<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model {

    protected $table = "suggestions";

    protected $dates = ['life_time'];

    public function song() {
        return $this->belongsTo('App\Song');
    }

    public function votes() {
        return $this->hasMany('App\Vote');
    }

    public function guest() {
        return $this->belongsTo('App\Guest');
    }

    public function event() {
        return $this->belongsTo('App\Event');
    }

    public function playlist_entries() {
        return $this->hasMany('App\PlaylistEntry');
    }
}
