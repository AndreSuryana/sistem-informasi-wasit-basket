<?php

namespace Database\Seeders;

use App\Models\RefereeLicence;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RefereeLicenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RefereeLicence::create([
            "referee_id" => 1,
            "game_type" => "5on5",
            "licence_level" => "A",
            "document_path" => "/referee/document/licence-A-andre.pdf",
            "start_date" => Carbon::createFromFormat("d/m/Y", "20/02/2022"),
            "end_date" => Carbon::createFromFormat("d/m/Y", "20/04/2022"),
        ]);
    }
}
