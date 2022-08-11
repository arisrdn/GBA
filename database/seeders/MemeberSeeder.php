<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MemeberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make("qwerty21"),
            'whatsapp_no' => '45464646546',
            'gender' => 'male',
            'address' => 'jl jakarta',
            'birth_date' => '1995',
            'country_id' => 16,
            'role_id' => 1,
            // 'device_token' => $request->email,
        ]);
        User::create([
            'name' => 'admin2',
            'email' => 'admin2@mail.com',
            'password' => Hash::make("qwerty21"),
            'whatsapp_no' => '45464646546',
            'gender' => 'male',
            'address' => 'jl jakarta',
            'birth_date' => '1995',
            'country_id' => 16,
            'role_id' => 1,
            // 'device_token' => $request->email,
        ]);
        User::create([
            'name' => 'user',
            'email' => 'user@mail.com',
            'password' => Hash::make("qwerty21"),
            'whatsapp_no' => '45464646546',
            'gender' => 'male',
            'address' => 'jl jakarta',
            'birth_date' => '1995',
            'country_id' => 16,
            'role_id' => 1,
            // 'device_token' => $request->email,
            'church_branch_id' => 1,
            'email_verified_at' => now(),

        ]);
        User::create([
            'name' => 'admin2',
            'email' => 'user2@mail.com',
            'password' => Hash::make("qwerty21"),
            'whatsapp_no' => '45464646546',
            'gender' => 'male',
            'address' => 'jl jakarta',
            'birth_date' => '1995',
            'country_id' => 16,
            'role_id' => 1,
            // 'device_token' => $request->email,
            'church_branch_id' => 1,
        ]);
    }
}
