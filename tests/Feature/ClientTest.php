<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientTest extends TestCase
{
    private string $baseUri = '/api/client';
    /**
     *
     * @return void
     */
    public function all()
    {
        $response = $this->get($this->baseUri);

        $response->assertStatus(200);
    }

    public function getBySearch()
    {
        $search = 'len';
        $response = $this->getJson('/api/user', ['search' => $search]);

        $response->assertStatus(200);
    }
}
