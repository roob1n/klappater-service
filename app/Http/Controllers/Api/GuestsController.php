<?php

namespace App\Http\Controllers\Api;

use App\Guest;
use App\ActivationCode as Code;
use App\Uahnn\Transformers\GuestTransformer;
use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;

class GuestsController extends ApiController {

    protected $guestTransformer;

    public function __construct(GuestTransformer $guestTransformer) {
        $this->guestTransformer = $guestTransformer;
        $this->middleware('jwt.auth');
    }

    public function show() {
        $token = JWTAuth::getToken();
        $guest = JWTAuth::toUser($token);
        return $this->respond($this->guestTransformer->transform($guest));
    }
}
