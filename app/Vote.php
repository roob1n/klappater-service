<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model {

    protected $table = "votes";

    public function guest() {
        return $this->belongsTo('App\Guest');
    }

    public function suggestion() {
        return $this->belongsTo('App\Suggestion');
    }
}
