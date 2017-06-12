<?php

namespace App\Console\Commands;

use App\Uahnn\Services\SpotifyService;
use Illuminate\Console\Command;

class SyncEvents extends Command {

    protected $signature = 'events:sync';

    protected $description = 'Checks all the events, if the next pick is due. If so, takes the most voted song and puts it on the Spotify playlist.';

    protected $spotifyService;

    public function __construct(SpotifyService $spotifyService) {
        parent::__construct();

        $this->spotifyService = $spotifyService;
    }


    public function handle() {
        $now = \Carbon\Carbon::now();

        $events = \App\Event::where([
            ['end', '>', $now],
            ['start', '<', $now],
            ['next_pick', '<', $now->addMinute()]])->get();

        foreach ($events as $event) {
            $most_voted_sugg = $event->suggestions()->where('status', 'active')->orderBy('vote_count', 'desc')->first();

            if ($most_voted_sugg) {

                $most_voted_sugg->status = "chosen";

                $most_voted_sugg->guest->suggestion_credit += 2;

                $this->comment($most_voted_sugg->song->title . " gewünscht von " . $most_voted_sugg->guest->nick_name);

                $event->next_pick->addSeconds(round($most_voted_sugg->song->duration_ms / 1000));

                $event->save();
                $most_voted_sugg->save();
                $most_voted_sugg->guest->save();

                $this->spotifyService->putSongOnPlaylist(
                    $event->location,
                    $event->spotify_playlist_id,
                    $most_voted_sugg->song->spotify_song_id
                );
            }else {
                $this->spotifyService->refreshAccessToken($event->location);

                $this->comment("Es ist ein Fehler aufgetreten: \n".$event->name . " hat keine Suggestions!");
            }
        }
    }
}
