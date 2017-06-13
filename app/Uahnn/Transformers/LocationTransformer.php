<?php

namespace App\Uahnn\Transformers;

class LocationTransformer extends Transformer {

    public function transform($location) {

        return [
            'location' => $location->name,
            'now_playing' => $location->name,
            'spotify_token' => $location->spotify_token,
        ];
    }
}