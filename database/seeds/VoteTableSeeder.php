<?php

use App\Event;
use App\Suggestion;
use App\Vote;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class VoteTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Faker::create();

        foreach (range(1, EventTableSeeder::NUM_OF_EVENTS) as $eventId) {

            $event = Event::findOrFail($eventId);
            $suggestions = $event->suggestions->toArray();

            foreach ($suggestions as $suggestion) {
                $guests = $event->guests->toArray();

                foreach (range(1, $votecount = $faker->numberBetween(1, count($guests))) as $index) {
                    Vote::create([
                        'guest_id' => $faker->randomElement($guests)['id'],
                        'suggestion_id' => $suggestion['id'],
                    ]);
                }

                $sug = Suggestion::findOrFail($suggestion['id']);
                $sug->vote_count = $votecount;
                $sug->save();
            }
        }
    }
}
