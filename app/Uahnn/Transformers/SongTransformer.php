<?php

namespace App\Uahnn\Transformers;

class SongTransformer extends Transformer {

    public function transform($song) {

        return [
            'id' => $song->id,
            'spotify_song_id' => $song->spotify_song_id,
            'title' => $song->title,
            'artist' => $song->artist,
            'duration_ms' => $song->duration_ms,
            'img_url' => $song->img
        ];
    }
}