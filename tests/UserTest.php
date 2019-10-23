<?php

use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    public function testList()
    {
        $this->get('/user')
            ->seeJsonStructure([
                '*' => [
                    'first_name', 
                    'second_name', 
                    'middle_name', 
                    'login', 
                    'role_id', 
                    'post_id', 
                    'department_id', 
                    'email', 
                    'phone', 
                    'phone_city', 
                    'photo',                    
                ],
            ]);
    }

    public function testForID()
    {
        $this->get('/user/for_id/1')
            ->seeJson([
                'first_name' => 'Имя',
                'second_name' => 'Фамилия',
                'middle_name' => 'Отчество',
                'login' => 'admin',
                'role_id' => 1,
                'post_id' => 1,
                'department_id' => 1,
            ]);
    }

    public function testCreate()
    {
        $data = [
            'first_name' => 'Имя',
            'second_name' => 'Фамилия',
            'middle_name' => 'Отчество',
            'login' => 'user'.str_random(10),
            'role_id' => 1,
            'post_id' => 1,
            'department_id' => 1,
            'password' => Hash::make('password'),
        ];

        $this->post('/user/create', $data)
            ->seeJson([
                'first_name' => $data['first_name'],
                'second_name' => $data['second_name'],
                'middle_name' => $data['middle_name'],
                'login' => $data['login'],
                'role_id' => $data['role_id'],
                'post_id' => $data['post_id'],
                'department_id' => $data['department_id'],
            ]);
    }

    public function testUpdate()
    {
        $data = [
            'first_name' => 'Имя',
            'second_name' => 'Фамилия',
            'middle_name' => 'Отчество',
            'login' => 'user'.str_random(10),
            'role_id' => 1,
            'post_id' => 1,
            'department_id' => 1,
            'password' => Hash::make('password'),
        ];

        $user = json_decode($this->post('/user/create', $data)->response->getContent());

        $new_data = [
            'id' => $user->id,
            'first_name' => 'Имя 1',
            'second_name' => 'Фамилия 1',
            'middle_name' => 'Отчество 1',
            'login' => $user->login,
            'role_id' => 1,
            'post_id' => 1,
            'department_id' => 1,
        ];

        $this->post('/user/update', $new_data)
            ->seeJson([
                'first_name' => $new_data['first_name'],
                'second_name' => $new_data['second_name'],
                'middle_name' => $new_data['middle_name'],
                'login' => $new_data['login'],
                'role_id' => $new_data['role_id'],
                'post_id' => $new_data['post_id'],
                'department_id' => $new_data['department_id'],
            ]);
    }

    public function testDelete()
    {
        $data = [
            'first_name' => 'Имя',
            'second_name' => 'Фамилия',
            'middle_name' => 'Отчество',
            'login' => 'user'.str_random(10),
            'role_id' => 1,
            'post_id' => 1,
            'department_id' => 1,
            'password' => Hash::make('password'),
        ];

        $user = json_decode($this->post('/user/create', $data)->response->getContent());

        $new_data = [
            'id' => $user->id,
            'first_name' => 'Имя 1',
            'second_name' => 'Фамилия 1',
            'middle_name' => 'Отчество 1',
            'login' => $user->login,
            'role_id' => 1,
            'post_id' => 1,
            'department_id' => 1,
        ];

        $this->post('/user/delete', $new_data)
            ->seeJson([
                'status' => 'success',
            ]);
    }
}
