<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "email" => "Andresuryana17@gmail.com",
            "password" => Hash::make("password123"),
            "first_name" => "Andre",
            "last_name" => "Suryana",
            "full_name" => "Kadek Andre Suryana",
            "place_of_birth" => "Denpasar",
            "date_of_birth" => Carbon::createFromFormat("d/m/Y", "17/11/2001"),
            "phone" => "081239732992",
            "address" => "Jl. Kenyeri XIII",
            "city_id" => 8,
            "other_profession" => "Mahasiswa",
            "photo_path" => "/user/images/andre.jpg",
        ]);
    }
}
