<?php

namespace Database\Seeders;

use App\Models\GroupAdmin;
use App\Models\GroupMember;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //admin
        $faker = Faker::create('id_ID');
        $id = 1;
        $id2 = 1;
        for ($i = 1; $i <= 4; $i++) {
            $gender = $faker->randomElement(['male', 'female']);
            User::create([
                'id' => $id,
                'name' => $faker->name($gender),
                'gender' => $gender,
                'email' => 'admin' . $i . '@mail.com',
                'password' => Hash::make("password"),
                'whatsapp_no' => $faker->PhoneNumber,
                'address' => $faker->address,
                'birth_date' => $faker->numberBetween(1990, 2000),
                'country_id' => 16,
                'role_id' => 1,
                'regency_id' => $faker->numberBetween(3171, 3175),
            ]);
            $id++;
        }

        for ($i = 1; $i <= 6; $i++) {
            $gender = $faker->randomElement(['male', 'female']);
            User::create([
                'id' => $id,
                'name' => "pic" . $faker->name($gender),
                'gender' => $gender,
                'email' => 'pic' . $i . '@mail.com',
                'password' => Hash::make("password"),
                'whatsapp_no' => $faker->PhoneNumber,
                'address' => $faker->address,
                'birth_date' => $faker->numberBetween(1990, 2000),
                'country_id' => 16,
                'role_id' => 3,
                'regency_id' => $faker->numberBetween(3171, 3175),
            ]);

            $id++;
        }

        GroupAdmin::create([
            'user_id' => '5',
            'group_id' => '1',
            'type' => '0',
        ]);
        groupAdmin::create([
            'user_id' => '6',
            'group_id' => '1',
            'type' => '1',
        ]);
        groupAdmin::create([
            'user_id' => '7',
            'group_id' => '2',
            'type' => '0',

        ]);
        groupAdmin::create([
            'user_id' => '8',
            'group_id' => '2',
            'type' => '1',

        ]);
        groupAdmin::create([
            'user_id' => '9',
            'group_id' => '3',
            'type' => '0',

        ]);
        groupAdmin::create([
            'user_id' => '10',
            'group_id' => '3',
            'type' => '1',

        ]);
        groupAdmin::create([
            'user_id' => '10',
            'group_id' => '4',
            'type' => '0',

        ]);
        groupAdmin::create([
            'user_id' => '5',
            'group_id' => '4',
            'type' => '1',

        ]);
    }
}
