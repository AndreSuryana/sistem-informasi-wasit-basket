<?php

namespace Database\Seeders;

use App\Models\Referee;
use Illuminate\Database\Seeder;

class RefereeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Referee::create([
            "user_id" => 1,
            "level_id" => 4,
            "city_id" => 8,
            "document_path" => "/user/document/referee-andre.pdf",
        ]);
    }
}
