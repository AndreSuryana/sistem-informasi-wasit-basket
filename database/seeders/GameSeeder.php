<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Game::create([
            "referee_event_id" => 1,
            "team_a" => "Ekasma",
            "team_b" => "Smadara"
        ]);
    }
}
