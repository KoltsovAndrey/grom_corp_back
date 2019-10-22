<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Имя',
            'second_name' => 'Фамилия',
            'middle_name' => 'Отчество',
            'login' => 'admin',
            'password' => Hash::make('admin'),
            'role_id' => 1,
            'post_id' => 1,
            'department_id' => 1,
        ]);
    }
}
