<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable {

    protected $table = "admins";

    protected $fillable = ['last_name', 'first_name', 'email', 'password'];

    protected $hidden = ['password'];

    public function location() {
        return $this->belongsTo('App\Location');
    }

}
