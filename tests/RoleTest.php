<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class RoleTest extends TestCase
{
    public function testlist()
    {
        $this->get('/role')
            ->seeJsonStructure([
                '*' => [
                    'id',
                    'name',
                ],
            ]);
    }

    public function testForID()
    {
        $this->get('/role/for_id/1')
            ->seeJson([
                'id' => 1,
                'name' => 'admin',
            ]);
    }

    public function testCreate()
    {
        $data = [
            'name' => 'role name',
        ];

        $this->post('/role/create', $data)
            ->seeJson([
                'name' => $data['name'],
            ]);
    }

    public function testUpdate()
    {
        $data = [
            'name' => 'role name',
        ];

        $role = json_decode( $this->post('/role/create', $data)->response->getContent() );

        $new_data = [
            'id' => $role->id,
            'name' => 'new role name',
        ];

        $this->post('/role/update', $new_data)
            ->seeJson([
                'id' => $new_data['id'],
                'name' => $new_data['name'],
            ]);
    }

    public function testDelete()
    {
        $data = [
            'name' => 'role name',
        ];

        $role = json_decode( $this->post('/role/create', $data)->response->getContent() );

        $new_data = [
            'id' => $role->id,
            'name' => 'new role name',
        ];

        $this->post('/role/delete', $new_data)
            ->seeJson([
                'status' => 'success',
            ]);
    }
}
