<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CardTest extends TestCase
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
}
