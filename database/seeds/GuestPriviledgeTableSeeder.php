<?php

use App\GuestPriviledge;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class GuestPriviledgeTableSeeder extends Seeder {

    const NUM_OF_GUEST_PRIVILEDGES = 6;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $faker = Faker::create();

        foreach (range(1, self::NUM_OF_GUEST_PRIVILEDGES) as $index) {
            GuestPriviledge::create([
                'max_suggestions' => $index * self::NUM_OF_GUEST_PRIVILEDGES,
                'name' => $faker->firstNameMale,
                'suggestion_timeout' => 1000 * 60 * self::NUM_OF_GUEST_PRIVILEDGES / $index,
            ]);
        }
    }
}
