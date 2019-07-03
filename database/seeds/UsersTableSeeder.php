<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        DB::table('users')->truncate();

        $password = '123456';

        $dataInsert = [];
        $dataInsert[] = [
            'email' => 'admin@gmail.com',
            'password' => bcrypt($password),
            'fullname' => 'thong quan',
            'role_id' => 1,
            'phone_number' => '0901971498',
            'active' => 1
        ];

        DB::table('users')->insert(
            [
                'email' => 'shop@gmail.com',
                'password' => bcrypt($password),
                'fullname' => 'shop',
                'role_id' => 2,
                'phone_number' => '0901971498',
                'active' => 1
            ]
        );

        for ($i = 0; $i < 20; $i++) {
            $dataInsert[] = [
                'email' => $faker->email,
                'password' => bcrypt($password),
                'fullname' => $faker->name,
                'role_id' => 2,
                'phone_number' => $faker->phoneNumber,
                'active' => 1
            ];
        }
        DB::table('users')->insert($dataInsert);
    }
}
