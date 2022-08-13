<?php

namespace Database\Seeders;

use App\Models\GroupMember;
use App\Models\User;
use Carbon\Carbon;
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
            'id' => 1,
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
            'id' => 2,
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
            'id' => 3,
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
            'id' => 4,
            'name' => 'user2',
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
        User::create([
            'id' => 5,
            'name' => 'user3',
            'email' => 'user3@mail.com',
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
        User::create([
            'id' => 6,
            'name' => 'user4',
            'email' => 'user4@mail.com',
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


        GroupMember::create([
            'id' => 1,
            'user_id' => '3',
            'group_id' => '1',
            'approved_at' => now(),
            'complete_at' => now(),
            'created_at' => Carbon::yesterday(),

        ]);
        GroupMember::create([
            'id' => 2,
            'user_id' => '4',
            'group_id' => '1',
            'approved_at' => now(),
            'leave_at' => now(),
            'reason_leave' => 'pindah',
            'created_at' => Carbon::yesterday(),

        ]);
        GroupMember::create([
            'id' => 3,
            'user_id' => '3',
            'group_id' => '1',
            'approved_at' => now(),
            'reason_leave' => 'pindah ',
        ]);
        GroupMember::create([
            'id' => 4,
            'user_id' => '4',
            'group_id' => '1',
        ]);
        GroupMember::create([
            'id' => 5,
            'user_id' => '5',
            'group_id' => '1',

        ]);
        GroupMember::create([
            'id' => 6,
            'user_id' => '6',
            'group_id' => '1',
            'approved_at' => now(),
        ]);
    }
}
