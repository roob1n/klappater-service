<?php

namespace App\Http\Controllers\Api;

use App\Guest;
use App\ActivationCode as Code;
use App\Uahnn\Transformers\GuestTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

    public function name(Request $request) {
        $token = JWTAuth::getToken();
        $guest = JWTAuth::toUser($token);

        $data = $request->json()->all();

        $guest->first_name = $data['first_name'];
        $guest->last_name = $data['first_name'];

        $guest->save();

        return $this->respond($this->guestTransformer->transform($guest));
    }

    public function email(Request $request) {
        $token = JWTAuth::getToken();
        $guest = JWTAuth::toUser($token);

        $data = $request->json()->all();

        $guest->email = $data['email'];

        $guest->save();

        return $this->respond($this->guestTransformer->transform($guest));
    }

    public function nickname(Request $request) {
        $token = JWTAuth::getToken();
        $guest = JWTAuth::toUser($token);

        $data = $request->json()->all();

        $guest->nick_name = $data['nick_name'];

        $guest->save();

        return $this->respond($this->guestTransformer->transform($guest));
    }
}
