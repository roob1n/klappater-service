<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model {

    protected $table = "locations";

    protected $fillable = ['name', 'spotify_account_id'];

    public function admins() {
        return $this->hasMany('App\Admin');
    }

    public function events() {
        return $this->hasMany('App\Event');
    }
}
