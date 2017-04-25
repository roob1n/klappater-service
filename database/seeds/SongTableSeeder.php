<?php

use App\Song;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SongTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Faker::create();

        foreach (range(1, 150) as $index) {
            Song::create([
                'spotify_song_id' => $faker->uuid,
                'title' => $faker->words($faker->numberBetween(1, 4), true),
                'artist' => $faker->firstName . " " . $faker->lastName,
                'duration_ms' => $faker->numberBetween(250000, 360000)
            ]);
        }
    }
}
