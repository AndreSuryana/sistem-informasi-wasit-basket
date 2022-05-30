<?php

namespace Database\Seeders;

use App\Models\Referee;
use App\Models\RefereeEvent;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Call seeders
        $this->call([
            RoleSeeder::class,
            ProvinceSeeder::class,
            CitySeeder::class,
            LevelSeeder::class,
            // UserSeeder::class,
            RefereeSeeder::class,
            RefereeLicenceSeeder::class,
            RefereeEventSeeder::class,
            GameSeeder::class,
            ClubSeeder::class,
        ]);
    }
}
