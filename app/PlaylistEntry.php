<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaylistEntry extends Model {

    protected $table = "playlist_entries";

    protected $dates = ['order'];

    public function event() {
        return $this->belongsTo('App\Event');
    }

    public function suggestion() {
        return $this->belongsTo('App\Suggestion');
    }
}
