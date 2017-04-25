<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestPriviledge extends Model {

    protected $table = "guest_priviledges";

    public function guests() {
        return $this->hasMany('App\Guest');
    }
}
