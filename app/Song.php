<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model {

    protected $table = "songs";

    protected $fillable = ['spotify_song_id', 'title', 'artist', 'duration_ms'];

    public function suggestions() {
        return $this->hasMany('App\Suggestion');
    }
}
