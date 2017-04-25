<?php

use App\Event;
use App\Location;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EventTableSeeder extends Seeder {

    const NUM_OF_EVENTS = 8;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $faker = Faker::create();
        $locationIds = Location::pluck('id')->toArray();

        foreach (range(1, self::NUM_OF_EVENTS) as $index) {
            Event::create([
                'next_pick' => $faker->dateTimeBetween('now', '+ 5 minutes'),
                'start' => $faker->dateTimeBetween('- 5 hours', '- 3 hours'),
                'name' => $faker->name(),
                'end' => $faker->dateTimeBetween('+ 3 hours', '+ 5 hours'),
                'location_id' => $faker->randomElement($locationIds),
                'spotify_playlist_id' => $faker->uuid
            ]);
        }

    }
}
