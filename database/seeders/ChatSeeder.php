<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\GroupChat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create('id_ID');

        $id = 1;
        $id2 = 1;
        for ($i = 1; $i <= 5; $i++) {
            Chat::create([
                'id' => $id,
                'from_id' => 1,
                'to_id' => 19,
                'message' => $faker->text(20),
            ]);
            $id++;
            Chat::create([
                'id' => $id,
                'from_id' => 19,
                'to_id' => 1,
                'message' => $faker->text(20),
            ]);
            $id++;
        }
        for ($i = 1; $i <= 3; $i++) {
            Chat::create([
                'id' => $id,
                'from_id' => 2,
                'to_id' => 19,
                'message' => $faker->text(20),
            ]);
            $id++;
            Chat::create([
                'id' => $id,
                'from_id' => 19,
                'to_id' => 2,
                'message' => $faker->text(20),
            ]);
            $id++;
        }
        for ($i = 1; $i <= 5; $i++) {
            Chat::create([
                'id' => $id,
                'from_id' => 3,
                'to_id' => 19,
                'message' => $faker->text(20),
            ]);
            $id++;
            Chat::create([
                'id' => $id,
                'from_id' => 19,
                'to_id' => 3,
                'message' => $faker->text(20),
            ]);
            $id++;
        }
        for ($i = 1; $i <= 5; $i++) {
            Chat::create([
                'id' => $id,
                'from_id' => 4,
                'to_id' => 19,
                'message' => $faker->text(20),
            ]);
            $id++;
            Chat::create([
                'id' => $id,
                'from_id' => 19,
                'to_id' => 4,
                'message' => $faker->text(20),
            ]);
            $id++;
        }
        for ($i = 1; $i <= 5; $i++) {
            Chat::create([
                'id' => $id,
                'from_id' => 2,
                'to_id' => 5,
                'message' => $faker->text(20),
            ]);
            $id++;
            Chat::create([
                'id' => $id,
                'from_id' => 5,
                'to_id' => 2,
                'message' => $faker->text(20),
            ]);
            $id++;
        }

        // group
        for ($i = 1; $i <= 2; $i++) {
            GroupChat::create([
                'from_id' => 1,
                'group_id' => 2,
                'message' => $faker->text(20),
            ]);
            GroupChat::create([
                'from_id' => 2,
                'group_id' => 2,
                'message' => $faker->text(20),
            ]);
            GroupChat::create([
                'from_id' => 18,
                'group_id' => 1,
                'message' => $faker->text(20),
            ]);
            GroupChat::create([
                'from_id' => 3,
                'group_id' => 1,
                'message' => $faker->text(20),
            ]);
        }
        for ($i = 1; $i <= 2; $i++) {
            GroupChat::create([
                'from_id' => 1,
                'group_id' => 3,
                'message' => $faker->text(20),
            ]);
            GroupChat::create([
                'from_id' => 2,
                'group_id' => 3,
                'message' => $faker->text(20),
            ]);
            GroupChat::create([
                'from_id' => 18,
                'group_id' => 3,
                'message' => $faker->text(20),
            ]);
            GroupChat::create([
                'from_id' => 3,
                'group_id' => 1,
                'message' => $faker->text(20),
            ]);
            GroupChat::create([
                'from_id' => 19,
                'group_id' => 1,
                'message' => $faker->text(20),
            ]);
            GroupChat::create([
                'from_id' => 19,
                'group_id' => 2,
                'message' => $faker->text(20),
            ]);
        }
    }
}
