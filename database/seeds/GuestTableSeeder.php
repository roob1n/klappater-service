<?php

use App\Guest;
use App\GuestPriviledge;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class GuestTableSeeder extends Seeder {

    const NUM_OF_GUESTS = 250;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Faker::create();

        $guestPriviledgeIds = GuestPriviledge::pluck('id')->toArray();


        foreach (range(1, 250) as $index) {
            Guest::create([
                'last_name' => ($reg = $faker->boolean(30)) ? $faker->lastName : null,
                'first_name' => ($reg) ? $faker->firstName : null,
                'nick_name' => $faker->name,
                'facebook_credentials' => ($reg) ? $faker->uuid : null,
                'email' => ($reg) ? $faker->email : null,
                'password' => ($reg) ? $faker->password : null,
                'guest_priviledge_id' => ($reg) ? $faker->randomElement($guestPriviledgeIds) : array_first($guestPriviledgeIds),
                'suggestion_credit' => $faker->numberBetween(0, 15),
                'suggestion_timeout' => $faker->dateTimeBetween('now', '60 minutes')
            ]);
        }
    }
}
