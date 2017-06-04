<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model {

    protected $table = "locations";

    protected $fillable = ['name', 'spotify_token', 'spotify_user', 'refresh_token', 'expires_in'];

    protected $dates = ['expires_in'];

    public function admins() {
        return $this->hasMany('App\Admin');
    }

    public function events() {
        return $this->hasMany('App\Event');
    }
}
