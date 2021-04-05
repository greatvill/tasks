<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Repositories\ClientRepositoryInterface;
use Illuminate\Http\Response;

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
     * @param string $search
     * @return Response
     */
    public function index(string $search = null)
    {
        if (is_null($search)) {
           return $this->clientRepository->all();
        }
        return $this->clientRepository->findByStringSearch($search);
    }

    /**
     * Store a newly created resource in storage.
     * @param ClientRequest $request
     */
    public function store(ClientRequest $request)
    {
        $client = Client::create($request->validated());
        return $client;
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
        if($client->delete()) {
            return response()->json($client, 204);
        }
    }
}
