<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Repositories\ClientRepositoryInterface;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * @var ClientRepositoryInterface
     */
    private ClientRepositoryInterface $clientRepository;

    public function __construct(
        ClientRepositoryInterface $clientRepository
    ) {
        $this->clientRepository = $clientRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        if ($textSearch = $request->input('search')) {
            return $this->clientRepository->search($textSearch);
        }
        return $this->clientRepository->all();
    }

    /**
     * Store a newly created resource in storage.
     * @param ClientRequest $request
     * @return mixed
     */
    public function store(ClientRequest $request)
    {
        return Client::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param Client $client
     */
    public function show(Client $client)
    {
        return $client;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ClientRequest $request
     * @param Client $client
     * @return Client
     */
    public function update(ClientRequest $request, Client $client)
    {
        $client->fill($request->validated());
        $client->save();
        return $client;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Client $client
     * @throws \Exception
     */
    public function destroy(Client $client)
    {
        if ($client->delete()) {
            return response()->json($client, 204);
        }
    }
}
