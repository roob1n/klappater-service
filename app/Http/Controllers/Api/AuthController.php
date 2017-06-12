<?php

namespace App\Http\Controllers\Api;

use App\Guest;
use App\Http\Controllers\Api\ApiController;
use App\ActivationCode as Code;
use App\Uahnn\Transformers\GuestTransformer;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends ApiController {

    protected $guestTransformer;

    function __construct(GuestTransformer $guestTransformer) {
        $this->guestTransformer = $guestTransformer;
    }

    public function register($code) {
        $code = Code::where('code', $code)->firstOrFail();

        if ($code->status != 'valid') {
            return $this->respondInvalid('Code ungültig.');
        }

        $code->status = 'used';

        $guest = Guest::create([
            'nick_name' => Guest::generateNickName(),
            'suggestion_credit' => 5,
            'guest_priviledge_id' => 1,
            'suggestion_timeout' => Carbon::now()
        ]);

        $code->guest()->associate($guest);

        $code->save();

        $token = JWTAuth::fromUser($code->guest);

        $spotifyToken = $guest->events()->first()->location->spotify_token;

        $data = $this->guestTransformer->transform($guest);

        $data['spotify_token'] = $spotifyToken;

        return $this->respondCreatedWithToken(
            $data,
            $token,
            'Neuer Gast erstellt.');
    }

    public function checkin($code) {
        return $this->respondNotFound("Methode checkin @ " . self::class . " noch nicht implementiert.");
    }
}
