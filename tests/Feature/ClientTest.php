<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientTest extends TestCase
{
    private $baseUri = '/api/client';
    /**
     *
     * @return void
     */
    public function testAll()
    {
        $response = $this->get($this->baseUri);

        $response->assertStatus(200);
    }

    public function testGetBySearch()
    {
        $search = 'len';
        $response = $this->getJson($this->baseUri, ['search' => $search]);
        $response->assertStatus(200);
    }

    public function testCreate()
    {
        $response = $this->postJson(
            $this->baseUri,
            [
                'first_name' => 'Sally',
                'middle_name' => 'asasd',
                'last_name' => 'dsadas',
            ]
        );
        $response->assertStatus(201);

    }

    public function testUpdate()
    {
        $response = $this->postJson(
            $this->baseUri . '/1',
            [
                'first_name' => 'Sally',
                'middle_name' => 'asasd',
                'last_name' => 'dsadas',
            ]
        );
        $response->assertStatus(201);
    }

    public function testCreateNotValid()
    {
        $response = $this->postJson(
            $this->baseUri . '/1',
            [
                'first_name' => 1,
                'middle_name' => 'asasd',
                'last_name' => 'dsadas',
            ]
        );
        $response->assertStatus(201);
    }

    public function testUpdateNotValid()
    {
        $response = $this->postJson(
            $this->baseUri . '/1',
            [
                'first_name' => 1,
                'middle_name' => 'asasd',
                'last_name' => 'dsadas',
            ]
        );
        $response->assertStatus(201);
    }
}
