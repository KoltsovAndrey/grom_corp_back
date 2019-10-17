<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class DepartmentTest extends TestCase
{
    public function testlist()
    {
        $this->get('/department')->seeJsonStructure([
            '*' => [
                'id',
                'name',
                'e_mail',
                'phone',
                'phone_city',
            ],
        ]);
    }
}
