<?php

namespace Database\Seeders;

use App\Models\CountryCode;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use File;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // seed country
        CountryCode::truncate();

        $json = File::get("database/data/country.json");
        // $json = File::get(public_path("data/country.json"));
        $countries = json_decode($json);

        foreach ($countries as $key => $value) {
            // dd($value->dial_code);
            CountryCode::create([
                "name" => $value->name,
                "code" => $value->sortname,
                "phone_code" => $value->phoneCode
            ]);
        }
    }
}
