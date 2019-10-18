<?php

use App\Department;
use Illuminate\Database\Seeder;

class DepartmentSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'name' => 'ОИТ',
            'full_name' => 'Отдел информационных технологий',
            'email' => 'admin@zavodgrom.ru',
            'phone' => '',
            'phone_city' => '',
        ]);
    }
}
