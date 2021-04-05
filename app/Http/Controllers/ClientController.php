<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Repositories\ClientRepositoryInterface;
use Illuminate\Http\Request;
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
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if ($search = $request->input('search')) {
            return $this->clientRepository->findByStringSearch($search);
        }
        return $this->clientRepository->all();
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
