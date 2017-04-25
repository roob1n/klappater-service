<?php

use App\ActivationCode;
use App\Guest;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class ActivationCodeTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $faker = Faker::create();
        $guestIds = Guest::pluck('id')->toArray();

        foreach (range(1, EventTableSeeder::NUM_OF_EVENTS) as $index) {
            foreach (range(1, GuestTableSeeder::NUM_OF_GUESTS + 20) as $jndex) {
                ActivationCode::create([
                    'code' => $faker->uuid,
                    'guest_id' => ($guestIds && $jndex < (GuestTableSeeder::NUM_OF_GUESTS / EventTableSeeder::NUM_OF_EVENTS)) ? array_pop($guestIds) : null,
                    'event_id' => $index,
                    'status' => 'used'
                ]);
            }
        }

    }
}
