<?php

use App\Admin;
use App\Location;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AdminTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Faker::create();

        $locationIds = Location::pluck('id')->toArray();

        foreach (range(1, count($locationIds)) as $index) {
            Admin::create([
                'last_name' => $faker->lastName,
                'first_name' => $faker->firstName,
                'email' => $faker->email,
                'password' => $faker->password,
                'location_id' => array_pop($locationIds)
            ]);
        }
    }
}
