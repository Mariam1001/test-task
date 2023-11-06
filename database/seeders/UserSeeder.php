<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'admin',
                'role_id' => User::USER_ADMIN,
                'email' => env('SUPERVISOR_EMAIL'),
                'password' => Hash::make(env('SUPERVISOR_PASSWORD')),
            ],
            [
                'name' => 'user1',
                'role_id' => User::USER_CUSTOMER,
                'email' => 'test1@gmail.com',
                'password' => Hash::make('testpassword'),
            ],
            [
                'name' => 'test2',
                'role_id' => User::USER_CUSTOMER,
                'email' => 'test2@gmail.com',
                'password' => Hash::make('test2password'),
            ]
        ];

        DB::table('users')->insert($user);
    }
}
