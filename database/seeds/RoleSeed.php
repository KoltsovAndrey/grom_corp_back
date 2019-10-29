<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin', //1
        ]);

        Role::create([
            'name' => 'news', //2
        ]);

        Role::create([
            'name' => 'user', //3
        ]);
    }
}
