<?php

namespace App\Http\Controllers\Api;

use App\Suggestion;
use App\Vote;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class VotesController extends ApiController {

    public function __construct() {
        $this->middleware('jwt.auth');
    }

    public function toggle(Suggestion $suggestion) {
        $guest = JWTAuth::toUser(JWTAuth::getToken());

        // Schauen, ob die Suggestion und der Guest existieren, sonst Fehler ausgeben
        if (!$suggestion || !$guest) {
            return $this->respondNotAuthenticated('Guest oder Suggestion mit ID nicht gefunden');
        }


        if($suggestion->event->id != $guest->events()->first()->id) {
            return $this->respondNotAllowed('Guest kann nicht für eine Suggestion eines anderen Events voten!');
        }

        // Gibt es bereits einen Vote dieses Guests?
        $vote = Vote::where([
            ['suggestion_id', '=', $suggestion->id],
            ['guest_id', '=', $guest->id]
        ]);


        if($vote->count() > 0) {

            // Den Vote entfernen
            $vote->delete();

            $suggestion->vote_count -= 1;
            $suggestion->save();

            return $this->respondDeleted();
        }else {

            // Ansonsten neuen Vote erstellen
            $vote = new Vote();
            $vote->guest()->associate($guest);
            $vote->suggestion()->associate($suggestion);
            $vote->save();

            $suggestion->vote_count += 1;
            $suggestion->save();

            return $this->respondCreated(null, 'Vote wurde angelegt');
        }
    }
}
