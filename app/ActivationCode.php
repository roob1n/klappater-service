<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivationCode extends Model {

    protected $table = "activation_codes";

    protected $fillable = ['code', 'status'];

    const CODE_CHARS = ['a', 'A', 'b', 'B', 'c', 'C', 'd', 'D', 'e', 'E', 'f', 'F', 'g', 'G', 'h', 'i', 'j', 'J', 'k', 'K', 'L', 'm', 'M', 'n', 'N', 'p', 'P', 'q', 'Q', 'r', 'R', 's', 'S', 't', 'T', 'u', 'U', 'v', 'V', 'w', 'W', 'x', 'X', 'y', 'Y', 'z', 'Z', '1', '2', '3', '4', '5', '6', '7', '8', '9'];


    /*====================
          Relations
    ====================*/

    public function guest() {
        return $this->belongsTo('App\Guest');
    }

    public function event() {
        return $this->belongsTo('App\Event');
    }


    /*====================
          Functions
    ====================*/

   	public static function generate($length = 8) {

   		$length = ($length < 1) ? 1 : $length;

   		$code = "";

   		for($i = 0; $i < $length; $i++){
			 $code .= self::CODE_CHARS[array_rand(self::CODE_CHARS)];
   		}

   		return $code; 
   	}


    /*====================
         Query Scopes
    ====================*/

    public function scopeNextValid($query) {

      return $query->where('status', 'valid')->first();
    }
}
