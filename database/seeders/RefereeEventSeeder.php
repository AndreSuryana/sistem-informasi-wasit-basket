<?php

namespace Database\Seeders;

use App\Models\RefereeEvent;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RefereeEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RefereeEvent::create([
            "referee_id" => 1,
            "level_id" => 4,
            "city_id" => 4,
            "name" => "Liga Basket Tingkat SMA Kabupaten Klungkung",
            "start_date" => Carbon::createFromFormat("d/m/Y", "08/05/2022"),
            "end_date" => Carbon::createFromFormat("d/m/Y", "15/05/2022"),
            "position" => "Pimpinan"
        ]);
    }
}
