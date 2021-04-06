<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Repositories\ClientRepositoryInterface;
use Illuminate\Support\Facades\App;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

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

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testGetBySearch()
    {
        $search = 'len';
        $response = $this->getJson($this->baseUri, ['search' => $search]);
        $expectedResult = App::make(ClientRepositoryInterface::class)->findByStringSearch($search)->jsonSerialize();

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson($expectedResult);
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
        $response->assertStatus(Response::HTTP_CREATED);

    }

    public function testUpdate()
    {
        $clientFromDb = Client::orderByRaw('RAND()')->get()->first();
        $response = $this->putJson(
            $this->baseUri . '/' . $clientFromDb->id,
            [
                'first_name' => 'Sally',
                'middle_name' => 'asasd',
                'last_name' => 'dsadas',
            ]
        );
        $response->assertStatus(Response::HTTP_OK);
    }

    public function testCreateNotValid()
    {
        $clientFromDb = Client::orderByRaw('RAND()')->get()->first();
        $response = $this->postJson(
            $this->baseUri . '/' . $clientFromDb->id,
            [
                'first_name' => 1,
                'middle_name' => 'asasd',
                'last_name' => 'dsadas',
            ]
        );
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testUpdateNotValid()
    {
        $clientFromDb = Client::orderByRaw('RAND()')->get()->first();
        $response = $this->putJson(
            $this->baseUri . '/' . $clientFromDb->id,
            [
                'first_name' => 1,
                'middle_name' => 'asasd',
                'last_name' => 'dsadas',
            ]
        );
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
