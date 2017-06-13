<?php

namespace App\Http\Controllers\Api;

use App\Location;
use App\Uahnn\Transformers\LocationTransformer;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class LocationsController extends ApiController
{

    protected $locationTransformer;

    public function __construct(LocationTransformer $locationTransformer) {
        $this->locationTransformer = $locationTransformer;
        $this->middleware('jwt.auth');
    }

    public function show() {
        $token = JWTAuth::getToken();
        $guest = JWTAuth::toUser($token);

        $location = $guest->events()->first()->location;

        return $this->respond($this->locationTransformer->transform($location));
    }
}
