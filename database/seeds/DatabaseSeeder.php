<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeed::class,
            DepartmentSeed::class,
            PostSeed::class,
            UserSeed::class,
            
        ]);
    }
}
