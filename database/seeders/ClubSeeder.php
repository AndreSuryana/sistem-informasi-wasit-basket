<?php

namespace Database\Seeders;

use App\Models\Club;
use Illuminate\Database\Seeder;

class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clubs = [
            [
                "name" => "Ekasma",
                "description" => "SMA N 1 Semarapura",
            ],
            [
                "name" => "Smadara",
                "description" => "SMA N 2 Semarapura",
            ],
        ];

        Club::insert($clubs);
    }
}
