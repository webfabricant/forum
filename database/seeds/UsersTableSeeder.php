<?php

use Illuminate\Database\Seeder;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([

            'name' => 'admin',
            'password'=> bcrypt('admin'),
            'email' => 'admin@admin.com',
            'admin' => 1,
            'avatar' => asset('avatars/avatar.png')

        ]);

        User::create([

            'name' => 'Muhammad Usama',
            'password'=> bcrypt('useless123'),
            'email' => 'usamaalee786@gmail.com',
            'avatar' => asset('avatars/avatar.png')

        ]);
    }
}
