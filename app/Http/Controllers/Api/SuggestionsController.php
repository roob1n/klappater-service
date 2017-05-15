<?php

namespace App\Http\Controllers\Api;

use App\Song;
use App\Suggestion;
use App\Uahnn\Transformers\SuggestionTransformer;
use App\Vote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class SuggestionsController extends ApiController {

    protected $suggestionTransformer;

    public function __construct(SuggestionTransformer $suggestionTransformer) {
        $this->suggestionTransformer = $suggestionTransformer;
        $this->middleware('jwt.auth');
    }

    public function index() {
        $token = JWTAuth::getToken();
        $guest = JWTAuth::toUser($token);

        $suggestions = Suggestion::where('event_id', $guest->events()->first()->id)
            ->orderBy('vote_count', 'desc')
            ->get();

        return $this->respond($this->suggestionTransformer->transformCollection($suggestions));
    }

    public function store(Song $song) {
        $guest = JWTAuth::toUser(JWTAuth::getToken());

        // Schauen, dass der Song und der Guest existieren, sonst Fehler ausgeben
        if (!$song || !$guest) {
            return $this->respondNotAuthenticated('Guest oder Song mit ID nicht gefunden');
        }

        // Hat der User noch genügend Credits?
        if ($guest->suggestion_credit <= 0) {
            return $this->respondNotAllowed('Guest hat nicht mehr genügend Credits');
        }

        // Wurde der Song schon vorgeschlagen?
        $suggestion = Suggestion::where([
                ['song_id', '=', $song->id],
                ['status', '=', 'active'],
                ['event_id', '=', $guest->events()->first()->id]
            ])->count();

        if ($suggestion > 0) {
            return $this->respondNotAllowed('Song wurde bereits vorgeschlagen!');
        }

        // Suggestion anlegen
        $suggestion = new Suggestion();
        $suggestion->song()->associate($song);
        $suggestion->guest()->associate($guest);
        $suggestion->event()->associate($guest->events()->first());
        $suggestion->vote_count = 1;
        $suggestion->life_time = Carbon::now(2)->addMinutes(10);
        $suggestion->save();

        // User Vote anlegen
        $vote = new Vote();
        $vote->guest()->associate($guest);
        $vote->suggestion()->associate($suggestion);
        $vote->save();

        $guest->suggestion_credit -= 1;
        $guest->save();


        // suggestion zurückgeben
        return $this->respond($this->suggestionTransformer->transform($suggestion));
    }

    public function destroy(Suggestion $suggestion) {
        //
    }
}
