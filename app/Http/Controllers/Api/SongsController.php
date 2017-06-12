<?php

namespace App\Http\Controllers\Api;

use App\Song;
use App\Uahnn\Transformers\SongTransformer;
use Illuminate\Http\Request;

class SongsController extends ApiController {

    protected $songTransformer;

    public function __construct(SongTransformer $songTransformer) {
        $this->songTransformer = $songTransformer;
        $this->middleware('jwt.auth');
    }

    public function store(Request $request) {
        $data = $request->json()->all();

        $song = Song::firstOrNew(['spotify_song_id' => $data['spotify_song_id']]);

        if($song->title) {
            return $this->respond($this->songTransformer->transform($song));
        }else {
            $song->artist = $data['artist'];
            $song->title = $data['title'];
            $song->img = $data['img_url'];
            $song->duration_ms = $data['duration_ms'];
            $song->save();

            return $this->respond($this->songTransformer->transform($song));
        }
    }

    public function options()
    {
        //
    }
}
