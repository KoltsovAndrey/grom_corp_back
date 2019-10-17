<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class RoleTest extends TestCase
{
    public function testlist()
    {
        $this->get('/role')->seeJsonStructure([
            '*' => [
                'id',
                'name',
            ],
        ]);
    }
}
