<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class PostTest extends TestCase
{
    public function testlist()
    {
        $this->get('/post')
            ->seeJsonStructure([
                '*' => [
                    'id',
                    'name',
                ],
            ]);
    }

    public function testForID()
    {
        $this->get('/post/for_id/1')
            ->seeJson([
                'id' => 1,
                'name' => 'admin',
            ]);
    }

    public function testCreate()
    {
        $data = [
            'name' => 'post name',
        ];

        $this->post('/post/create', $data)
            ->seeJson([
                'name' => $data['name'],
            ]);
    }

    public function testUpdate()
    {
        $data = [
            'name' => 'post name',
        ];

        $post = json_decode( $this->post('/post/create', $data)->response->getContent() );

        $new_data = [
            'id' => $post->id,
            'name' => 'new post name',
        ];

        $this->post('/post/update', $new_data)
            ->seeJson([
                'id' => $new_data['id'],
                'name' => $new_data['name'],
            ]);
    }

    public function testDelete()
    {
        $data = [
            'name' => 'post name',
        ];

        $post = json_decode( $this->post('/post/create', $data)->response->getContent() );

        $new_data = [
            'id' => $post->id,
            'name' => 'new post name',
        ];

        $this->post('/post/delete', $new_data)
            ->seeJson([
                'status' => 'success',
            ]);
    }
}
