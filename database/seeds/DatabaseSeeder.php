<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        App\ActivationCode::truncate();
        App\Admin::truncate();
        App\Event::truncate();
        App\Guest::truncate();
        App\GuestPriviledge::truncate();
        App\Location::truncate();
        App\PlaylistEntry::truncate();
        App\Song::truncate();
        App\Suggestion::truncate();
        App\Vote::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->call(SongTableSeeder::class);
        $this->call(GuestPriviledgeTableSeeder::class);
        $this->call(GuestTableSeeder::class);
        $this->call(LocationTableSeeder::class);
        $this->call(EventTableSeeder::class);
        $this->call(ActivationCodeTableSeeder::class);
        $this->call(SuggestionTableSeeder::class);
        $this->call(VoteTableSeeder::class);
        $this->call(AdminTableSeeder::class);
    }
}
