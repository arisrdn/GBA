<?php

namespace Database\Seeders;

use App\Models\Province;
use App\Models\Regency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Province::truncate();

        $csvFile = fopen(base_path('database/data/provinces.csv'), 'r');

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Province::create([
                    "id" => $data['0'],
                    "name" => $data['1']
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);


        Regency::truncate();
        $csvData = fopen(base_path('database/data/regencies.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {
                Regency::create([
                    "id" => $data['0'],
                    "name" => $data['2'],
                    "province_id" => $data['1']
                ]);
            }
            $transRow = false;
        }
        fclose($csvData);
    }
}
