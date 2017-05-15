<?php

namespace App\Uahnn\Transformers;

use Tymon\JWTAuth\Facades\JWTAuth;

class SuggestionTransformer extends Transformer {

    private $songTransformer;

    function __construct(SongTransformer $songTransformer) {
        $this->songTransformer = $songTransformer;
    }

    public function transform($suggestion) {

        return [
            'id' => $suggestion->id,
            'song' => $this->songTransformer->transform($suggestion->song),
            'votes' => $suggestion->vote_count,
            'has_user_vote' => ($suggestion->votes()->where('guest_id', JWTAuth::toUser(JWTAuth::getToken())->id)->count() > 0) ? true : false,
            'suggestor' => $suggestion->guest->nick_name
        ];
    }
}