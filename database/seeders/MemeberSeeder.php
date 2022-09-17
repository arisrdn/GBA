<?php

namespace Database\Seeders;

use App\Models\GroupMember;
use App\Models\GroupTodolist;
use App\Models\MemberTodolist;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class MemeberSeeder extends Seeder
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
        $id = 11;
        $id2 = 1;
        // User join group1 id 5-10
        for ($i = 1; $i <= 5; $i++) {
            $gender = $faker->randomElement(['male', 'female']);
            User::create([
                'id' => $id,
                'name' => "pic" . $faker->name($gender),
                'gender' => $gender,
                'email' => 'userg1' . $i . '@mail.com',
                'password' => Hash::make("password"),
                'whatsapp_no' => $faker->PhoneNumber,
                'address' => $faker->address,
                'birth_date' => $faker->numberBetween(1990, 2000),
                'regency_id' => $faker->numberBetween(3171, 3175),
                'country_id' => 16,
                'role_id' => 2,
                'church_branch_id' => 1,
                'email_verified_at' => now()->subMonth(),
            ]);
            GroupMember::create([
                'id' => $id2,
                'user_id' => $id,
                'group_id' => '1',
                'approved_at' => Carbon::yesterday()->subMonth(3),
                'created_at' => Carbon::yesterday()->subMonth(3),
            ]);
            $data = GroupTodolist::where("group_id", 1)->get();
            $day = 1;
            foreach ($data as  $val) {
                // echo $value->day;
                $read = Carbon::yesterday()->subMonth()->addDays($day);
                if ($read > now()) {
                    # code...
                    $read = null;
                }
                MemberTodolist::create([
                    'group_member_id' => $id - 4,
                    'group_todolist_id' => $val->id,
                    'read_at' => $read,
                    'schedule' => Carbon::yesterday()->subMonth()->addDays($val->day)
                ]);
                $day++;
            }


            $id++;
            $id2++;
        }
        // User join group1 id 10-15
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'id' => $id,
                'name' => 'g2 ' . $faker->name,
                'email' => 'userg2' . $i . '@mail.com',
                'password' => Hash::make("password"),
                'whatsapp_no' => $faker->PhoneNumber,
                'gender' => 'male',
                'address' => $faker->address,
                'birth_date' => $faker->numberBetween(1990, 2000),
                'country_id' => 16,
                'role_id' => 2,
                'church_branch_id' => 1,
                'email_verified_at' => now()->subMonth(),
                'regency_id' => $faker->numberBetween(3171, 3175),

            ]);
            GroupMember::create([
                'id' => $id2,
                'user_id' => $id,
                'group_id' => '2',
                'approved_at' => now(),
                'created_at' => Carbon::yesterday()->subMonth(),
            ]);
            $data = GroupTodolist::where("group_id", 2)->get();
            $day = 1;
            foreach ($data as  $val) {
                // echo $value->day;
                $read = Carbon::yesterday()->subMonth()->addDays($day);
                if ($read > now()) {
                    # code...
                } else {
                    MemberTodolist::create([
                        'group_member_id' => $id - 4,
                        'group_todolist_id' => $val->id,
                        'read_at' => $read,
                        'schedule' => Carbon::yesterday()->subMonth()->addDays($val->day)
                    ]);
                }

                $day++;
            }

            $id++;
            $id2++;
        }

        // User join group1 id 16-17
        for ($i = 1; $i <= 2; $i++) {
            User::create([
                'id' => $id,
                'name' => 'l ' . $faker->name,
                'email' => 'userl' . $i . '@mail.com',
                'password' => Hash::make("password"),
                'whatsapp_no' => $faker->PhoneNumber,
                'gender' => 'male',
                'address' => $faker->address,
                'birth_date' => $faker->numberBetween(1990, 2000),
                'country_id' => 16,
                'role_id' => 2,
                'church_branch_id' => 2,
                'regency_id' => $faker->numberBetween(3171, 3175),
                'email_verified_at' => now()->subMonth(),
            ]);
            GroupMember::create([
                'id' => $id2,
                'user_id' => $id,
                'group_id' => '1',
                'complete_at' => now(),
                'approved_at' => now(),
                'reason_leave_id' => '1',
                'note' => 'pindah',
                'created_at' => Carbon::yesterday()->subMonth(),
            ]);
            $data = GroupTodolist::where("group_id", 1)->get();
            $day = 1;
            foreach ($data as  $val) {
                $read = Carbon::yesterday()->subMonth()->addDays($day);
                if ($read > now()) {
                    $read = null;
                }
                MemberTodolist::create([
                    'group_member_id' => $id - 4,
                    'group_todolist_id' => $val->id,
                    'read_at' => $read,
                    'schedule' => Carbon::yesterday()->subMonth()->addDays($val->day)
                ]);
                $day++;
            }

            $id++;
            $id2++;
        }
        // User join group0k id 18-20
        // for ($i = 1; $i <= 2; $i++) {
        //     User::create([
        //         'id' => $id,
        //         'name' => 'tes ' . $faker->name,
        //         'email' => 'usertes' . $i . '@mail.com',
        //         'password' => Hash::make("password"),
        //         'whatsapp_no' => $faker->PhoneNumber,
        //         'gender' => 'male',
        //         'address' => $faker->address,
        //         'birth_date' => $faker->numberBetween(1990, 2000),
        //         'country_id' => 16,
        //         'role_id' => 2,
        //         'church_branch_id' => 2,
        //         'regency_id' => $faker->numberBetween(3171, 3175),
        //         'email_verified_at' => now()->subMonth(),
        //     ]);
        //     GroupMember::create([
        //         'id' => $id2,
        //         'user_id' => $id,
        //         'group_id' => '2',
        //         'complete_at' => Carbon::yesterday(),
        //         'approved_at' => Carbon::yesterday(),
        //         'created_at' => Carbon::yesterday()->subMonth(3),
        //     ]);
        //     $data = GroupTodolist::where("group_id", 2)->get();
        //     $day = 1;
        //     foreach ($data as  $val) {
        //         // echo $value->day;
        //         $read = Carbon::yesterday()->subMonth()->addDays($day);
        //         if ($read > now()) {
        //             # code...
        //             $read = null;
        //         }
        //         MemberTodolist::create([
        //             'group_member_id' => $id - 4,
        //             'group_todolist_id' => $val->id,
        //             'read_at' => Carbon::yesterday()->subMonth(3)->addDays($val->day),
        //             'schedule' => Carbon::yesterday()->subMonth(3)->addDays($val->day)
        //         ]);
        //         $day++;
        //     }
        //     $id2++;

        //     // ?
        //     GroupMember::create([
        //         'id' => $id2,
        //         'user_id' => $id,
        //         'group_id' => '3',
        //         'leave_at' => Carbon::yesterday(),
        //         'reason_leave_id' => '1',
        //         'note' => 'pindah',
        //         'approved_at' => Carbon::yesterday(),
        //         'created_at' => Carbon::yesterday()->subMonth(2),
        //     ]);
        //     $data = GroupTodolist::where("group_id", 3)->get();
        //     $day = 1;
        //     foreach ($data as  $val) {
        //         // echo $value->day;
        //         $read = Carbon::yesterday()->subMonth()->addDays($day);
        //         if ($read > now()) {
        //             # code...
        //             $read = null;
        //         }
        //         MemberTodolist::create([
        //             'group_member_id' => $id2,
        //             'group_todolist_id' => $val->id,
        //             'read_at' => $read,
        //             'schedule' => Carbon::yesterday()->subMonth(3)->addDays($val->day)
        //         ]);
        //         $day++;
        //     }
        //     $id2++;

        //     GroupMember::create([
        //         'id' => $id2,
        //         'user_id' => $id,
        //         'group_id' => '1',
        //         'leave_at' => Carbon::yesterday(),
        //         'approved_at' => Carbon::yesterday(),
        //         'created_at' => Carbon::yesterday()->subMonth(),
        //     ]);
        //     $data = GroupTodolist::where("group_id", 1)->get();
        //     $day = 1;
        //     foreach ($data as  $val) {
        //         // echo $value->day;
        //         $read = Carbon::yesterday()->subMonth()->addDays($day);
        //         if ($read > now()) {
        //             # code...
        //             $read = null;
        //         }
        //         MemberTodolist::create([
        //             'group_member_id' => $id2,
        //             'group_todolist_id' => $val->id,
        //             'read_at' => null,
        //             'schedule' => Carbon::now()->addDays($val->day)
        //         ]);
        //         $day++;
        //     }
        //     $id2++;
        //     $id++;
        // }



        // for ($i = 1; $i <= 5; $i++) {
        //     User::create([
        //         'id' => $id,
        //         'name' => 'w ' . $faker->name,
        //         'email' => 'userw' . $i . '@mail.com',
        //         'password' => Hash::make("password"),
        //         'whatsapp_no' => $faker->PhoneNumber,
        //         'gender' => 'male',
        //         'address' => $faker->address,
        //         'birth_date' => $faker->numberBetween(1990, 2000),
        //         'country_id' => 16,
        //         'role_id' => 2,
        //         'church_branch_id' => 2,
        //         'regency_id' => $faker->numberBetween(3171, 3175),
        //         'email_verified_at' => now()->subMonth(),
        //     ]);
        //     GroupMember::create([
        //         'id' => $id2,
        //         'user_id' => $id,
        //         'group_id' => '2',
        //         'created_at' => Carbon::yesterday()->subMonth(),
        //     ]);
        //     $id++;
        //     $id2++;
        // }

        // GroupMember::create([
        //     'id' => 15,
        //     'user_id' => 18,
        //     'group_id' => '3',
        //     'approved_at' => now(),
        //     'created_at' => Carbon::yesterday()->subMonth(),
        //     'leave_at' => now(),
        //     'reason_leave_id' => 'pindah ke yang pendek ',
        // ]);
        // $data = GroupTodolist::where("group_id", 3)->get();
        // $day = 1;
        // foreach ($data as  $val) {
        //     // echo $value->day;
        //     $read = Carbon::yesterday()->subMonth()->addDays($day);
        //     if ($read > now()) {
        //         # code...
        //         $read = null;
        //     }
        //     MemberTodolist::create([
        //         'group_member_id' => 13,
        //         'group_todolist_id' => $val->id,
        //         'read_at' => $read,
        //         'schedule' => Carbon::yesterday()->subMonth()->addDays($val->day)
        //     ]);
        //     $day++;
        // }

        // User join group2 id 10-15
        // for ($i = 1; $i <= 5; $i++) {
        //     User::create([
        //         'id' => $id,
        //         'name' => 'g1 ' . $faker->name,
        //         'email' => 'userg2' . $i . '@mail.com',
        //         'password' => Hash::make("password"),
        //         'whatsapp_no' => $faker->PhoneNumber,
        //         'gender' => 'male',
        //         'address' => $faker->address,
        //         'birth_date' => $faker->numberBetween(1990, 2000),
        //         'country_id' => 16,
        //         'role_id' => 2,
        //         'church_branch_id' => 1,
        //         'email_verified_at' => now(),
        //     ]);
        //     $id++;
        // }

        // GroupMember::create([
        //     'id' => 1,
        //     'user_id' => '3',
        //     'group_id' => '1',
        //     'approved_at' => now(),
        //     'complete_at' => now(),
        //     'created_at' => Carbon::yesterday(),

        // ]);

        // GroupMember::create([
        //     'id' => 2,
        //     'user_id' => '4',
        //     'group_id' => '1',
        //     'approved_at' => now(),
        //     'leave_at' => now(),
        // 

        //     'created_at' => Carbon::yesterday(),

        // ]);
        // GroupMember::create([
        //     'id' => 3,
        //     'user_id' => '3',
        //     'group_id' => '1',
        //     'approved_at' => now(),
        //     'reason_leave_id' => 'pindah ',
        // ]);
        // GroupMember::create([
        //     'id' => 4,
        //     'user_id' => '4',
        //     'group_id' => '1',
        // ]);
        // GroupMember::create([
        //     'id' => 5,
        //     'user_id' => '5',
        //     'group_id' => '1',

        // ]);
        // GroupMember::create([
        //     'id' => 6,
        //     'user_id' => '6',
        //     'group_id' => '1',
        //     'approved_at' => now(),
        // ]);
    }
}
