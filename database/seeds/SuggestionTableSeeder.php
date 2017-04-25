<?php

use App\Event;
use App\Song;
use App\Suggestion;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SuggestionTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Faker::create();

        $songIds = Song::pluck('id')->toArray();

        foreach (range(1, EventTableSeeder::NUM_OF_EVENTS) as $eventId) {

            $guests = Event::findOrFail($eventId)->guests->toArray();

            foreach (range(1, $faker->numberBetween(50, 100)) as $index) {
                Suggestion::create([
                    'song_id' => $faker->randomElement($songIds),
                    'guest_id' => $faker->randomElement($guests)['id'],
                    'life_time' => $faker->dateTimeBetween('now', '+ 10 minutes'),
                    'status' => 'active',
                    'event_id' => $eventId,
                    'vote_count' => 0
                ]);
            }
        }
    }
}
