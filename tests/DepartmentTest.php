<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class DepartmentTest extends TestCase
{
    public function testlist()
    {
        $this->get('/department')
            ->seeJsonStructure([
                '*' => [
                    'id',
                    'name',
                    'full_name',
                    'email',
                    'phone',
                    'phone_city',
                ],
            ]);
    }

    public function testForID()
    {
        $this->get('/department/for_id/1')
            ->seeJson([
                'name' => 'ОИТ',
                'full_name' => 'Отдел информационных технологий',
                'email' => 'admin@zavodgrom.ru',
                'phone' => '',
                'phone_city' => '',
            ]);
    }

    public function testCreate()
    {
        $data = [
            'name' => 'name',
            'full_name' => 'full name',
            'email' => 'email',
            'phone' => 'phone',
            'phone_city' => 'phone city',
        ];

        $this->post('/department/create', $data)
            ->seeJson([
                'name' => $data['name'],
                'full_name' => $data['full_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'phone_city' => $data['phone_city'],
            ]);
    }

    public function testUpdate()
    {
        $data = [
            'name' => 'name',
            'full_name' => 'full name',
            'email' => 'email',
            'phone' => 'phone',
            'phone_city' => 'phone city',
        ];

        $dep = json_decode($this->post('/department/create', $data)->response->getContent());

        $new_data = [
            'id' => $dep->id,
            'name' => 'new name',
            'full_name' => 'new full name',
            'email' => 'new email',
            'phone' => 'new phone',
            'phone_city' => 'new phone city',
        ];

        $this->post('/department/update', $new_data)
            ->seeJson([
                'id' => $new_data['id'],
                'name' => $new_data['name'],
                'full_name' => $new_data['full_name'],
                'email' => $new_data['email'],
                'phone' => $new_data['phone'],
                'phone_city' => $new_data['phone_city'],
            ]);
    }

    public function testDelete()
    {
        $data = [
            'name' => 'name',
            'full_name' => 'full name',
            'email' => 'email',
            'phone' => 'phone',
            'phone_city' => 'phone city',
        ];

        $dep = json_decode($this->post('/department/create', $data)->response->getContent());

        $new_data = [
            'id' => $dep->id,
            'name' => 'new name',
            'full_name' => 'new full name',
            'email' => 'new email',
            'phone' => 'new phone',
            'phone_city' => 'new phone city',
        ];

        $this->post('/department/delete', $new_data)
            ->seeJson([
                'status' => 'success',
            ]);
    }
}
