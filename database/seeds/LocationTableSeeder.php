<?php

use App\Location;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class LocationTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $faker = Faker::create();

        foreach (range(1, 5) as $index) {
            Location::create([
                'name' => $faker->company
            ]);
        }
    }
}
